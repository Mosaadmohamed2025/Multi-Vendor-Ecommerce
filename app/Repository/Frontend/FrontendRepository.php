<?php

namespace App\Repository\Frontend;
use App\Models\AboutUs;
use App\Models\Brand;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\InterFaces\Frontend\FrontendRepositoryInterface;
use App\Models\Banner;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use App\Notifications\ContactUs;

use App\Models\Category;
use App\Models\Product;

class FrontendRepository implements FrontendRepositoryInterface{

  public function index()
  {
    $banners = Banner::where(['status'=> 'active' , 'condition' => 'banner'])->orderBy('id', 'desc')->limit('5')->get();
    $categories = Category::where(['status'=> 'active' , 'is_parent' => 1])->orderBy('id', 'desc')->limit('3')->get();
    $brands = Brand::where('status','active')->orderBy('id' , 'desc')->limit(8)->get();
    $Salling_items = DB::table('product_orders')->select('product_id' , DB::raw('COUNT(product_id) as count'))->groupBy('product_id')->orderBy('count' , 'desc')->get();

    $product_ids = [];
    foreach ($Salling_items as $item){
        $product_ids[] = $item->product_id;
    }

    $best_sellings = Product::whereIn('id' , $product_ids)->get();


    $items_rated = DB::table('product_reviews')->select('product_id' , DB::raw('AVG(rate) as count'))->groupBy('product_id')->orderBy('count' , 'desc')->get();

    $product_ids = [];
    foreach ($items_rated as $item){
          $product_ids[] = $item->product_id;
    }

    $best_rated = Product::whereIn('id' , $product_ids)->get();

    return view('WebSite.home', compact('banners','categories' ,'best_sellings' , 'best_rated' , 'brands'));
  }
  public function ProductCategory($request,$slug)
  {
    $categories = Category::with('products')->where('slug', $slug)->first();
    $product_category = Category::where('slug',$slug)->first();

    $sort = '';

    if($request->sort != null)
    {
      $sort = $request->sort;
    }
    if($categories != null)
    {
      if($sort == 'priceAsc' )
      {
        $products = Product::where(['status' => 'active' ,'cat_id' => $categories->id ])->orderBy('offer_price' , 'ASC')->paginate(12);
      }elseif($sort == 'priceDesc')
      {
        $products = Product::where(['status' => 'active' , 'cat_id' => $categories->id])->orderBy('offer_price' , 'DESC')->paginate(12);
      }
      elseif($sort == 'discAsc')
      {
        $products = Product::where(['status' => 'active' , 'cat_id' => $categories->id])->orderBy('discount' , 'ASC')->paginate(12);
      }
      elseif($sort == 'discDesc')
      {
        $products = Product::where(['status' => 'active' ,'cat_id' => $categories->id])->orderBy('discount' , 'DESC')->paginate(12);
      }elseif($sort == 'titleAsc')
      {
        $products = Product::where(['status' => 'active' , 'cat_id' => $categories->id])->orderBy('title' , 'ASC')->paginate(12);
      }
      elseif($sort == 'titleDesc')
      {
        $products = Product::where(['status' => 'active','cat_id' => $categories->id ])->orderBy('title' , 'DESC')->paginate(12);
      }else{
        $products = Product::where(['status' => 'active' , 'cat_id' => $categories->id])->paginate(12);
      }
    }
    $route = 'product-category';
    return view('WebSite.products.product_category', compact('categories','product_category','route','products','sort'));
  }
  public function productDetail($slug)
  {
    $products = Product::with('related_products')->where('slug', $slug)->first();
    if($products)
    {
      return view('WebSite.products.product_details', compact('products'));
    }
  }
  public function userAuth()
  {
    Session::put('url.intendend', URL::previous());
    return view('WebSite.auth.login');
  }

    public function shop()
    {
        $query = Product::query();

        // Apply category filter
        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $cat_ids = Category::whereIn('slug', $slugs)->pluck('id')->toArray();
            $query->whereIn('cat_id', $cat_ids);
        }

        // Apply brand filter
        if (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brand_ids = Brand::whereIn('slug', $slugs)->pluck('id')->toArray();
            $query->whereIn('brand_id', $brand_ids);
        }

        // Apply size filter
        if (!empty($_GET['size'])) {
            $query->where('size', $_GET['size']);
        }
        // Apply status filter
        $query->where('status', 'active');

        // Apply sorting
        $sort = $_GET['sortBy'] ?? '';
        if (!empty($sort)) {
            switch ($sort) {
                case 'priceAsc':
                    $query->orderBy('offer_price', 'ASC');
                    break;
                case 'priceDesc':
                    $query->orderBy('offer_price', 'DESC');
                    break;
                case 'discAsc':
                    $query->orderBy('price', 'ASC');
                    break;
                case 'discDesc':
                    $query->orderBy('price', 'DESC');
                    break;
                case 'titleAsc':
                    $query->orderBy('title', 'ASC');
                    break;
                case 'titleDesc':
                    $query->orderBy('title', 'DESC');
                    break;
            }
        }

        if(!empty($_GET['range_price']))
        {
            $price = explode('-' , $_GET['range_price']);
            $price[0] = floor($price[0]);
            $price[1] = ceil($price[1]);


            $query->whereBetween('offer_price' , $price);

        }
        // Get paginated results
        $products = $query->paginate(12);


        //Get brands
        $brands = Brand::where('status' , 'active')->orderBy('title' , 'ASC')->with('products')->get();

        // Get categories
        $cats = Category::where(['status' => 'active', 'is_parent' => 1])->with('products')->orderBy('title', 'ASC')->get();

        return view('WebSite.products.shop', compact('products', 'cats', 'sort' , 'brands'));
    }

    public function AboutUs()
    {
        $aboutus = AboutUs::first();
        $brands = Brand::where('status','active')->orderBy('id' , 'desc')->limit(8)->get();
        return view('WebSite.about.index' , compact('aboutus' , 'brands'));
    }
    public function ContactUs()
    {
        return view('WebSite.contact.index');
    }

    public function ContactUsForm($request)
    {
       $user = User::where('email', 'mm2481483@gmail.com')->first();
       Notification::send($user, new ContactUs($request));

        return back()->with('success' , 'Message has been sent');
    }
    public function shopFilter($request)
  {
      $data = $request->all();
      $catUrl = '';

      if(!empty($data['category']))
      {
          foreach($data['category'] as $category)
          {
              if(empty($catUrl))
              {
                  $catUrl .= '&category='.$category;
              }else{
                  $catUrl .=','.$category;
              }
          }
      }

      $sortByUrl="";
      if(!empty($data['sortby']))
      {
          $sortByUrl .= '&sortBy='.$data['sortby'];
      }

      $range_price_Url="";
      if(!empty($data['range_price']))
      {
          $range_price_Url .= '&range_price='.$data['range_price'];
      }

      $brand_Url="";
      if(!empty($data['brand']))
      {
          foreach($data['brand'] as $brand)
          {
              if(empty($brand_Url))
              {
                  $brand_Url .= '&brand='.$brand;
              }else{
                  $brand_Url .=','.$brand;
              }
          }
      }

      $size_Url="";
      if(!empty($data['size']))
      {
          $size_Url .= '&size='.$data['size'];
      }

      return \redirect()->route('shop' , $catUrl.$sortByUrl.$range_price_Url.$brand_Url.$size_Url);
  }

  public function autosearch($request)
  {
      $query = $request->get('term' , '');
      $products = Product::where('title' , 'like' , '%'.$query.'%')->where('status' , 'active')->get();

      $data = array();

      foreach ($products as $product)
      {
          $data[] = array('value'=> $product->title , 'id' => $product->id);
      }
      if(count($data))
      {
          return $data;
      }else{
          return ['value' => 'No Result Found' , 'id' => ''];
      }
  }
  public function search($request)
{
    $query = $request->input('query');
    $sort =  '';
    $products = Product::where('title' ,'like' , '%'.$query.'%')->where('status','active')->orderBy('id' , 'DESC')->paginate(12);

    //Get brands
    $brands = Brand::where('status' , 'active')->orderBy('title' , 'ASC')->with('products')->get();

    // Get categories
    $cats = Category::where(['status' => 'active', 'is_parent' => 1])->with('products')->orderBy('title', 'ASC')->get();

    return view('WebSite.products.shop', compact('products', 'cats', 'brands' , 'sort'));
}
  public function loginSubmit($request)
  {
    if(Auth::attempt(['email' => $request->email, 'password' => $request->password , 'status' => 'active']))
    {
      Session::put('user', $request->email);

      if(Session::get('url.intendend'))
      {
          return redirect(Session::get('url.intendend'))->with('success' , 'Successfully Login');
      }else{
        return  redirect()->route('home')->with('success' , 'Successfully Login');
      }

    }else{
      return back()->with('error' , 'Invalid email & password');
    }
  }
  public function registerSubmit($request)
  {
    $data = $request->all();
    $check = $this->create($data);
    Session::put('user', $data['email']);
    Auth::login($check);

    if($check){
      return redirect()->route('home')->with('success' , 'Successfully Registered');;
    }else{
      return back()->with('error' , ['check your credentials']);
    }
  }
  private function create(array $data)
  {
    return User::create([
      'full_name' => $data['full_name'],
      'username'=> $data['username'],
      'email'=>$data['email'],
      'password'=> Hash::make($data['password'])
    ]);
  }
  public function userLogout()
  {
    Session::forget('user');
    Auth::logout();
    return redirect()->route('home')->with('success' , 'Successfully Logout');;
  }
  public function userDashboard()
  {
    $user = Auth::user();
    $orders =Order::where('user_id' , $user->id)->get() ;
    return view('WebSite.user.myAccount' , compact('user' , 'orders'));
  }
  public function billingAddress($request , $id)
  {
    $user = User::where('id' , $id)->update(['country'=>$request->country , 'city' => $request->city , 'postcode' => $request->postcode , 'address' => $request->address , 'state' => $request->state]);
    if($user){
      return back()->with('success' , 'Billing Address  Successfully Updated');
    }else{
      return back()->with('error' , 'Something Went Wrong ');
    }
  }
  public function shippingAddress($request , $id){
    $user = User::where('id' , $id)->update(['scountry'=>$request->scountry , 'scity' => $request->scity , 'spostcode' => $request->spostcode , 'saddress' => $request->saddress , 'sstate' => $request->sstate]);
    if($user){
      return back()->with('success' , 'Shipping Address  Successfully Updated');
    }else{
      return back()->with('error' , 'Something Went Wrong ');
    }
  }

    public function updateAccount($request)
    {
        $hashpassword = Auth::user()->password;

        if ($request->oldpassword == null && $request->newpassword == null) {
            User::where('id', $request->id)->update(['full_name' => $request->full_name, 'username' => $request->username, 'phone' => $request->phone]);
        } else {
            if (\Hash::check($request->oldpassword, $hashpassword)) {
                if (!\Hash::check($request->newpassword, $hashpassword)) {
                    // Update user information and password
                    User::where('id', $request->id)->update(['full_name' => $request->full_name, 'username' => $request->username, 'phone' => $request->phone, 'password' => Hash::make($request->newpassword)]);
                }
            } else {
                return back()->with('error', 'Old Password does not match');
            }
        }

        return $this->uploadPhoto($request, $request->id);
    }

    /**
     * @param $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function uploadPhoto($request, $id): \Illuminate\Http\RedirectResponse
    {
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $request->full_name . '-image-' . time() . rand(1, 1000) . '.' . $image->extension();
                $image->move(public_path('user_images'), $imageName);
                User::where('id', $id)->update(['photo' => $imageName]);
            }
            return back()->with('success', 'Account Successfully Updated');
        } catch (\Exception $e) {
            Log::error('Error uploading user photo: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while uploading the photo.');
        }
    }
}

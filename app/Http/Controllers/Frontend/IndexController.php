<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InterFaces\Frontend\FrontendRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    private $frontend;

    public function __construct(FrontendRepositoryInterface $frontend)
    {
        $this->frontend = $frontend;
    }

    public function index()
    {
        return $this->frontend->index();
    }
    public function userAuth()
    {
        return $this->frontend->userAuth();
    }
    public function ProductCategory(Request $request,$slug)
    {
        return $this->frontend->ProductCategory($request,$slug);
    }
    public function shop()
    {
        return $this->frontend->shop();
    }
    public function shopFilter(Request $request)
    {
        return $this->frontend->shopFilter($request);
    }
    public function AboutUs(){
        return $this->frontend->AboutUs();
    }
    public function ContactUs()
    {
        return $this->frontend->ContactUs();
    }
    public function ContactUsForm(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|email',
            'content' => 'required'
        ]);

        return $this->frontend->ContactUsForm($request);
    }
    public function autosearch(Request $request)
    {
        return $this->frontend->autosearch($request);
    }
    public function search(Request $request)
    {
        $this->validate($request,[
            'query' => 'required'
        ]);

        return $this->frontend->search($request);
    }
    public function productDetail($slug)
    {
        return $this->frontend->productDetail($slug);
    }
    public function loginSubmit(Request $request)
    {
        $this->validate($request,[
            'email' => 'email|required|exists:users,email',
            'password' => 'required|min:8'
        ]);

        return $this->frontend->loginSubmit($request);
    }
    public function registerSubmit(Request $request){
        $this->validate($request,[
            'username'=>'required|string',
            'full_name'=>'required|string',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ]);

        return $this->frontend->registerSubmit($request);
    }

    public function resend_otp(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'email|required|exists:users',
        ]);
        if ($validator->fails()) {
            return view('WebSite.auth.OtpValidation')
                ->withErrors($validator);
        }

        return $this->frontend->resend_otp($request);
    }
    public function email_verification(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'email|required|exists:users',
            'code' => 'required|max:6'
        ]);
        if ($validator->fails()) {
            return view('WebSite.auth.OtpValidation')
                ->withErrors($validator);
        }
        return $this->frontend->email_verification($request);
    }
    public function userLogout(){
        return $this->frontend->userLogout();
    }
    public function userDashboard(){
    return $this->frontend->userDashboard();
    }
    public function billingAddress(Request $request , $id){
        $this->validate($request,[
            'address'=>'nullable|string',
            'country'=>'nullable|string',
            'state'=>'nullable|string',
            'city'=>'nullable|string',
            'postcode' => 'nullable|numeric'
        ]);
        return $this->frontend->billingAddress($request , $id);
    }
    public function shippingAddress(Request $request , $id)
    {
        $this->validate($request,[
            'saddress'=>'nullable|string',
            'scountry'=>'nullable|string',
            'sstate'=>'nullable|string',
            'scity'=>'nullable|string',
            'spostcode' => 'nullable|numeric'
        ]);
       return $this->frontend->shippingAddress($request , $id);
    }
    public function updateAccount(Request $request)
    {
        $this->validate($request,[
            'full_name'=>'required|string',
            'username'=>'required|string',
            'newpassword' => 'nullable|min:4',
            'oldpassword' => 'nullable|min:4',
            'phone' => 'nullable|numeric|min:8',
        ]);

        return $this->frontend->updateAccount($request);
    }
}

<?php

namespace App\InterFaces\Frontend;


use Illuminate\Database\Eloquent\Model;


interface FrontendRepositoryInterface{

    public function index();

    public function ProductCategory($request,$slug);

    public function AboutUs();

    public function ContactUs();

    public function ContactUsForm($request);
    public function productDetail($slug);

    public function loginSubmit($request);

    public function userAuth();

    public function registerSubmit($request);

    public function userLogout();

    public function shop();

    public function shopFilter($request);

    public function autosearch($request);
    public function search($request);
    public function userDashboard();

    public function billingAddress($request , $id);

    public function shippingAddress($request , $id);

    public function updateAccount($request);
}

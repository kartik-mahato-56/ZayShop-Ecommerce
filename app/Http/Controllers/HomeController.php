<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    //

    public function index(){
        $banner = Banner::all();
        return view('frontend.index',['banner'=>$banner]);
    }
    public function about(){
        return view('frontend.about');
    }

    public function contact(){
        return view('frontend.contact');
    }

    public function product(){

        $product = Product::paginate(6);
        return view('frontend.products',['product'=>$product]);
    }

    public function viewProduct($slug){

        $product = Product::where('slug',$slug)->first();
        return view('frontend.product_details', ['product' => $product]);
    }
}

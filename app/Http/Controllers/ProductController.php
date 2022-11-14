<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\FuncCall;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $product = Product::all();
        return view('admin.admin_products', ['product'=>$product,'category' => $category]);
    }

    public function getsubcategory(Request $request){
        $subcategory = SubCategory::where('category_slug', $request->category_slug)->get();
        return response()->json(['subcategory' => $subcategory]);
    }

    public function addProduct(Request $request){
        $request->validate([
            'product_name' => 'unique:products,name',
        ]);
        $product = new Product();

        $product->name = $request->product_name;
        $product->slug = Str::slug($request->product_name);
        $product->price = $request->product_price;
        $product->details = $request->product_details;
        $product->category_slug = $request->category_slug;
        $product->sub_category_slug = $request->subcategoryslug;


        if($request->hasFile('product_images')){

            foreach($request->file('product_images') as $value){

                $file_type = $value->getClientOriginalExtension();
                $filename = uniqid().'.'.$file_type;
                $value->move(public_path('Gallery/'),$filename);
                $image[] = $filename;
            }
            $product->images = implode(',', $image);
        }

        $product->save();
        return back();

    }

    public function category_wise_view($slug){
        $product = Product::where('sub_category_slug', $slug)->get();

        return view('frontend.category_view',['product'=>$product]);
    }

    public function productDetails($slug){
        $product = Product::where('slug', $slug)->first();
        return view('admin.admin_product_details', ['product' => $product]);
    }
}

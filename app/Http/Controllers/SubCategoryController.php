<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category = Category::all();
        $subCategory = SubCategory::orderBy('slug','ASC')->get();
        return view('admin.sub_category', ['category'=>$category, 'subCategory' => $subCategory]);
    }

   public function addSubCategory(Request $request){
    $request->validate([
        'sub_category_name' => "unique:sub_categories,name",
    ]);
        $subCategory = new SubCategory();
        $subCategory->name = $request->sub_category_name;
        $subCategory->slug = Str::slug($request->sub_category_name,'_');
        $subCategory->category_slug = $request->category_slug;

        $subCategory->save();
        return back();
   }
}

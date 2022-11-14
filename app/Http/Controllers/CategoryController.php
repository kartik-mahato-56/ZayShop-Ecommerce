<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CategoryController extends Controller
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
        return view('admin.category', ['category'=>$category]);
    }

    public function add_category(Request $request){
        $category = new Category();

        $request->validate([
            'category_name' => 'required|unique:categories,name',
        ]);
        $category->name = $request->category_name;
        $category->slug = Str::slug($request->category_name,'_');
        $category->save();
        return back();
    }
}

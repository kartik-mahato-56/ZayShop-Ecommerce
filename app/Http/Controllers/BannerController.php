<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Laravel\Sail\Console\PublishCommand;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $banner = Banner::all();
        return view('admin.banner', ['banner' => $banner]);
    }
    public function addBanner(Request $request){
        $banner = new Banner();
        $banner->name = $request->name;
        $banner->details = $request->details;

        $file_type = $request->file('image')->extension();
        $filename = uniqid().'.'.$file_type;
        $request->file('image')->move(public_path('Banner/'), $filename);
        $banner->image = $filename;
        $banner->save();
        return back();
    }
}

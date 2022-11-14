<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.login');
    }
    public function adminLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password'=>'required'
        ]);
        $admin = Admin::where('email', $request->email)->first();
        if($admin){
            if(Hash::check($request->password, $admin->password)){
                $request->session()->put('ADMIN_ID',$admin->id);
                return Redirect::to('/dashboard');
            }
            else{
                return back()->with('message', 'invalid credentials!');
            }
        }
        else{
            return back()->with('message', 'invalid credentials!');
        }

    }

    public function registerFormLoad(){
        return view('admin.register');
    }
    public function registerAdmin(Request $request){
        $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|confirmed'
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password)
        ]);

        return view('admin.login')->with('message','successfully registred, login with your creadentials');
    }

    public function openDashboard(){
        return View('admin.dashboard');
    }


    public function logout(){
        session()->forget('ADMIN_ID');
        return redirect('admin');
    }
    public function adminProfile(){
        $admin = Admin::find(session('ADMIN_ID'));

        return view('admin.profile_page', ['admin'=>$admin]);
    }
     public function updateProfile(Request $request){
        $admin =  Admin::find($request->id);
        if($request->hasFile('profile_image')){
            $fileExt = $request->file('profile_image')->extension();
            $filename = uniqid().".".$fileExt;

            if($admin->profile_image != ""){
                unlink(public_path('admins/'.$admin->profile_image));
            }
            $request->file('profile_image')->move(public_path('admins/'),$filename);
            $admin->profile_image = $filename;
        }
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone_number = $request->phone_number;

        $admin->save();
        return back()->with('message', 'successfully updated!');
     }

     public function deleteAdminProfileImage($id){
        $admin = Admin::find($id);
    
        if($admin->profile_image != ""){
            unlink(public_path('admins/').$admin->profile_image);
            $admin->profile_image = "";
            $admin->save();
            return back();
        }

     }


    public function changePassword(Request $request){

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $admin = Admin::find($request->id);
        if(Hash::check($request->old_password, $admin->password)){
            if(Hash::check($request->password, $admin->password)){
                return back()->with('message', 'your new password must be different from old password');
            }
            else{
                $admin->password = Hash::make($request->password);
                $admin->save();
                return back()->with('success', 'sucessfullly updated password');
            }
        }
        else{
            return back()->with('pass_error', 'incorrect password!');
        }
    }
}

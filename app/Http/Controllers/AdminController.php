<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



use App\Models\User;
use App\Models\UserTypes;
use App\Models\Business;
use App\Models\Profile;




class AdminController extends Controller
{
    public function index(){
        return view("admin.index");
    }

    public function admin_panel_users(){

        return view("admin.users");

    }

    public function admin_login(){
        if(Auth::check()){
            // if user is already logged in...
            return redirect()->route('welcome');
        }
        else{

            return view("admin.auth.login");
        }
    }

    public function admin_login_check(Request $request){
        $validated = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required"
        ]);

        if(!$validated->fails()){
            // datas are validated. go on
            $user_email = $validated->safe()->only(['email']);

            $user_type = User::where("email", $user_email)->first();

            if($user_type == null){
                return back()->withErrors(['error'=>"Kullanıcı bulunamadı!"])->withInput();

            }
            else{
                $user_type_name = $user_type->user_type->user_type;
                if($user_type_name != "admin"){
                    // user with this e-mail is not admin, redirect to the normal login page.
                    return redirect('/login')->withErrors(['error' => "Sayfayı kullanmaya yetkiniz yok! Bu sayfadan giriş yapın."])->withInput();
    
                }
                else{
                    // user with this e-mail is admin
                    $login_attempt = Auth::attempt($validated->validated());
                    if ($login_attempt) {
                        // e-mail and password are correct, redirect to the admin page..
                        $request->session()->regenerate();
                        
                        return redirect()->route('admin_panel');
                    }
                    else{
                        // e-mail or password is wrong, print error message..
                        return back()->withErrors(['error' => "Kullanıcı adı veya şifre yanlış!"])->withInput();
                    }
                }
            }
                
        }
        else{
            // datas couldn't pass the validation, redirect to same page with errors...
            return redirect('/admin-login')->withErrors($validated);

        }

        

    }

    // Admin -> users
    public function show_users(){
        // user types get admin id..
        $user_type_admin = UserTypes::where("user_type", "admin")->first()->id;

        // get users -> no admin, only fields of id, name, email, active, created_at, updated_at...
        $users = User::where("user_type_id", "!=", $user_type_admin)->select('id','username','email','active','user_type_id','created_at','updated_at')->get();
        return view('admin.users.show', compact('users'));
    }

    public function change_user_activenes(User $user, $user_activeness){
        if($user_activeness == 1){
            $user->active = 0;
        }
        else{
            $user->active = 1;

        }
        $user->save();

        return redirect()->route('admin_users');

    }


    // Admin -> profiles
    public function show_profiles(){

        $profiles = Profile::all();
        
        
        return view("admin.profiles.show", compact("profiles"));
    }
    public function change_profile_activenes(Profile $profile, $activeness){
        if($activeness == true){
            $profile->active = 0;
        }
        else{
            $profile->active = 1;

        }

        $profile->save();

        return redirect()->route("admin_profiles");
    }


    // Admin -> businesess
    public function show_businesess(){
        $businesess = Business::all();

        return view('admin.business.show', compact("businesess"));
    }
    public function create_business(){
        return view('admin.business.create');
    }

    public function store_business(Request $request){
        $validated = $request->validate([
            "business_name" => "string|max:255",
            "business_description" => "string|max:255|nullable",
            "static_ip_adress" => "string|nullable",
            "adress" => "url|nullable",

        ]);

        $business_name = $validated["business_name"];
        $business_description = $validated["business_description"];
        $static_ip_adress = $validated["static_ip_adress"];
        $adress = $validated["adress"];
        $active = 1;

        Business::create([
            'business_name' => $business_name,
            'business_description' => $business_description,
            'static_ip_adress' => $static_ip_adress,
            'adress' => $adress,
            'active' => $active,

        ]);

        return redirect()->route("admin_businesess");




    }
    
    public function change_business_activenes(Business $business, $activeness){
        if($activeness == true){
            $business->active = 0;
        }
        else{
            $business->active = 1;

        }

        $business->save();

        return redirect()->route("admin_businesess");

    }

    public function edit_business(Business $business){

        return view('admin.business.edit', compact('business'));
    }


    public function update_business(Request $request, $business_id){
        
        $validated = $request->validate([
            "business_name" => "string|max:255",
            "business_description" => "string|max:255|nullable",
            "static_ip_adress" => "string|nullable",
            "adress" => "url|nullable",

        ]);

        $business_name = $validated["business_name"];
        $business_description = $validated["business_description"];
        $static_ip_adress = $validated["static_ip_adress"];
        $adress = $validated["adress"];

        $business = Business::where("id",$business_id)->first();
        
        $business->update([
            "business_name" => $business_name,
            "business_description" => $business_description,
            "static_ip_adress" => $static_ip_adress,
            "adress" => $adress,

        ]);
        
        return redirect()->route("admin_businesess");

    }

    public function delete_business($business_id){

        return view('admin.business.delete', compact('business_id'));
    }

    public function delete_business_done($business_id){
        $business = Business::where("id", $business_id)->first();

        $business->delete();

        return redirect()->route("admin_businesess");


    }
}

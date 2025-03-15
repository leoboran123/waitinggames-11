<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


use App\Models\User;
use App\Models\UserTypes;
use App\Models\Category;
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
        $users = User::where("user_type_id", "!=", $user_type_admin)->select('id','name','email','active','user_type_id','created_at','updated_at')->get();
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

    // Admin -> categories
    public function show_categories(){
        $categories = Category::all();

        return view('admin.categories.show', compact('categories'));
    }

    public function change_category_activenes(Category $category, $category_activeness){
        if($category_activeness == 1){
            $category->active = 0;
        }
        else{
            $category->active = 1;
        }
        $category->save();

        return redirect()->route('admin_categories');

    }

    public function edit_category(Category $category){
        $old_values = $category;

        return view('admin.categories.edit', compact('category', 'old_values'));
    }

    public function update_category(Request $request, $categoryId){
           
        $validated = $request->validate([
            "name" => "required|max:255",
            "description" => "max:255",
            "image" => "image|nullable", 
        ]);
        
        $name = $validated["name"];
        $description = $validated["description"];
        $checkImage = $request->hasFile('image');

        // Category to be updated;
        $category = Category::where("id", $categoryId)->first();


        if($checkImage == true){
            $image = $validated["image"];

            $imagePath = $image->store('category_pictures', 'public');

            $category->update([
                "name" => $name,
                "description" => $description,
                "image" => $imagePath,
            ]);
        }
        else{
            
            $category->update([
                "name" => $name,
                "description" => $description,
            ]);
        }

        return redirect()->route("admin_categories");
        
    }

    public function delete_category($categoryId){

        return view("admin.categories.delete", compact("categoryId"));
    }

    public function delete_category_done($categoryId){
        
        $category = Category::where("id", $categoryId)->first();
        $category->delete();

        Profile::where("category_id", $categoryId)->update(['category_id' => 1]);

        return redirect()->route("admin_categories");
    }

    public function create_category(){
        return view("admin.categories.create");
    }

    public function store_category(Request $request){
        $validated = $request->validate([
            "name" => "string|max:255",
            "description" => "string:max:255",
            "image" => "image",
        ]);

        $name = $validated["name"];
        $description = $validated["description"];
        $name_fixed = strtoupper($name);
        $slug = Str::slug($name,'-');
        $checkImage = $request->hasFile('image');


        if($checkImage == true){
            $image = $validated["image"];

            $imagePath = $image->store('category_pictures', 'public');

            Category::create([
                'name' => $name,
                'description' => $description,
                'image' => $imagePath,
                'active' => 1,
                'name_fixed' => $name_fixed,
                'slug' => $slug,
            ]);

            return redirect()->route("admin_categories");
        }
        else{
            Category::create([
                'name' => $name,
                'description' => $description,
                'active' => 1,
                'name_fixed' => $name_fixed,
                'slug' => $slug,
            ]);

            return redirect()->route("admin_categories");
        }

    }

    public function show_profiles(){
        $profiles = Profile::all();

        return view("admin.profiles.show", compact("profiles"));
    }

    // Admin -> profiles

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

    //STORE'U DA BİTİRDİN, ŞİMDİ PROFİLLER İÇİN ADMİN PANELİ YAP!!! 
    // AYRICA SİLİNEN KATEGORİLER BAZI PROFİLLERE BAĞLI OLABİLİR
    // SİLİNDİKLERİ ZAMAN NE OLACAĞINA KARAR VER!
    // devamı gelsin
    // ------------------------------
}

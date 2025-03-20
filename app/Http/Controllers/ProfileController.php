<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Profile;
use App\Models\Category;


class ProfileController extends Controller
{
    public function index(){
        $user = auth()->user();

        $user_profile = Profile::where("user_id", $user->id)->first();
        $user_type_id = $user->user_type_id;
        

        return view("profile.index", compact("user_profile", "user_type_id"));
    }

    public function show($slug, $url){
        $profile = Profile::where("url", $url)->first();

        return view("profile.show", compact("profile"));
    }

    public function edit(){
        $categories = Category::all()->pluck('name')->toArray();
        $old_values = auth()->user()->profile;

        return view("profile.edit", compact('categories', 'old_values'));
    }

    public function update(Request $request){
        $validated = $request->validate([
            'name' => 'max:255',
            'description'  => 'max:255',
            'category' => 'max:255',
            'image' => 'image|nullable',
            'static_ip_adress' => 'max:255|nullable'
        ]);


        $name = $validated["name"];
        $description = $validated["description"];
        $category = $validated["category"];
        $static_ip_adress = $validated["static_ip_adress"];


        $category_id = Category::where('name', $category)->first()->id;

        $checkImage = $request->hasFile('image');

        if($checkImage == true){
            $image = $validated["image"];
            
            

            // $imagePath = $image->store('profile_pictures', 'public');
            $imageName = Str::uuid(). "." . $image->getClientOriginalExtension();
            $imagePath = 'profile_pictures/'.$imageName;

            Storage::disk(env('FILESYSTEM'))->put($imagePath, file_get_contents($image));

            auth()->user()->profile()->update([
                'profile_name' => $name,
                'description' => $description,
                'category_id' => $category_id,
                'image' => $imagePath,
                'static_ip_adress' => $static_ip_adress,
            ]);

        }
        else{
            auth()->user()->profile()->update([
                'profile_name' => $name,
                'description' => $description,
                'category_id' => $category_id,
                'static_ip_adress' => $static_ip_adress,


            ]);
        }

        return redirect("/profile");
        
    }

    public function create()
    {   
        if(auth()->user()->profile()->exists()){
            return redirect('/profile');
        }
        else{
            $categories = Category::all()->pluck('name')->toArray();
            
            return view("profile.create", compact("categories"));
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'max:255',
            'description'  => 'max:255',
            'category' => 'max:255',
            'image' => 'image|nullable',
        ]);


        $name = $validated["name"];
        $description = $validated["description"];
        $category = $validated["category"];
        $url = Str::slug($name,'-');

        $category_id = Category::where('name', $category)->first()->id;

        $checkImage = $request->hasFile('image');

        if($checkImage == true){
            $image = $validated["image"];

            // $imagePath = $image->store('profile_pictures', 'public');
            $imageName = Str::uuid(). "." . $image->getClientOriginalExtension();
            $imagePath = 'profile_pictures/'.$imageName;

            Storage::disk(env('FILESYSTEM'))->put("public/".$imagePath, file_get_contents($image));

            auth()->user()->profile()->create([
                'profile_name' => $name,
                'description' => $description,
                'category_id' => $category_id,
                'url' => $url,
                'image' => $imagePath,
            ]);

        }
        else{
            // use default picture if there is no image uploaded
            $imagePath = 'default_pictures/kuafor.jpg';

            auth()->user()->profile()->create([
                'profile_name' => $name,
                'description' => $description,
                'category_id' => $category_id,
                'url' => $url,
                'image' => $imagePath,


            ]);
        }

        return redirect("/profile");
    }

}

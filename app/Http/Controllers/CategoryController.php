<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Profile;

use Spatie\Dropbox\Client;

class CategoryController extends Controller
{
    public function welcome()
    {
        $all_categories = Category::all();
        

        return view('welcome', compact("all_categories"));
    }


    public function show(Category $category)
    {
        // Get and show all corporates by category...
        
        $profiles = Profile::where("category_id", $category->id)->where("active", 1)->get();

        return view('category.show', compact("profiles", "category"));


    }


    public function search(Request $request){
        
        $profiles = Profile::where("active", 1)
        ->where(function ($query) use ($request) {
            $query->where("profile_name",'like','%'.$request["search"].'%')
                ->orWhere("description",'like','%'.$request["search"].'%');
        })
        ->orderBy("id", "DESC")
        ->get();


        $all_categories = Category::where("active", 1)
        ->where(function ($query) use ($request) {
            $query->where("name", "like", "%" . $request["search"] . "%")
                ->orWhere("description", "like", "%" . $request["search"] . "%")
                ->orWhere("name_fixed", "like", "%" . $request["search"] . "%");
        })
        ->orderBy("id", "DESC")
        ->get();


        return view("category.search", compact("profiles","all_categories"));
    }

}

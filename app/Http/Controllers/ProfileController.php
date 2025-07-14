<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Profile;
use App\Models\GameScores;



class ProfileController extends Controller
{
        protected $leaderboard_count = 50;



        public function index(){
        $user = auth()->user();

        $user_profile = Profile::where("user_id", $user->id)->first();
        $user_type_id = $user->user_type_id;


        date_default_timezone_set("Europe/Istanbul");
        $current_interval_date = date('m-Y');

        $user_game_stats = GameScores::where("user_id", $user->id)->where('date_interval', $current_interval_date)->where("active",1)->max('score');


        $leaderboard_user_stat = GameScores::where('date_interval', $current_interval_date)->orderBy('score','DESC')
        ->paginate($this->leaderboard_count);

        
        return view("profile.index", compact("user_profile", "user_type_id", "user_game_stats","leaderboard_user_stat"));
    }

    public function edit(){
        $old_values = auth()->user()->profile;

        return view("profile.edit", compact( 'old_values'));
    }

    public function update(Request $request){
        $validated = $request->validate([
            'name' => 'string|max:255',
            'surname'  => 'string|max:255',
        ]);


        $name = $validated["name"];
        $surname = $validated["surname"];


        auth()->user()->profile()->update([
            'name' => $name,
            'surname' => $surname,

        ]);

        return redirect("/profile");
        
    }

    public function create()
    {   
        if(auth()->user()->profile()->exists()){
            return redirect('/profile');
        }
        else{
            
            return view("profile.create");
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'surname' => 'string|max:255',
        ]);


        $name = $validated["name"];
        $surname = $validated["surname"];


        auth()->user()->profile()->create([
            'name' => $name,
            'surname' => $surname,

        ]);

        return redirect("/profile");
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameScores;


class HouseController extends Controller
{
    //
    protected $leaderboard_count = 50;


    public function welcome(){

        // leaderboard;
        date_default_timezone_set("Europe/Istanbul");
        $current_interval_date = date('m-Y');

        $leaderboard_user_stat = GameScores::where('date_interval', $current_interval_date)->orderBy('score','DESC')
        ->paginate($this->leaderboard_count);

        
        return view("welcome", compact("leaderboard_user_stat"));
    }
}

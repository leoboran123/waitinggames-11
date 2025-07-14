<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \DateTime;

use App\Models\GameScores;


class HouseController extends Controller
{
    //
    protected $leaderboard_count = 50;


    public function welcome(){

        // leaderboard;
        // get current date interval
        date_default_timezone_set("Europe/Istanbul");
        $current_interval_date = date('m-Y');

        $leaderboard_user_stat = GameScores::selectRaw('game_scores.*') // Tüm sütunları seç
        ->join('users', 'game_scores.user_id', '=', 'users.id')
        ->where('users.active', 1)
        ->where('game_scores.active', 1)
        ->where('game_scores.date_interval', $current_interval_date)
        ->whereRaw('game_scores.score = (SELECT MAX(score) FROM game_scores gs WHERE gs.user_id = game_scores.user_id AND gs.date_interval = ? AND gs.active=1)', [$current_interval_date])
        ->orderBy('game_scores.score', 'DESC')
        ->paginate($this->leaderboard_count);


        $check_user_is_logged_in = Auth::check();

        // countdown elements..
        $countdown = date_create(date('t-m-Y 23:59:00'));
        
        $countdown = date_format($countdown, "M d, Y H:i:s");
       
        // get last months date interval
        date_default_timezone_set("Europe/Istanbul");
        $current_interval_date = date('m-Y');
        
        $last_interval = explode("-",$current_interval_date);

        $last_interval_month = (int)$last_interval[0] - 1;

        // new year;
        if($last_interval_month <= 0){
            $last_interval_month = 12;
            $last_interval_year = (int)$last_interval[1] - 1; 
        }
        else{
            $last_interval_year = $last_interval[1];
        }

        // if month is smaller than 10, add 0 to the beginning.
        if($last_interval_month < 10){
            $last_interval_month = "0".$last_interval_month;
        }

        $last_interval_date = (string)$last_interval_month."-".(string)$last_interval_year;

        // get the former leaderboard
        $former_leaderboard = GameScores::selectRaw('game_scores.*') // Tüm sütunları seç
        ->join('users', 'game_scores.user_id', '=', 'users.id')
        ->where('users.active', 1)
        ->where('game_scores.active', 1)
        ->where('game_scores.date_interval', $last_interval_date)
        ->whereRaw('game_scores.score = (SELECT MAX(score) FROM game_scores gs WHERE gs.user_id = game_scores.user_id AND gs.date_interval = ? AND gs.active=1)', [$last_interval_date])
        ->orderBy('game_scores.score', 'DESC')
        ->paginate($this->leaderboard_count);


        return view("welcome", compact("leaderboard_user_stat", "check_user_is_logged_in", "countdown", "former_leaderboard"));
    }
}

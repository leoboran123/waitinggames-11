<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GameScores;
use League\CommonMark\Extension\CommonMark\Parser\Inline\EscapableParser;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    //

    public function index(){

        return view('game.index');
    }

    public function store_score(Request $request){
        $validated = $request->validate([
            'score' => 'required'
        ]);
        
        $score = $validated['score'];
        if($score == 0){
            return "Score saved!";
        }
        else{

            date_default_timezone_set("Europe/Istanbul");
            $current_interval_date = date('m-Y');
            
            
            auth()->user()->gamescore()->create([
                'score' => $score,
                'date_interval' => $current_interval_date,
                'active' => 1,
                
            ]);
            
            return "Score saved";
        }        
    }
}

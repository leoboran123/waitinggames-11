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
use App\Models\GameScores;





class AdminController extends Controller
{
    protected $leaderboard_count = 50;

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
        $users = User::where("user_type_id", "!=", $user_type_admin)
        ->select('id','username','email','active','user_type_id','created_at','updated_at')
        ->orderBy('active', 'ASC')
        ->get();
        
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

        
        $profiles = Profile::orderBy('active', 'ASC')->get();

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
        $businesess = Business::orderBy('active', 'ASC')->get();

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

    public function admin_gamescore(){

        // leaderboard;
        // get current date interval
        date_default_timezone_set("Europe/Istanbul");
        $current_interval_date = date('m-Y');

        $leaderboard_user_stat = GameScores::selectRaw('game_scores.*') // Tüm sütunları seç
        ->join('users', 'game_scores.user_id', '=', 'users.id')
        ->where('users.active', 1)
        ->where('game_scores.date_interval', $current_interval_date)
        ->whereRaw('game_scores.score = (SELECT MAX(score) FROM game_scores gs WHERE gs.user_id = game_scores.user_id AND gs.date_interval = ?)', [$current_interval_date])
        ->orderBy('game_scores.score', 'DESC')
        ->paginate($this->leaderboard_count);



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
        ->where('game_scores.date_interval', $last_interval_date)
        ->whereRaw('game_scores.score = (SELECT MAX(score) FROM game_scores gs WHERE gs.user_id = game_scores.user_id AND gs.date_interval = ?)', [$last_interval_date])
        ->orderBy('game_scores.score', 'DESC')
        ->paginate($this->leaderboard_count);
        

        // old way
        // $former_leaderboard = GameScores::where('date_interval', $last_interval_date)
        // ->join('users', 'game_scores.user_id' , '=', 'users.id')
        // ->where('users.active', 1)
        // ->where('game_scores.active', 1)
        // ->groupBy('users.id')
        // ->orderBy('game_scores.score','DESC')
        // ->paginate($this->leaderboard_count);
        

        return view("admin.game.show", compact("leaderboard_user_stat", "former_leaderboard"));
    }

    public function change_gamescore_activenes(GameScores $gamescore, $activeness){
        if($activeness == true){
            $gamescore->active = 0;
        }
        else{
            $gamescore->active = 1;

        }

        $gamescore->save();
        
        return redirect()->route('admin_gamescore');

    }
}

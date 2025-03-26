<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameScores extends Model
{
    //
    protected $fillable=['score','date_interval','active','created_at','updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

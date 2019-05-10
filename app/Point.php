<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    //　5/6テスト用。latitude, longitudeはfillableではないかも。
    protected $fillable = [
        'area', 'prefecture', 'belowPrefecture', 'latitude', 'longitude'
    ];
    
    public function favoritesUser()
    {
        return $this->belongsToMany(User::class, "favorites", "point_id", "user_id");
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function categoryMonths()
    {
        return $this->hasMany(CategoryMonth::class);
    }
}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'icon'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function favoritesPoint()
    {
        return $this->belongsToMany(Point::class, "favorites", "user_id", "point_id");
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    
    
    
    //お気に入り機能
    public function favorites($point_id){
        //既にお気に入りしているかの確認
        $exist = $this->is_favorite($point_id);
        
        if($exist){
            return false;
        }else{
            $this->favoritesPoint()->attach($point_id);
            return true;
        }
    }
    
    public function unfavorites($point_id){
        //既にお気に入りしているかの確認
        $exist = $this->is_favorite($point_id);
        
        if($exist){
            $this->favoritesPoint()->detach($point_id);
            return true;
        }else{
            return false;
        }
    }
    
    public function is_favorite($point_id){
        return $this->favoritesPoint()->where("point_id", $point_id)->exists();
    }
}

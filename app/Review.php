<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'userID', 'pointID', 'category1', 'category2', 'category3', 'month', 'review', 'comment', 'reviewDate'
    ];
            
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function point()
    {
        return $this->belongsTo(Point::class);
    }
}

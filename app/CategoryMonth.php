<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryMonth extends Model
{
    protected $table = 'categorymonths';
    
    protected $fillable = ['pointID', 'category', 'months'];

    public function point()
    {
        return $this->belongsTo(Point::class);
    }
}

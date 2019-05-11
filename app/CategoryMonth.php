<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryMonth extends Model
{
    protected $table = 'categoryMonths';
    
    protected $fillable = ['pointID', 'category', 'months'];

    public function point()
    {
        return $this->belongsTo(Point::class);
    }
}

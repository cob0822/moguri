<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryMonth extends Model
{
    protected $table = 'categoryMonths';
    
    protected $fillable = ['pointID', 'category', 'Jan', 'Feb', 'Mar', 'Apl', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    public function point()
    {
        return $this->belongsTo(Point::class);
    }
}

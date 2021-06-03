<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
     /**
      * The attributes that should be cast to native types.
      *
      * @var array
      */
     protected $casts = [
         'skills' => 'array',
     ];

    public function ctg()
    {
        return $this->belongsTo(ProjectCategory::class,"ctg_id");
    }
}

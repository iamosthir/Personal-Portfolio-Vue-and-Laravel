<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public function ctg()
    {
        return $this->belongsTo(BlogCategoryController::class,"ctg_id");
    }
}

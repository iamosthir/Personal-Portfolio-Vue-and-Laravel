<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'desc',
        'image',
        'album_id'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class,"album_id");
    }
}

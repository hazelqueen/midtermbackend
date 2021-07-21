<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'artist',
        'genre',
        'album',
        'date_released'
    ];

    public function container() {
        return $this->belongsTo('App\Models\Music', 'artist', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameModel extends Model
{
    use HasFactory;

    protected $table = 'videogames';

    protected $fillable = [
        'name',
        'category_id',
        'status',
        'price'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commentModel extends Model
{
    use HasFactory;

    public $table = 'film_comments';

    protected $fillable = ['name' , 'comment'];
}

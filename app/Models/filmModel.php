<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\genreModel as Genre;

class filmModel extends Model
{
    use HasFactory;

    public $table = 'films';

    protected $fillable = ['name' , 'description' , 'release_date' , 'rating' , 'ticket_price', 'country', 'image'];

    public function Genres () {
        return $this->hasMany(Genre::class , 'film_id' , 'id');
    }

}

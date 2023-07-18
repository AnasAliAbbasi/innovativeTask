<?php


namespace App\Traits;
use App\Models\filmModel as Film;

class FilmsTraits {


    public static function getFilmsListing () {
        $films = Film::with('Genres')->get();
        return $films;
    }

}

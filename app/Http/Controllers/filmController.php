<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FilmsTraits;

class filmController extends Controller
{
    public function getFilms (Request $request)  {

        try{

            $response = FilmsTraits::getFilmsListing();

            if(!empty($response) && count($response) > 0) {
                return response()->json([
                    'status' => 200,
                    'message' => 'films fetched successfully',
                    'body' => $response
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'data not found'
                ]);
            }

        }catch(\Exception $e){

            return response()->json([
                'status' => 500,
                'message' => 'something went wrong'
            ]);
        }



    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FilmsTraits;
use GuzzleHttp\Client;
use App\Models\filmModel as Film;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class filmController extends Controller
{


    public function getFilmFromApi (Request $request) {

        // $client = new Client();
        // $url = 'http://localhost:8000/api/get/films'; // Replace with the actual API endpoint URL

        // // try {
        //     $response = $client->get($url);
        //     $statusCode = $response->getStatusCode();

        //     if ($statusCode === 200) {
        //         $data = json_decode($response->getBody(), true);

        //         dd($statusCode);

        //     } else {
        //         return response()->json(['error' => 'API request failed'], $statusCode);
        //     }
        // // } catch (\Exception $e) {
        // //     // Handle any exceptions that occur during the API request
        // //     return response()->json(['error' => 'API request failed: ' . $e->getMessage()], 500);
        // // }

        $films = Film::with('Genres')->paginate(1);

        return view('welcome' , [
            'data' => $films
        ]);
    }

    public function getIndividualFilm (Request $request , $id) {

        try{
            $d_id = Crypt::decrypt($id);
            $response = FilmsTraits::getIndividualFilm($d_id);

            if($response != null) {
                return view('film_desc' , [
                    'data' => $response
                ]);
            }
        }catch(\Exception $e){
            Session::flash('error' , 'Something Went Wrong');
            return redirect('/');
        }



    }


    public function saveComment (Request $request , $id) {

        try{

            $response = FilmsTraits::saveComment($request , $id);

            if($response != null) {
                Session::flash('success' , 'Comment Saved');
                return redirect('film/'.Crypt::encrypt($id));
            }

        }catch(\Exception $e){
            Session::flash('error' , 'Comment Not Saved');
            return redirect('film/'.Crypt::encrypt($id));
        }

    }


    public function AddFilm (Request $request) {
        return view('addfilm');
    }

    public function insertMovie (Request $request) {

        
    }
}
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilmsListingTest extends TestCase
{

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response = $this->get('film-create');


        $response->assertStatus(200);
        $filmData = [
            "name" => "fiml_1",
            "description"=>  "In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia\n",
            "release_date"=> "2023-07-19",
            "rating"=> 5,
            "ticket_price"=> 500,
            "country"=> "pakistan",
            "image"=> "photo.jpeg"
        ];

        $this->post('insert/movie', $filmData);
        $this->assertDatabaseHas('films', $filmData);
        $response->assertStatus(200);
    }
}









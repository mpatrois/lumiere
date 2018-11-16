<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\User;
use Storage;
use Faker;
use Carbon\Carbon;

class VideoController extends Controller
{

    function __construc(){
        $this->middleware('auth', ['only' => ['store', 'delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $videos = Video::all();
      return $videos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $file = $request->file('file');
        $uniqId = $this->gen_uuid();
        $nameFile = $uniqId . '.' . $file->getClientOriginalExtension();
        $shortPath = "app/videos/$nameFile";
        $shortPreviewPath = "/thumbs/$uniqId.png";
        $pathFile = storage_path('app/videos/');
        $file->move($pathFile, $nameFile);

        $parts = explode(',', $request->videoPreview);  
        $base64_str = $parts[1];  
        $image = base64_decode($base64_str);
        Storage::disk('local')->put($shortPreviewPath, $image);
        $video = new Video([
            'title' => $request->title,
            'description' => $request->description,
            'path' => $shortPath,
            'url_preview' => $shortPreviewPath
        ]);

        $video->user_id = $request->user()->id;
        $video->save();

       return $video;
	}
		

    function preview($id){
        $video = Video::find($id);
        return response()->download(storage_path("/app/$video->url_preview"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::find($id);
        $users = User::all();
        $faker = Faker\Factory::create();
        $fakesComments = [];
        for ($i=0; $i < 50; $i++) { 
            // dd($faker->date($format = 'Y-m-d', $max = 'now'));
            $fakeDate = Carbon::create(2018, rand(0,12), rand(0,28), 0, 0, 0);
            $fakesComments[] = [
                'user' => $users[rand(0, count($users)-1)],
                'content' => $faker->text(146),
                'date' =>  $fakeDate->diffForHumans(),
                'nbComments' => rand(0,30),
                'nbLikes' => rand(0,30),
            ];
        }
        $video->comments = $fakesComments;
        return $video;
	}
		

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function play($id)
    {
        $video = Video::find($id);
        return response()->download(storage_path($video->path));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    private function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,
            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

}

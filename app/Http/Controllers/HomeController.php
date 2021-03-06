<?php

namespace App\Http\Controllers;

use App\Album;
use App\Biography;
use App\Episode;
use App\Guest;
use App\Personal;
use App\Testimonial;
use App\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phrases=array();
        $tempphrases=Biography::take(3)->get(['phrase']);
        for($i=0;$i<count($tempphrases);$i++){
            array_push($phrases,$tempphrases[$i]->phrase);
        }
        $videos=Video::take(6)->get();
        $guests=Guest::take(3)->get();
        $episodes=Episode::take(4)->get();
        $tempalbum=Album::take(4)->get();
        $albums=array();
        for ($i=2;$i<count($tempalbum);$i++){
            array_push($albums,[
                'id'=>$tempalbum[$i]->id,
                'title'=>$tempalbum[$i]->title,
                'size'=>$tempalbum[$i]->size,
                'photos'=>Album::find($tempalbum[$i]->id)->photos(),
                'description'=>$tempalbum[$i]->description,
            ]);
        }
        $lsidegallery=['id'=>$tempalbum[0]->id,
            'title'=>$tempalbum[0]->title,
            'size'=>$tempalbum[0]->size,
            'photos'=>Album::find($tempalbum[0]->id)->photos(),
            'description'=>$tempalbum[0]->description];
        $rsidegallery=['id'=>$tempalbum[1]->id,
            'title'=>$tempalbum[1]->title,
            'size'=>$tempalbum[1]->size,
            'photos'=>Album::find($tempalbum[1]->id)->photos(),
            'description'=>$tempalbum[1]->description,];
        $testimonials=Testimonial::take(4)->get();
        $jobTitle=Personal::where('type','jobtitle')->get(['info']);
        $shortBrief=Personal::where('type','brief')->get(['info']);
        $data=array('shortBrief' =>$shortBrief[0]->info,
            'jobTitle'=>$jobTitle[0]->info,
            'name'=>'JESSY El-MURR',
            'phrases'=>$phrases,
            'videos'=>$videos,
            'guests'=>$guests,
            'episodes'=>$episodes,
            'gallery'=>$albums,
            'lsidegallery'=>$lsidegallery,
            'rsidegallery'=>$rsidegallery,
            'testimonials'=>$testimonials,
        );
        $data = json_encode($data);
        return view('Visitor_pages.index')->with('data',$data);
//        return $data;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}

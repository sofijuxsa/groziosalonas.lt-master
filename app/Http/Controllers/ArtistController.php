<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\ServiceArtist;
use Illuminate\Http\Request;
use App\Models\Artist;
use Illuminate\Support\Facades\Auth;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['filterArtist']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $artist = new Artist();
        $artist->last_name = $request->post('last_name');
        $artist->email = $request->post('email');
        $artist->password = $request->post('password');
        $artist->phone_number = $request->post('phone_number');
        $artist->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        $this->middleware('auth');

        $id = Auth::id();
        $artist = Artist::query()->findOrFail($id);

        return view('artist.edit', ['artist' => $artist]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        $id = Auth::id();
        $artist = Artist::query()->findOrFail($id);
        $artist->name = $request->post('name');
        $artist->last_name = $request->post('last_name');
        $artist->email = $request->post('email');
        $artist->password = $request->post('password');
        $artist->phone_number = $request->post('phone_number');
        $artist->save();

        return redirect()->back();
    }

    public function mySchedule(Artist $artist)
    {
        $id = Auth::id();
        $data['schedule'] = Schedule::query()->where('artist_id', $id)->get();
        return view('artist.schedule', $data);
    }

    public function myReservations(Artist $artist)
    {
        $id = Auth::id();
        $data['bookings'] = Booking::query()->where('artist_id', $id)->get();
        return view('artist.bookings', $data);
    }

    public function filterArtist(Request $request)
    {
        $artistId = [];
        $service_id = $request->post('id');

        $data = ServiceArtist::query()->where('service_id', $service_id)->get();

        foreach ($data as $obj)
        {
            $artistId[] = $obj->artist_id;
        }

        $data['artists'] = Artist::query()->whereIn('id', $artistId)->get();

        if (isset($data['artists'])){
            return response()->json($data['artists']);
        }else{
            return response()->json(1);
        }

    }
}

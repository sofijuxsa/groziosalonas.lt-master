<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $booking = new Booking();
        $booking->artist_id = $request->post('chooseArtist');
        $booking->service_id = $request->post('chooseService');
        $booking->active = 1;
        $booking->date = $request->post('date');
        $booking->start_time = $request->post('time');

        $duration = Service::query()->select('duration')->where('id', $booking->service_id)->first();
        $booking->end_time = date('H:i:s', strtotime($duration['duration']) + strtotime($booking->start_time));
        $booking->save();

        $client = new Client();
        $client->name = $request->post('name');
        $client->email = $request->post('email');
        $client->phone_number = $request->post('phone_number');
        $client->save();

        return view('home');
    }

    public function create()
    {
        $data['services'] = Service::query()->where('parent_id', 0)->get();
        return view('booking.form', $data);
    }

    public function delete(Request $request)
    {
        $booking_id = $request->post('delete');
        Booking::query()->where('id', $booking_id)->delete();

        return redirect()->back();
    }

    public function changeActivity(Request $request)
    {
        $booking_id = $request->post('activity');

        $booking =  Booking::query()->select()->where('id', $booking_id)->first();

        if ($booking->active == '1') {
            $booking->active = '0';
            $booking->save();
        }
        elseif ($booking->active == '0') {
            $booking->active = '1';
            $booking->save();
        }

        return redirect()->back();
    }

    public function filterBooking(Request $request)
    {
        $artist_id = $request->post('artist');
        $date = $request->post('date');
        $disabledRanges = [];

        $disabledTimes = Booking::query()->where('artist_id', $artist_id)
                    ->where('date', $date)
                    ->get();

        foreach ($disabledTimes as $time){
            $range = [date('H:i', strtotime($time->start_time)), date('H:i', strtotime($time->end_time))];
            $disabledRanges[] = $range;
        }

        return response()->json($disabledRanges);
    }
}

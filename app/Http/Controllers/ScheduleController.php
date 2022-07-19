<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Booking;
use App\Models\Schedule;
use App\Models\ServiceArtist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['filterSchedule']]);
    }

    public function create()
    {
        return view('schedule.form');
    }

    public function store(Request $request)
    {
        $schedule = new Schedule();
        $schedule->date = $request->post('date');
        $schedule->artist_id = $request->post('artist_id');
        $schedule->save();
    }

    public function show(Schedule $schedule)
    {
        $id = Auth::id();
        $data['schedules'] = Schedule::query()->where('artist_id', $id)->get();
        return view('schedule.edit', $data);
    }

    public function edit(Schedule $schedule)
    {
        $data['schedule'] = $schedule;
        return view('schedule.edit', $data);
    }

    public function update(Request $request, Schedule $schedule)
    {
        $schedule->date = $request->post('date');
        $schedule->service_id = $request->post('service_id');
        $schedule->start_time = $request->post('start_Time');
        $schedule->end_time = $request->post('end_time');
        $schedule->is_active = $request->post('is_active');
        $schedule->save();
    }

    public function disableDay(Request $request, Schedule $schedule)
    {
        $schedule = new Schedule();
        $schedule->artist_id = Auth::id();
        $schedule->date = $request->post('disableDay');

        $schedule->save();
        return view('schedule.form');
    }

    public function enableDay(Request $request, Schedule $schedule)
    {
        $artist_id = Auth::id();
        $date = $request->post('enableDay');

        Schedule::query()->select()->where('date', $date)->where('artist_id', $artist_id)->delete();

        return view('schedule.form');

    }

    public function filterSchedule(Request $request, Schedule $schedule)
    {
        $disabledDates = [];
        $artist_id = $request->post('id');
        $data = Schedule::query()->select('date')->where('artist_id', $artist_id)->get();

        foreach ($data as $date) {
            $disabledDates[] = $date->date;
        }

        return response()->json($disabledDates);
    }

    public function filterSchedule2(Schedule $schedule)
    {
        $disabledDates = [];
        $artist_id = Auth::id();
        $data = Schedule::query()->select('date')->where('artist_id', $artist_id)->get();
        foreach ($data as $date) {
            $disabledDates[] = $date->date;
        }

        return response()->json(str_replace('/', '-', $disabledDates));

    }

}

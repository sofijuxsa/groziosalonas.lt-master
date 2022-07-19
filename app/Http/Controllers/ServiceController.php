<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {

    }

    public function show(Service $service)
    {
        $data['services'] = Service::query()->where('parent_id', 0)->get();
        return view('services', $data);
    }

    public function getDuration(Request $request)
    {
        $service_id = $request->post('id');
        $start_time = $request->post('time');

        $duration = Service::query()->select('duration')->where('service_id', $service_id)->get();
    }
}

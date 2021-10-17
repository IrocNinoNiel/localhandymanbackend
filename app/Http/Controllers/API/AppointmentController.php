<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller as Controller;

class AppointmentController extends Controller
{
   
    public function index()
    {
        $appointment = Appointment::all();

        return response()->json([
            'success' => true,
            'message' => 'Appointment Lists',
            'data' => $appointment
        ]);
    }

    public function submitAppointment(Request $request)
    {

        $this->validate($request,[
            'details'=>'required',
            'hours'=>'required',
            'time'=>'required',
            'date'=>'required',
            'phone_num'=>'required'
        ]);
        
        $appointment = new Appointment;

        $appointment->details = $request->details;
        $appointment->hour_limit = $request->hours;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->phone_num = $request->phone_num;
        $appointment->user_id = Auth::user()->id;

        $appointment->save();

        return response($appointment,200);

        return response()->json([
            'success' => true,
            'message' => 'Appointment Added',
            'data' => $appointment
        ]);

        // $request->user()->posts()->create([
        //     'details' => $request->details,
        //     'hour_limit' => $request->hours,
        //     'date' => date('mm/dd/yy'),
        //     'time' => $request->time,
        //     'phone_num' => $request->phone_num,
        // ]);

        // return $this->sendResponse($appointment, 'Product created successfully.');

    }
}

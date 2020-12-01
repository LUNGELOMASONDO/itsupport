<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AppointmentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'issue' => ['required', 'string', 'min:2', 'max:100'],
            'description' => ['required', 'string', 'min:5', 'max:355'],
            'slotday' => ['required', 'string'],
            'slottime1' => ['required', 'string'],
            'slottime2' => ['nullable', 'string'],
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
    
        //$this->validator($data)->validate();

        $user = Auth::user();
        $appointment = new Appointment;

        $appointment->user_id = $user->id;
        $appointment->issue = $data['issue'];
        $appointment->description = $data['description'];
        $appointment->the_day = $data['slotday'];
        $appointment->save();

        $finalResult = DB::table('appointment_slot')->insert([
            'appointment_id' => $appointment->id,
            'slot_id' => $data['slottime1']
        ]);

        $finalResult = DB::table('notifications')->insert([
            'message' => "Your appointment has been sent through",
            'is_read' => false,
            'user_id' => $user->id
        ]);

        return back();
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

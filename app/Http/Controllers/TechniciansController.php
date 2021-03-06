<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Technician;
use App\Models\TheJob;
use App\Models\Appointment;

class TechniciansController extends Controller
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
        return view('user');
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
    public function showTechnician($id)
    {
        $technician = Technician::find($id); // technician info

        $pendingjobs = DB::select(DB::raw("SELECT thejobs.id AS job_id, appointments.issue AS issue, appointments.the_day AS theday, (SELECT users.name FROM users WHERE appointments.user_id=users.id) AS username FROM appointments, thejobs, users WHERE appointments.id=thejobs.appointment_id AND users.id=:technician AND appointments.technician_id=users.id AND thejobs.job_done IS NULL"), array(
            'technician' => $id
        ));

        $donejobs = DB::select(DB::raw("SELECT thejobs.id AS job_id, appointments.issue AS issue, appointments.the_day AS theday, thejobs.job_done AS done_at, (SELECT users.name FROM users WHERE appointments.user_id=users.id) AS username FROM appointments, thejobs, users WHERE appointments.id=thejobs.appointment_id AND users.id=:technician AND appointments.technician_id=users.id AND thejobs.job_done IS NOT NULL"), array(
            'technician' => $id
        ));

        $availablejobs = DB::select(DB::raw("SELECT appointments.issue AS issue, appointments.description AS the_desc, appointments.the_day AS theday FROM appointments, users WHERE users.id=:technician AND appointments.technician_id IS NULL"), array(
            'technician' => $id
        ));

        $data = [
            'technician' => $technician,
            'pendingjobs' => $pendingjobs,
            'donejobs' => $donejobs,
            'availablejobs' => $availablejobs
        ];
        
        return view('technician.profile')->with($data);
    }

    public function changeJobStatus()
    {

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'appointments';

     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 
     * 
     */
    public function appointable()
    {
        return $this->morphTo();
    }

    /**
     * 
     * 
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * 
     * 
     */
    public function technician()
    {
        return $this->belongsTo('App\Models\User', 'technician_id');
    }

    /**
     * 
     * 
     */
    public function slots()
    {
        return $this->belongsToMany('App\Models\Slot', 'slot_appointment');
    }

    /**
     * 
     * 
     */
    public function job()
    {
        return $this->hasOne('App\Models\TheJob');
    }
}

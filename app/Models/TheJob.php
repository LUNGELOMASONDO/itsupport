<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TheJob extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'thejob';

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
    public function appointment()
    {
        return $this->belongsTo('App\Models\Appointment');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notifications';

     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the user that owns the notification.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

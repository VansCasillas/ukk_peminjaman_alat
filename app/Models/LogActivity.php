<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    //
    protected $table = 'log_activities';
    protected $fillable = [
        'user_id',
        'activity',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

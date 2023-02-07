<?php

namespace App\Modules\System\Models\Logger;

use Illuminate\Database\Eloquent\Model;

class HttpLog extends Model
{
    protected $fillable = [
        'created_at',
        'request_method',
        'request_url',
        'response_status',
        'response_body',
        'exec_time_ms',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    protected $table = 'usages';

    protected $fillable = [
        "computer_id", "user_id", "start_time", "end_time", "duration", "cost",
    ];
}

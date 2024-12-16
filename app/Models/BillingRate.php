<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingRate extends Model
{
    protected $table = 'billing_rates';

    protected $fillable = ["rate"];
}

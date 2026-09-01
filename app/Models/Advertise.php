<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $fillable = [
        "banner",
        "redirect_link",
        "expiry_date",
        "company_name",
        "contact_no",
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
        'favicon',
        'site_name',
        'phone_no',
        'email',
        'copyright',
    ];
}

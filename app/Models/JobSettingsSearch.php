<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSettingsSearch extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'job_titles',
        'skills',
        'preferred_employees',
        'excluded_employees',
        'willingToTravel',
        'distOfMe'
    ];
    protected $table = 'job_settings_search';

}

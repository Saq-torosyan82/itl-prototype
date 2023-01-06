<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancies extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'job_title',
        'pay_range',
        'job_description',
        'job_requirements',
        'location'
    ];

    protected $searchable = [
        'job_title',
        'job_description',
        'job_requirements',
        'location'
    ];


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logins extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip_address'
    ];

    public static function store($user, $ip)
    {
        self::create([
            'user_id' => $user,
            'ip_address' => $ip
        ]);
    }
}

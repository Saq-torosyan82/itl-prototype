<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'image',
        'secondary_email',
        'address',
        'city',
        'postal_code',
        'phone',
        'company',
        'pps',
        'seeking_employment',
        'own_transport',
        'driving_license',
        'country',
        'province',
        'county',
        'vat'
    ];

    protected $table = 'user_profile';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function getProfileByUserId($userId) {
        $profile = UserProfile::where('user_id', $userId)->first();
        return $profile;
    }
}

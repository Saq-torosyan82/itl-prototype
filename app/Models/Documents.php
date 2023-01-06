<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Documents extends Model
{
//    use HasFactory;
//
//    protected $fillable = [
//        'user_id',
//        'filetype',
//        'filename',
//        'title',
//        'primary',
//        'id_resume',
//        'file_name_resume'
//
//    ];
//
//    public static function removePrimary()
//    {
//        self::where([
//            ['primary', '=', 1],
//            ['user_id','=',Auth::user()->id]
//        ])->update(['primary' => 0]);
//    }
//
//    public static function checkDublicateTitle($title, $id = false)
//    {
//        $conditions = [
//            ['title', '=', $title],
//            ['user_id', '=', Auth::user()->id]
//        ];
//
//        if ($id) {
//            $conditions[] = ['id', '!=', $id];
//        }
//
//        $items = self::where($conditions)->get();
//
//        return count($items);
//    }
    use HasFactory;

    protected $table = 'documents';

    public static function removePrimary($fileType)
    {
        self::where([
            ['filetype', '=', $fileType],
            ['is_primary', '=', 1],
            ['user_id','=',Auth::user()->id]
        ])->update(['is_primary' => 0]);
    }

    public static function checkDublicateTitle($title, $id = false)
    {
        $conditions = [
            ['title', '=', $title],
            ['user_id', '=', Auth::user()->id]
        ];

        if ($id) {
            $conditions[] = ['id', '!=', $id];
        }

        $items = self::where($conditions)->get();

        return count($items);
    }
}

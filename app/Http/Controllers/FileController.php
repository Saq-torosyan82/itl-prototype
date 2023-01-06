<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
//    public function store($data)
//    {
//        $editId = $data['id_resume'] ? $data['id_resume']: false;
//        if ((Documents::checkDublicateTitle($data['title'],$editId) ||$data['title'] == '')) {
//             return redirect()->back()->with('error',true);
//        } else {
//            if ($data['primary']) {
//                Documents::removePrimary();
//            }
//        }
//        if ($data['id_resume']) {
//            $update_arr=[];
//            if(!empty($data['file'])){
//                $path = $data['file']->store('local');
//                $update_arr =   [
//                    'user_id' => $data['user_id'],
//                    'filetype' => $data['filetype'],
//                    'filename' => $path,
//                    'title' => $data['title'],
//                    'primary' => (int)$data['primary']
//                ];
//                Storage::delete($data['file_name_resume']);
//            } else {
//                $update_arr =   [
//                    'user_id' => $data['user_id'],
//                    'filetype' => $data['filetype'],
//                    'title' => $data['title'],
//                    'primary' => (int)$data['primary']
//                ];
//            }
//
//            $doc = Documents::updateOrInsert(
//                ['id' => $data['id_resume']],
//                $update_arr
//            );
////            return $doc;
//
//        } else {
//            $path = $data['file']->store('local');
//            $doc = Documents::create([
//                'user_id' => $data['user_id'],
//                'filetype' => $data['filetype'],
//                'filename' => $path,
//                'title' => $data['title'],
//                'primary' => (int)$data['primary']
//            ]);
////            return $doc;
//
//        }
//        return $doc;
//    }

}

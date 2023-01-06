<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Documents;
use Illuminate\Support\Facades\Schema;

class MigrateCoverLetters extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tbl = 'user_cover_letters';

        $items = DB::table($tbl)->orderBy('id', 'desc')->get();

        foreach ($items as $item) {
            $doc = new Documents;
            $doc->user_id           = $item->user_id;
            $doc->filetype          = 'cover_letter';
            $doc->filename          = $item->filename;
            $doc->original_filename = $item->filename;
            $doc->title             = $item->title;
            $doc->created_at        = $item->created_at;
            $doc->updated_at        = $item->updated_at;

            $doc->save();
        }

        Schema::dropIfExists($tbl);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\JobSettingsSearch;
use Illuminate\Http\Request;

class JobSettingSearchController extends Controller
{
    public function show(Request $request) {
        $userId = auth()->user()->getAuthIdentifier();

        $jobSettingSearch = JobSettingsSearch::where('user_id', '=', $userId)->first();

        return view ('job-search-preferences')->with('jobSettingSearch', $jobSettingSearch);
    }
    public function save(Request $request) {
        $userId = auth()->user()->getAuthIdentifier();
        $data = $request->all();
        /** @var  $jobSettingSearch $jobSettingSearch */
        $jobSettingSearch = JobSettingsSearch::where('user_id', '=', $userId)->first();
        if (empty($jobSettingSearch)) {
            JobSettingsSearch::create([
                'user_id'               => $userId,
                'job_titles'            => $data['jobTitles'],
                'skills'                => $data['skills'],
                'preferred_employees'   => $data['employe'],
                'excluded_employees'    => $data['excluded'],
                'willingToTravel'       => (int) $data['willingToTravel'],
                'distOfMe'              => (int) $data['distOfMe']
            ]);
        } else {
            $jobSettingSearch->job_titles = $data['jobTitles'];
            $jobSettingSearch->skills = $data['skills'];
            $jobSettingSearch->preferred_employees = $data['employe'];
            $jobSettingSearch->excluded_employees = $data['excluded'];
            $jobSettingSearch->willingToTravel = (int) $data['willingToTravel'];
            $jobSettingSearch->distOfMe = (int) $data['distOfMe'];
            $jobSettingSearch->save();
        }

        return 1;
    }
}

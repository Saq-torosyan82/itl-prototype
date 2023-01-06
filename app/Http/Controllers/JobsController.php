<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobVacancies;
use App\Models\JobSettingsSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    //Searchable fields in JobVacancies
    private $_searchable =  [
        'job_title',
        'job_description',
        'job_requirements',
        'location'
    ];

    public function showVacant(Request $request)
    {
        return view ('jobs')
            ->with('jobs', JobVacancies::all());
    }

    public function postJob()
    {
        return view('post-job');
    }

    public function show(Request $request)
    {
        $job = JobVacancies::findOrFail($request->route('id'));
        return view('job')->with('job', $job);
    }

    private function getJobSearchSettings($id)
    {
        return JobSettingsSearch::where('user_id',$id)->first();
    }

    private function searchByKeyword($word)
    {
        if (trim($word) == "")
        {
            return DB::table('job_vacancies')->join('user_profile AS a', 'client_id', '=', 'a.user_id')->get();
        }

        //Create Array from keyword search
        $word_array = explode(" ", $word);

        //Normalization (make each word lowercase)
        $word_array = array_map('strtolower', $word_array);

        //Create string from searchable fields
        $columns = implode(",",$this->_searchable);

        //Search Jobs By Keyword Query Builder
        $results = DB::table('job_vacancies');
        $results->selectRaw("job_vacancies.*, a.*, MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE) AS relevance_score", $word_array);
        $results->join('user_profile AS a', 'client_id', '=', 'a.user_id');
        $results->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $word);
        $results->orderByDesc('relevance_score');

        return $results->get();

    }

    /**
     * @throws \Exception
     */

    public function search(Request $request)
    {
        $request->validate([
            'type' => 'required'
        ]);

        $results = [];

        switch($request->type)
        {
            case "keyword":
                $results = $this->searchByKeyword($request->keyword);
                break;

            case "profile":
                $prefs = $this->getJobSearchSettings(Auth::user()->id);
                break;

            default:
                throw new \Exception ("JobsController - Search - switch statement missing type");
                break;
        }

        return view('tables.job-search-table')->with('results', $results);
    }


    public function create(Request $request)
    {
        $request->validate([
           'job_title' => 'string|required',
           'job_location' => 'string|required',
           'pay_range' => 'string|required',
           'job_description' => 'string|required',
           'job_requirements' => 'string|required'
        ]);

        $job = JobVacancies::create([
           'job_title' => $request->job_title,
           'location' => $request->job_location,
           'pay_range' => $request->pay_range,
           'job_description' => $request->job_description,
           'job_requirements' => $request->job_requirements,
           'client_id' => Auth::user()->id
        ]);

        return redirect()->route('job', ['id' => $job->id]);
    }
}

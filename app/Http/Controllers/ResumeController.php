<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documents;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Util\Exception;


class ResumeController extends Controller
{

//    private $_validation = ['file' => 'mimes:doc,docx,pdf'];
//
//    public function search()
//    {
//        return view('search-resumes');
//    }
    public function show()
    {
        $resumes = Documents::where([
            'user_id' => Auth::user()->id,
            'filetype' => 'applicant-resume'
        ])->orderBy('id', 'DESC')
            ->get();

        return view('resume', ['resumes' => $resumes]);

    }
//
//    public function showApplicantTable()
//    {
//        $resumes = Documents::where([
//            'user_id' => Auth::user()->id,
//            'filetype' => 'applicant-resume'
//        ])->orderBy('id', 'DESC')
//            ->get();
//
//        return view('tables.applicant-resume-table', ['resumes' => $resumes]);
//    }
//
//    public function list(Request $request)
//    {
//        $resumes = Documents::where([
//            'user_id' => Auth::user()->id,
//            'filetype' => 'applicant-resume'
//        ])->orderBy('id', 'DESC')
//            ->get();
//
//        return response()->json($resumes->toArray());
//
//    }
//
//    public function store(Request $request)
//    {
//        $request->validate($this->_validation);
//        $editId = $request->id_resume ? $request->id_resume: false;
//        if ((Documents::checkDublicateTitle($request->title,$editId) || $request->title == '')) {
//            throw new Exception('Duplicate title');
//        }else {
//            if ($request->primary_resume) {
//                Documents::removePrimary();
//            }
//        }
//
//            $data = [
//                'user_id' => Auth::user()->id,
//                'filetype' => $request->filetype,
//                'file' => $request->file('file'),
//                'title' => $request->title,
//                'primary' => (int)$request->primary_resume,
//                'id_resume' => $request->id_resume,
//                'file_name_resume'=>$request->file_name_resume
//            ];
//            app()[FileController::class]->store($data);
//        return redirect()->back()->with('success', true);
//    }
//
//    public function download(Request $request)
//    {
//        return response()->download(storage_path('app/'.$request->resume));
//    }
//
//    public function delete(Request $request)
//    {
//        $resume = Documents::where('id', $request->resume)->first();
//        Storage::delete($resume->filename);
//        $resume->delete();
//        return redirect()->back()->with('delete', true);
//    }
    const MAIN_PATH = 'uploads/my_resumes/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private static function makeFileUrl($fileName = '')
    {
        return $fileName ? url(self::MAIN_PATH . Auth::user()->id. '/' . $fileName) : '';
    }

    private static function deleteFileFromDir($fileName)
    {
        $result = ['res' => true];
        if (!empty($fileName)) {
            try {
                File::delete(self::MAIN_PATH . Auth::user()->id. '/' . $fileName);
            } catch (\Exception $e) {
                $result['res'] = false;
                $result['message'] = $e->getMessage();
            }
        }

        return $result;
    }

    public function index()
    {
        $items = DB::table('documents')
            ->orderBy('primary', 'desc')
            ->where('user_id','=', Auth::user()->id)
            ->get();
        foreach ($items as &$item) {
            $item->fileUrl = self::makeFileUrl($item->filename);
        }

        return response()->json(['result' => 'success', 'items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title'    => 'required',
            'fileName' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails() || (CL::checkDublicateTitle($request->title))) {
            return response()->json(['error' => 1, 'message' => ['title'=>'The title has already been taken.']]);
        } else {
            if ($request->isPrimary) {
                CL::removePrimary();
            }

            $cl = new CL;
            $cl->user_id  = Auth::user()->id;
            $cl->filename = $request->fileName;
            $cl->title    = $request->title;
            $cl->primary  = $request->isPrimary;

            $saveData = $cl->save();

            if (!empty($saveData)) {
                return response()->json(['error' => 0,'message' => ['common' => 'Date saved']]);
            }else{
                return response()->json(['error' => 1, 'message' => ['common' => 'Date not saved']]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id = null, Request $request)
    {
        $rules = array(
            'title' => 'required',
            'fileName' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails() || (CL::checkDublicateTitle($request->title, $id))) {
            return response()->json(['error' => 1, 'message' => ['title'=>'The title has already been taken.']]);
        } else {
            if ($request->isPrimary) {
                CL::removePrimary();
            }
            try {
                Cl::updateOrInsert(
                    ['id' => $id],
                    [
                        'filename' => $request->fileName,
                        'title' => $request->title,
                        'primary' => $request->isPrimary
                    ]
                );

                return response()->json(['error' => 0]);
            } catch (\Exception $e) {
                return response()->json(['error' => 1, 'message' => ['common' => $e->getMessage()]]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null, Request $request)
    {
        if ($id) {
            $deleteEl = CL::find($id);
            $fileName = $deleteEl['filename'];

            try {
                $deleteEl->delete();
            } catch (\Exception $e) {
                return response()->json(['result' => 'error', 'message' => $e->getMessage()]);
            }
        } elseif (!empty($request->fileName)) {
            $fileName = $request->fileName;
        }

        if (!empty($fileName)) {
            $deleteFile = self::deleteFileFromDir($fileName);
            if ($deleteFile['res']) {
                return response()->json(['result' => 'success', 'message' => ($id ? 'Cover Letter' : 'File') . ' has been successfully deleted']);
            } else {
                return response()->json(['result' => 'error', 'message' => $deleteFile['message']]);
            }
        }
    }

    public function uploadFile(Request $request)
    {
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = self::MAIN_PATH . Auth::user()->id. '/';
            $uploadResult = $file->move(public_path($path), $filename);

            if ($uploadResult) {
                return response()->json([
                    'result'   => 'success',
                    'fileName' => $filename,
                    'fileUrl'  => self::makeFileUrl($filename)
                ]);
            }

            return response()->json(['result' => 'Error', 'message' => 'Uploade not worked']);
        }

        return response()->json(['result' => 'Error', 'message' => 'No file selected']);
    }

}

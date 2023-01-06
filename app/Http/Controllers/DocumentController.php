<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    const DOC_TYPES = ['applicant_resume', 'cover_letter'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private static function makeFileUrl($fileName = '', $fileType = '')
    {
        return ($fileName && $fileType) ? url('uploads/' . $fileType . '/' . Auth::user()->id. '/' . $fileName) : '';
    }

    private static function deleteFileFromDir($fileName = '', $fileType = '')
    {
        $result = ['res' => true];

        if (!empty($fileName)) {
            try {
                File::delete('uploads/' . $fileType . '/' . Auth::user()->id. '/' . $fileName);
            } catch (\Exception $e) {
                $result['res'] = false;
                $result['message'] = $e->getMessage();
            }
        }

        return $result;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $items = [];

        if (!empty($request->query('doctype')) && in_array($request->query('doctype'), self::DOC_TYPES)) {
            $items = DB::table('documents')
                ->orderBy('is_primary', 'desc')
                ->where([
                    ['user_id', '=', Auth::user()->id],
                    ['filetype', '=', $request->query('doctype')],
                ])
                ->get();

            foreach ($items as &$item) {
                $item->fileUrl = self::makeFileUrl($item->filename, $item->filetype);
            }
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = array(
            'title'    => 'required',
            'fileName' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails() || (Documents::checkDublicateTitle($request->title))) {
            return response()->json(['error' => 1, 'message' => ['title'=>'The title has already been taken.']]);
        } else {
            if ($request->isPrimary) {
                Documents::removePrimary($request->fileType);
            }

            $doc = new Documents;
            $doc->user_id           = Auth::user()->id;
            $doc->filetype          = $request->fileType;
            $doc->filename          = $request->fileName;
            $doc->original_filename = $request->originalFileName;
            $doc->title             = $request->title;
            $doc->is_primary        = $request->isPrimary;

            $saveData = $doc->save();

            if (!empty($saveData)) {
                return response()->json(['error' => 0,'message' => ['common' => 'Document saved']]);
            }else{
                return response()->json(['error' => 1, 'message' => ['common' => 'Document not saved']]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        return response()->json(['result' => 'success', 'item' => Documents::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $rules = array(
            'title' => 'required',
            'fileName' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails() || (Documents::checkDublicateTitle($request->title, $id))) {
            return response()->json(['error' => 1, 'message' => ['title'=>'The title has already been taken.']]);
        } else {
            if ($request->isPrimary) {
                Documents::removePrimary($request->fileType);
            }
            try {
                Documents::updateOrInsert(
                    ['id' => $id],
                    [
                        'filename'          => $request->fileName,
                        'original_filename' => $request->originalFileName,
                        'filetype'          => $request->fileType,
                        'title'             => $request->title,
                        'is_primary'        => $request->isPrimary
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id = null, Request $request)
    {
        if ($id) {
            $deleteEl = Documents::find($id);
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
        if (!empty($request->doctype) && in_array($request->doctype, self::DOC_TYPES)) {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = 'uploads/' . $request->doctype . '/' . Auth::user()->id . '/';
                $uploadResult = $file->move(public_path($path), $filename);

                if ($uploadResult) {
                    return response()->json([
                        'result'   => 'success',
                        'fileName' => $filename,
                        'fileUrl'  => self::makeFileUrl($filename, $request->doctype)
                    ]);
                }

                return response()->json(['result' => 'Error', 'message' => 'Uploade not worked']);
            }

            return response()->json(['result' => 'Error', 'message' => 'No file selected']);
        }

        return response()->json(['result' => 'Error', 'message' => 'Not allowed type']);

    }
}

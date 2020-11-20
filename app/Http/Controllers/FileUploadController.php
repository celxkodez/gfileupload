<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required'
        ]);

        if($request->hasFile('file')){
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

            // $fileModel->name = time().'_'.$request->file->getClientOriginalName();
            $finalPath = '/storage/' . $filePath;
            // $fileModel->save();
        }
        $file = FileUpload::create(['file_url' => $finalPath]);

        return response()->json(['message' => 'successful', 'data' => $file]);
    }
}

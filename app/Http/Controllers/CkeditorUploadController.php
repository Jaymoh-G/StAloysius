<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CkeditorUploadController extends Controller
{
    public function upload(Request $request)
    {
        $validator = validator($request->all(), [
            'upload' => 'required|file|mimes:jpeg,jpg,png,gif,webp|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json(['uploaded' => 0, 'error' => ['message' => $validator->errors()->first('upload')]], 422);
        }

        // Store under a random name so the client can't choose the filename or extension.
        $path = $request->file('upload')->store('uploads/ckeditor', 'public');

        return response()->json([
            'uploaded' => 1,
            'fileName' => basename($path),
            'url' => asset('storage/' . $path),
        ]);
    }
}

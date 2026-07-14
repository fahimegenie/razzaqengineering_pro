<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);
        
        try {
            if ($request->hasFile('upload')) {
                $file = $request->file('upload');
                $filename = 'editor_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                
                $path = $file->storeAs('uploads/editor', $filename, 'public');
                
                return response()->json([
                    'uploaded' => true,
                    'url' => asset('storage/' . $path),
                ]);
            }
            
            return response()->json([
                'uploaded' => false,
                'error' => ['message' => 'No file uploaded'],
            ], 400);
            
        } catch (\Exception $e) {
            return response()->json([
                'uploaded' => false,
                'error' => ['message' => $e->getMessage()],
            ], 500);
        }
    }
}
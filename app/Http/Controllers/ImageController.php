<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function uploadForm()
    {
        // Fetch all images to display in the table
        $images = Image::all();
        return view('upload', compact('images'));
    }

    public function upload(Request $request)
    {
        // Validate the image input
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->file('image')) {
            // Store the image in the 'public/images' directory
            $filePath = $request->file('image')->store('images', 'public');

            // Save image information in the database
            $image = new Image();
            $image->filepath = $filePath;
            $image->save();

            return redirect()->back()->with('success', 'Image uploaded successfully.');
        }

        return redirect()->back()->withErrors('Image upload failed.');
    }
}



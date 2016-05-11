<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Images;

class ImageUploadController extends Controller
{
    public function index(Request $request)
    {
       $errors = [];
       $user_id = !empty(auth()->user()->id) ? auth()->user()->id : 0;
       if (is_array($request->file('images')))
       {

           $files = $request->file('images');
            foreach ($files as $file)
            {
                if(isset($file)) {
                    $extension = ['jpeg', 'jpg'];
                    if(in_array($file->getClientOriginalExtension(), $extension))
                    {
                        list($_width, $_height) = @getimagesize($file);

                        $imageName = str_random(8) . '_' . $file->getClientOriginalName();

                        Image::make($file)->save('uploads/' . $imageName);

                        Image::make($file)->resize($_width / 2, $_height / 2)->save('uploads/thumbnails/' . $imageName);

                        Images::create([
                            'name' => $imageName,
                            'slug' => $file->getClientOriginalName(),
                            'user_id' => $user_id,
                            'deleted' => 0
                        ]);

                        $errors[0] = 'File Was Uploaded Successfully!';

                    }else {
                        $errors[] = $file->getClientOriginalName().' - The image must be a file of type: jpeg, jpg';
                    }
                }else{
                    $errors[] = 'Empty Files';
                }
            }

           return redirect('/home')->withErrors($errors);
       }
    }
}

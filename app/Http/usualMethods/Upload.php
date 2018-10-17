<?php

namespace App\Http\usualMethods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Upload extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public static function uploadFile($file, $location)
    {
        //setting up rules
        /*$rules = array('image' => 'required | mimes:jpeg,jpg,png | max:6000');
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make(array('image' => $file), $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('/admin')->withErrors($validator);
        }*/


        // checking file is valid.
        $allowedfileExtension=['pdf','jpg','png','docx'];
        if ($file->isValid()) {
            $destinationPath = 'storage/' . $location; // upload path
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(111111, 999999) . '.' . $extension;
            $file->move($destinationPath, $fileName);

            //Session::flash('success', 'Upload successfully');
            $result = '/' . $destinationPath . '/' . $fileName;
            return $result;
        } else {
            Session::flash('error', 'uploaded file is not valid');
            return Redirect::to('/');
        }

    }

    public static function uploadFileAs($file, $location, $name, $compress = true)
    {
        if ($file->isValid()) {
            $destinationPath = 'storage/' . $location; // upload path
            $fileName = $name;
            $file->move($destinationPath, $fileName);

            $result = '/' . $destinationPath . $fileName;

            return $result;
        } else {
            return Redirect::to('/');
        }
    }
}
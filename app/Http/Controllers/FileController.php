<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Filesystem\Filesystem;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function index(File $file)
    {
        $files = $file->latest()->get();

        return $files;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, File $file)
    {
        $string = isset($request->csv) ? $request->csv : '';

        $csv = explode(',', $string);

        // verify that the string is a valid CSV
        if ($csv == array_filter($csv)) {
            $file->filename = str_random(10);

            $file->download = url("/api/download/" . $file->max('id') + 1);

            if ($file->save()) {
                
                Storage::disk('local')->put($file->id . '.csv', $string);

                return response(['status' => 'created'], 201);
            }

            // if the file didn't save then we have a server error
            return reponse(500);
        }

        return response(['status', 'csv field missing or invalid'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file, $id)
    {
        return $file->find($id)->first();
    }

    /**
     * Download the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function download(File $file, $id)
    {       

        if ($file = $file->find($id)) {
            $filename = "{$file->id}.csv";

            if (Storage::disk('local')->exists($filename)) {
                return response()->download(storage_path('app/' . $filename));
            }
        }

        // if file is not found
        return ['response' => 'file not found'];
    }

}
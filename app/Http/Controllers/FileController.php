<?php

namespace App\Http\Controllers;

use App\File;
use App\Investoo\CsvFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
    public function store(Request $request, File $file, CsvFile $csvFile)
    {
        $string = isset($request->csv) ? $request->csv : '';

        $array = explode(',', $string);

        // verify that the string is a valid CSV
        if ($array == array_filter($array)) {
     
            if ($csvFile->save($string, $file)) return response(['status' => 'created'], 201);;

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

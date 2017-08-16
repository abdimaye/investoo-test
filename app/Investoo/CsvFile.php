<?php

namespace App\Investoo;

use App\Investoo\Contracts\FileSaverInterface;
use Illuminate\Support\Facades\Storage;

class CsvFile implements FileSaverInterface
{
	public function save($string, $file)
	{
	    $file->filename = str_random(10);

        $file->download = url("/api/download/" . $file->max('id') + 1);

        if ($file->save()) {
            
            Storage::disk('local')->put($file->id . '.csv', $string);

            return true;
        }

        return false;
	}

}
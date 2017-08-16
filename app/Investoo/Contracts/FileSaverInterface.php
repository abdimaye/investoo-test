<?php

namespace App\Investoo\Contracts;

interface FileSaverInterface
{
	/**
     * Save contents of a variable to a new file.
     *
     * @param  string  $string
     * @param  \App\File  $file
     * @return bool
     */
	public function save($string, $file);
}
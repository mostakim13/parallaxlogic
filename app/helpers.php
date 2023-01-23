<?php
use Illuminate\Support\Str;

if(!function_exists('createSlug')){
    function createSlug($string)
    {
        $slug = Str::slug($string);
        return $slug;
    }
}

?>
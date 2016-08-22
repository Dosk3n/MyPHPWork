<?php

// Remove all spaces from folder names
//
// This script recursively removes the spaces from ALL folders!
// WARNING: This will remove all spaces from the path including
// any folders above the currecnt directory because it takes
// the entire path as the string and removes the spaces from all
// of the string. Example: C:\Program Files\my program\my folder
// would become C:\ProgramFiles\myprogram\myfolder
// This could have unwanted results if you only want the last
// folder in the tree to change.
//
// This script was created knowing that ALL the folders up to
// the folders I needed to change already had no spaces.
// The system only had PHP so I had to use PHP over Python.
//
// Created by Dean Tearse
// 22/08/2016

$path = realpath('.'); // set starting path as current path where file is located
$patharray = [];

// itterate through all folders adding the path of each folder to path array
$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
foreach($objects as $name => $object){
    if (substr($name, -1) == '.') continue; // if folder path ends with . (current dir) or .. (up dir) then skip

    if ($object->isDir()) {
        $patharray[] = $name;
    }
    
}

// for each path in array, remove spaces from folder names and rename
foreach($patharray as $p){
    echo $p . "\n";
    $filename = str_replace(" ", "", $p);
    rename($p, $filename);
}

?>
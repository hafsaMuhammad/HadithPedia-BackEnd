<?php


function uploadImage($folder,$image){
    $image->store('/', $folder);
    $filename = $image->hashName();
    return  $filename;
 }

 function uploadAudio($folder,$audio){
    $audio->store('/', $folder);
    $filename = $audio->hashName();
    return  $filename;
 }


?>
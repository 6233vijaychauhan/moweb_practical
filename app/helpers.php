<?php

use Illuminate\Support\Facades\Storage;

// Save image into storage folder
function saveAvatar($avatar = []) {
    $name = Storage::disk(config('constants.imagePath.Driver'))->put(config('constants.imagePath.CompanyImage'), $avatar);
    return ($name) ? $avatar->hashName() : false;
}

// Delete image into storage folder
function deleteAvatar($avatar = null) {
    $imagePath = config('constants.imagePath.CompanyImage') . $avatar;
    $disk = Storage::disk(config('constants.imagePath.Driver'));

    if ($disk->exists($imagePath)) {
        $disk->delete($imagePath);
    }
    return true;
}

?>
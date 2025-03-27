<?php

if (!function_exists('store_file')) {
    function store_file($file,$folder)
    {
        $size = $file->getSize();
        $ext = $file->getClientOriginalExtension();

        $mime_type = $file->getMimeType();

        $fileName = time() . '_' . uniqid() . '.' . $ext;

        $filePath = $file->store('files/' . $folder , 'public');

        $file = \App\Models\File::create([
            'name' => $fileName,
            'ext' => $ext,
            'path' => $filePath,
            'size' => $size,
            'mime_type' => $mime_type,
        ]);

        return $file;
    }
}

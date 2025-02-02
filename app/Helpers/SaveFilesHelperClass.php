<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class SaveFilesHelperClass
{
    /**
     * Save a base64 image to the specified folder path using the Storage Facade.
     *
     * @param string $base64Image The base64 encoded image string.
     * @param string $folderPath The folder path where the image should be stored.
     * @param string $disk The disk to use (e.g., 'public', 's3'). Default is 'public'.
     * @return string The generated file path.
     */
    public static function saveBase64Image($base64Image, $folderPath, $disk = 'public')
    {
        // Extract the image extension and data
        preg_match("/data:image\/(.*?);base64,/", $base64Image, $imageExtension);
        $base64Image = preg_replace("/data:image\/(.*?);base64,/", '', $base64Image);
        $base64Image = str_replace(' ', '+', $base64Image);

        $fileName = time() . '-' . rand() . '.' . $imageExtension[1];
        $filePath = $folderPath . '/' . $fileName;

        // Decode the base64 image and store it using the Storage Facade
        $imageData = base64_decode($base64Image);
        Storage::disk($disk)->put($filePath, $imageData);

        return $filePath; // Return the relative file path
    }

    /**
     * Save an uploaded file to the specified folder path using the Storage Facade.
     *
     * @param \Illuminate\Http\UploadedFile $file The uploaded file.
     * @param string $folderPath The folder path where the file should be stored.
     * @param string $disk The disk to use (e.g., 'public', 's3'). Default is 'public'.
     * @return string The generated file path.
     */
    public static function saveUploadedFile($file, $folderPath, $disk = 'public')
    {
        // Generate a unique file name
        $fileName = time() . '-' . rand() . '.' . $file->getClientOriginalExtension();
        $filePath = $folderPath . '/' . $fileName;

        // Store the file using the Storage Facade
        Storage::disk($disk)->putFileAs($folderPath, $file, $fileName);

        return $filePath; // Return the relative file path
    }
}

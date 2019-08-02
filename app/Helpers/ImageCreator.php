<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\Mime\MimeTypes;

class ImageCreator
{
    /**
     * Store an image and return filename
     *
     * @param $path
     * @param $content
     * @param $mime
     * @return string
     */
    public function store($path, $content, $mime)
    {
        $mimeTypes = new MimeTypes();
        $type = $mimeTypes->getExtensions($mime)[0];

        $fullName = $path . '.' . $type;
        Storage::disk('public')->put($fullName, $content);

        return $fullName;
    }
}

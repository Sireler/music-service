<?php

namespace App\Helpers;

use getID3;
use getid3_lib;

class ID3Parser
{
    private $getID3;
    private $info;

    public function __construct(getID3 $getID3)
    {
        $this->getID3 = $getID3;
    }

    /**
     * Extract information from a file
     *
     * @param $path
     * @return array
     */
    public function getTrackInfo($path)
    {
        $info = $this->getID3->analyze($path);
        $this->info = $info;
        getid3_lib::CopyTagsToComments($info);

        $filename = $info['filename'] ?? '';
        $title = $info['comments']['title'][0] ?? '';
        $artistName = $info['comments']['artist'][0] ?? '';
        $album = $info['comments']['album'][0] ?? '';
        $length = $info['playtime_seconds'] ?? 0;

        $picture = $this->getPictureBase64();

        $trackInfo = [
            'filename' => $filename,
            'title' => $title,
            'artist' => $artistName,
            'album' => $album,
            'length' => $length
        ];

        if ($picture) {
            $trackInfo['image'] = $picture;
        }

        return $trackInfo;
    }

    /**
     * Mime type of a picture
     *
     * @return bool|string
     */
    public function getPictureMime()
    {
        if ($this->pictureExists()) {
            $mime = $mime = $this->info['id3v2']['APIC'][0]['image_mime'] ?? 'image/png';

            return $mime;
        }

        return false;
    }

    /**
     * Base64 encoded picture
     *
     * @return bool|string
     */
    public function getPictureBase64()
    {
        if ($this->pictureExists()) {
            $mime = $this->getPictureMime();
            $picture = $this->getPicture();
            $base64 = 'data:' . $mime . ';base64,' . base64_encode($picture);

            return $base64;
        }

        return false;
    }

    /**
     * Get a picture of a track
     *
     * @return string
     */
    public function getPicture()
    {
        if ($this->pictureExists()) {
            $picture = $this->info['id3v2']['APIC'][0]['data'] ?? '';

            return $picture;
        }

        return false;
    }

    /**
     * Check if a picture exists
     *
     * @return bool
     */
    private function pictureExists()
    {
        $picture = $this->info['id3v2']['APIC'][0]['data'] ?? '';

        return !empty($picture);
    }
}

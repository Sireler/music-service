<?php

namespace App\Helpers;

use getID3;
use getid3_lib;

class ID3Parser
{
    private $getID3;

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
        getid3_lib::CopyTagsToComments($info);

        $filename = $info['filename'] ?? '';
        $title = $info['comments']['title'][0] ?? '';
        $artistName = $info['comments']['artist'][0] ?? '';
        $album = $info['comments']['album'][0] ?? '';
        $length = $info['playtime_seconds'] ?? 0;

        $picture = $info['id3v2']['APIC'][0]['data'] ?? '';

        $trackInfo = [
            'filename' => $filename,
            'title' => $title,
            'artist' => $artistName,
            'album' => $album,
            'length' => $length
        ];

        if (!empty($picture)) {
            $mime = $info['id3v2']['APIC'][0]['image_mime'] ?? 'image/jpeg';
            $base64Image = 'data:' . $mime . ';base64,' . base64_encode($picture);

            $trackInfo['image'] = $base64Image;
        }

        return $trackInfo;
    }
}

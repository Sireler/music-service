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

        $title = $info['comments']['title'] ?? '';
        $artistName = $info['comments']['artist'] ?? '';

        $picture = $info['id3v2']['APIC'][0]['data'] ?? '';

        $trackInfo = [
            'title' => $title[0] ?? '',
            'artist' => $artistName[0] ?? ''
        ];

        if (!empty($picture)) {
            $mime = $info['id3v2']['APIC'][0]['image_mime'] ?? 'image/jpeg';
            $base64Image = 'data:' . $mime . ';base64,' . base64_encode($picture);

            $trackInfo['image'] = $base64Image;
        }

        return $trackInfo;
    }
}

<?php

namespace App\Helpers\MetadataParsers;

use Exception;
use getID3;
use getid3_lib;

class ID3Parser
{
    /** @var getID3  */
    private $getID3;

    /** @var array */
    private $metadata;

    /** @var array */
    private $trackInfo;

    public function __construct(getID3 $getID3)
    {
        $this->getID3 = $getID3;
    }

    /**
     * Load the track file
     *
     * @param $path
     * @throws Exception
     */
    public function loadTrackInfo($path)
    {
        if (!file_exists($path)) {
            throw new Exception('File not found');
        }

        $info = $this->getID3->analyze($path);
        getid3_lib::CopyTagsToComments($info);
        $this->metadata = $info;

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

        $this->trackInfo = $trackInfo;
    }

    /**
     * Extract information from the file
     *
     * @return array
     * @throws Exception
     */
    public function getTrackInfo()
    {
        return $this->trackInfo;
    }

    /**
     * Get a picture mime type
     *
     * @return bool|string
     */
    public function getPictureMime()
    {
        if ($this->pictureExists()) {
            $mime = $mime = $this->metadata['id3v2']['APIC'][0]['image_mime'] ??
                $this->metadata['id3v2']['PIC']['0']['mime'] ?? 'image/png';

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
     * Get a picture of the track
     *
     * @return string
     */
    public function getPicture()
    {
        if ($this->pictureExists()) {
            $picture = $this->metadata['id3v2']['APIC'][0]['data'] ??
                $picture = $this->metadata['id3v2']['PIC'][0]['data'] ??  '';

            return $picture;
        }

        return false;
    }

    /**
     * Cover info
     *
     * @return array
     */
    public function getCoverInfo()
    {
        return [
            'picture' => $this->getPicture(),
            'mime' => $this->getPictureMime()
        ];
    }

    /**
     * Check if a picture exists
     *
     * @return bool
     */
    private function pictureExists()
    {
        $picture = $this->metadata['id3v2']['APIC'][0]['data'] ??
            $this->metadata['id3v2']['PIC'][0]['data'] ?? '';

        return !empty($picture);
    }
}

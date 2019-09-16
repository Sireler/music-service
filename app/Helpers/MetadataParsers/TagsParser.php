<?php

namespace App\Helpers\MetadataParsers;

use Exception;
use getID3;
use getid3_lib;

class TagsParser implements ParserInterface
{
    /**
     * @var getID3
     */
    private $getID3;

    /**
     * @var array metadata
     */
    private $meta;

    /**
     * TagsParser constructor.
     * @param string $path
     * @param getID3 $getID3
     * @throws Exception
     */
    public function __construct(string $path, getID3 $getID3)
    {
        if (!file_exists($path)) {
            throw new Exception('File not found');
        }

        $this->getID3 = $getID3;

        $this->meta = $this->getID3->analyze($path);
        getid3_lib::CopyTagsToComments($this->meta);
    }

    /**
     * Get the track title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->meta['comments']['title'][0] ?? '';
    }

    /**
     * Get the artist name
     *
     * @return string
     */
    public function getArtist()
    {
        return $this->meta['comments']['artist'][0] ?? '';
    }

    /**
     * Get the album name
     *
     * @return string
     */
    public function getAlbum()
    {
        return $this->meta['comments']['album'][0] ?? '';
    }

    /**
     * Get the track length
     *
     * @return mixed
     */
    public function getLength()
    {
        return $this->meta['playtime_seconds'] ?? 0;
    }

    /**
     * Get the filename
     *
     * @return mixed
     */
    public function getFilename()
    {
        return $this->meta['filename'] ?? '';
    }

    /**
     * Get cover data from the file
     *
     * @return string
     */
    public function getCover()
    {
        $cover = $this->meta['id3v2']['APIC'][0]['data'] ??
            $this->meta['id3v2']['PIC'][0]['data'] ??  '';

        return $cover;
    }

    /**
     * Get base64 encoded cover
     *
     * @return string
     */
    public function base64Cover()
    {
        $mime = $this->getCoverMime();
        $cover = $this->getCover();

        if (empty($cover)) {
            return '';
        }

        return 'data:' . $mime . ';base64,' . base64_encode($cover);
    }

    /**
     * Get the cover mime type
     *
     * @return string
     */
    public function getCoverMime()
    {
        $mime = $this->meta['id3v2']['APIC'][0]['image_mime'] ??
            $this->meta['id3v2']['PIC'][0]['mime'] ?? 'image/png';

        return $mime;
    }
}

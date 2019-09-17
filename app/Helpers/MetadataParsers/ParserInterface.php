<?php

namespace App\Helpers\MetadataParsers;

interface ParserInterface
{
    /**
     * Get the track title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Get the artist name
     *
     * @return string
     */
    public function getArtist();

    /**
     * Get the album name
     *
     * @return string
     */
    public function getAlbum();

    /**
     * Get the track length
     *
     * @return mixed
     */
    public function getLength();

    /**
     * Get the filename
     *
     * @return mixed
     */
    public function getFilename();
}

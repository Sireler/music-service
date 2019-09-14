<?php

namespace Tests\Unit;

use Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ID3ParserTest extends TestCase
{
    public $ID3Parser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ID3Parser = $this->app->make('App\Helpers\MetadataParsers\ID3Parser');
    }

    /**
     * Check to throw an exception if the track file is not found
     */
    public function testFileNotFound()
    {
        $this->expectException(Exception::class);

        $this->ID3Parser->getTrackInfo('/filenotfoundexception.mp3');
    }

    /**
     * Verifying that metadata is retrieved correctly
     */
    public function testGetTrackInfo()
    {
        $info = $this->ID3Parser->getTrackInfo('/app/tests/tracks/blank_tags.mp3');

        $this->assertEquals('blank_tags.mp3', $info['filename']);
        $this->assertEquals('TestTitle', $info['title']);
        $this->assertEquals('TestArtist', $info['artist']);
        $this->assertEquals('TestAlbum', $info['album']);
    }

    /**
     * Check for the existence of the cover
     */
    public function testGetPictureMime()
    {
        $this->ID3Parser->getTrackInfo('/app/tests/tracks/track.mp3');

        $this->assertEquals('image/jpeg', $this->ID3Parser->getPictureMime());
    }
}

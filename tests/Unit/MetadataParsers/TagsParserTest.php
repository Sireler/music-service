<?php

namespace Tests\Unit\MetadataParsers;

use App\Helpers\MetadataParsers\TagsParser;
use Exception;
use Tests\TestCase;

class TagsParserTest extends TestCase
{
    public function test__construct()
    {
        $this->expectException(Exception::class);
        $tagsParser = new TagsParser('/app/tests/filenotfound.mp3', $this->app->make('getID3'));
    }

    public function testGetAlbum()
    {
        $tagsParser = new TagsParser('/app/tests/tracks/blank_tags.mp3', $this->app->make('getID3'));

        $this->assertEquals('TestAlbum', $tagsParser->getAlbum());
    }

    public function testGetArtist()
    {
        $tagsParser = new TagsParser('/app/tests/tracks/blank_tags.mp3', $this->app->make('getID3'));

        $this->assertEquals('TestArtist', $tagsParser->getArtist());
    }

    public function testGetFilename()
    {
        $tagsParser = new TagsParser('/app/tests/tracks/blank_tags.mp3', $this->app->make('getID3'));

        $this->assertEquals('blank_tags.mp3', $tagsParser->getFilename());
    }

    public function testGetLength()
    {
        $tagsParser = new TagsParser('/app/tests/tracks/blank_tags.mp3', $this->app->make('getID3'));

        $this->assertEquals(10.083125, $tagsParser->getLength());
    }

    public function testGetTitle()
    {
        $tagsParser = new TagsParser('/app/tests/tracks/blank_tags.mp3', $this->app->make('getID3'));

        $this->assertEquals('TestTitle', $tagsParser->getTitle());
    }

    public function testGetCover()
    {
        $tagsParser = new TagsParser('/app/tests/tracks/track.mp3', $this->app->make('getID3'));

        $this->assertNotEmpty($tagsParser->getCover());
    }

    public function testGetCoverMime()
    {
        $tagsParser = new TagsParser('/app/tests/tracks/track.mp3', $this->app->make('getID3'));

        $this->assertEquals('image/jpeg', $tagsParser->getCoverMime());
    }
}

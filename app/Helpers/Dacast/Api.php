<?php
namespace Dacast;

use Dacast\Elements\Live;
use Dacast\Elements\Package;
use Dacast\Elements\Playlist;
use Dacast\Elements\Vod;
use Dacast\Rest;

class Api
{
    /**
     * @var Live
     */
    public $rest;

    public function __construct($apiKey)
    {
        $this->rest = new Rest($apiKey);

    }

    public static function __callStatic($name, $arguments)
    {
        $rest = resolve('Dacast')->rest;
        $class = "Dacast\\Elements\\".$name;

        if(class_exists($class)) return new $class($rest);
    }
}

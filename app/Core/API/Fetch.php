<?php 

namespace  App\Core\API;

class Fetch
{
    private $url;

    private static $instance;

    public function __construct($url) {
      $this->url = $url;
    }

    public static function make($url) {
      return new static($url);
    }

    public function getData() {
      $data = $this->fetch();

      return $this->decode($data);
    }

    private function fetch() {
      return file_get_contents($this->url);
    }

    private function decode($data) {
      return json_decode($data);
    }
}
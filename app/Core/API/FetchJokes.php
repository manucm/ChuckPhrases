<?php

namespace  App\Core\API;

class FetchJokes
{
    const URL = 'https://api.chucknorris.io/jokes/search?query=joke';

    private $data;

    private $fetch;

    public function __construct() {
      $this->fetch = Fetch::make(self::URL);
    }

    public function get($number) {
      $fetched = $this->fetch->getData();

      $normalizedData = $this->normalizeData($fetched);

      return $normalizedData->slice(0, $number);
    }

    private function normalizeData($data) {
      $normalizedData = $data->result;

      return collect($normalizedData);
    }
}
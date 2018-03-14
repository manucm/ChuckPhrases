<?php

    namespace  App\Core\API;

    class FetchCategories
    {
      const URL = 'https://api.chucknorris.io/jokes/categories';

      private $data;
  
      private $fetch;
  
      public function __construct() {
        $this->fetch = Fetch::make(self::URL);
      }
  
      public function all() {
        return collect($this->fetch->getData())->map(function($category) {
          $record['name'] = $category;
          return $record;
        });
      }
    }
    
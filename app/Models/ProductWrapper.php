<?php

namespace App\Models;

class ProductWrapper
{
    private $id;
    public function __contruct($id)
    {
        $this->id = $id;
    }

    public function getProduct()
    {
        // find in cache
        $result = $this->findInCache();

        // find in elasticSearch
        if(!$result)
        {
            $result = $this->findInElasticSearch();
        }
        
        // find in Mysql
        if(!$result)
        {
            $result = $this->findInMySQL();   
        }
        $this->saveToCache($result);
        return $result;
    }

    /**
     * return array from cache
     */
    private function findInCache()
    {
        return array(
            'test' => 'test'
        );

    }

    /**
     * return array
     */
    private function findInElasticSearch()
    {

    }

    /**
     * return array
     */
    private function findInMySQL()
    {

    }

    /**
     * save product in the cache
     */
    private function saveToCache($result)
    {
        // Database cache or textfile cache

    }
}

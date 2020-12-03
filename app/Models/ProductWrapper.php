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
        if(env('CACHE_TYPE') == 'database')
        {
            return Product::find($this->id)['data'];
        }
        else if(env('CACHE_TYPE') == 'text_file')
        {

        }
        return null;

    }

    /**
     * return array
     */
    private function findInElasticSearch()
    {
        return IElasticSearchDriver->findById($this->id);
    }

    /**
     * return array
     */
    private function findInMySQL()
    {
        return IMySQLDriver->findProduct($this->id);
    }

    /**
     * save product in the cache
     */
    private function saveToCache($result)
    {
        // Database cache or textfile cache

    }
}

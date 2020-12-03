<?php

namespace App\Models;

use App\Models\Product;

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
            $this->saveToCache($result);
            $result = $this->findInElasticSearch();
        }
        
        // find in Mysql
        if(!$result)
        {
            $result = $this->findInMySQL();   
        }
        return $result;
    }

    /**
     * return array from cache
     */
    private function findInCache()
    {
        if(env('CACHE_TYPE') == 'database')
        {
            $product = Product::find($this->id);
            return $product->data;
        }
        else if(env('CACHE_TYPE') == 'text_file')
        {
            // get from textfile
        }
        return null;

    }

    /**
     * return array
     */
    private function findInElasticSearch()
    {
        $driver = new IElasticSearchDriver;
        return $driver->findById($this->id);
    }

    /**
     * return array
     */
    private function findInMySQL()
    {
        $driver = new IMySQLDriver;
        return $driver->findProduct($this->id);
    }

    /**
     * save product in the cache
     */
    private function saveToCache($result)
    {
        $product = new Product;
        $product->id = $result->id;
        $product->data = $result->data;
        // Database cache or textfile cache
        if(env('CACHE_TYPE') == 'database')
        {
            $product->save();
        }
        else if(env('CACHE_TYPE') == 'text_file')
        {
            // save product to textfile
        }
    }
}

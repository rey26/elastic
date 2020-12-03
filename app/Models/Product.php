<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    private $id;
    public function __contruct($id)
    {
        $this->id = $id;
    }

    private function getProduct()
    {
        // find in cache
        $result = $product->findInCache();

        // find in elasticSearch
        if(!$result)
        {
            $result = $product->findInElasticSearch();
        }
        
        // find in Mysql
        if(!$result)
        {
            $result = $product->findInMySQL();   
        }

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
}

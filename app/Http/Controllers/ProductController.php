<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use App\Models\ProductWrapper;
use App\Models\RequestLogger;

class ProductController extends BaseController
{
    /**
     * @param string $id
     * @return string
     */
    public function detail($id)
    {
        $productWrapper = new ProductWrapper($id);
        $result = $productWrapper->getProduct();

        // log request
        $requestLogger = new RequestLogger($id);
        $requestLogger->logRequest();

        // return array with data about product
        return $result;

    }
}

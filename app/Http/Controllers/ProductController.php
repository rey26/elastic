<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;
use App\Models\RequestLogger;

class ProductController extends BaseController
{
    /**
     * @param string $id
     * @return string
     */
    public function detail($id)
    {
        $product = new Product($id);
        $result = $product->getProduct();

        // log request
        $requestLogger = new RequestLogger($id);
        $requestLogger->logRequest();

        // return array with data about product
        return $result;

    }
}

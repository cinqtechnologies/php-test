<?php
declare(strict_types=1);

namespace App\RouteApi\Product;

use App\Models\Product;
use App\Models\SaveProduct;
use App\RouteApi\RouteApi;

class ProductUpdateApi extends RouteApi
{
    /**
     * @param array|mixed[] $params
     * @return mixed|void
     * @throws \Exception
     */
    public function handle($params)
    {
        $product = new Product($params['name'], $params['price'], $params['description'], $params['retailer_id'], $params['id'], $params['image']);

        if (!SaveProduct::execute($product)) {
            throw new \Exception('Payment update error.');
        }

        $this->setPayload([
            'message' => 'Product updated.'
        ]);
    }
}
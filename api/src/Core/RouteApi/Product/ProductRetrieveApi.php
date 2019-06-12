<?php
declare(strict_types=1);

namespace App\RouteApi\Product;

class ProductRetrieveApi extends RouteApi
{
    /**
     * @param array|mixed[] $params
     * @return mixed|void
     * @throws \Exception
     */
    public function handle($params)
    {
        $product = new Product($params['name'], $params['price'], $params['description'], $params['retailer_id'], $params['id'], $params['image']);

        if (!RetrieveProduct::execute($product)) {
            throw new \Exception('Product retrieve error.');
        }

        $this->setPayload([
            'message' => 'Product retrieved.'
        ]);
    }
}
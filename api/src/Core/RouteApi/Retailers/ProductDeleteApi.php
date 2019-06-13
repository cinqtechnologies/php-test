<?php
declare(strict_types=1);

namespace App\RouteApi\Product;

use App\RouteApi\RouteApi;
use App\Models\DeleteProduct;

class ProductDeleteApi extends RouteApi
{
    /**
     * @param array $params
     */
    public function handle(array $params): void
    {
        $this->setPayload([
            'message' => DeleteProduct::execute(intval($params['id'])) ? 'Product deleted' : 'Product not deleted'
        ]);
    }
}
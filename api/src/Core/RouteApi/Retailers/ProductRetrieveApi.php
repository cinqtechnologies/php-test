<?php
declare(strict_types=1);

namespace App\RouteApi\Product;

use App\RouteApi\RouteApi;
use App\Models\RetrieveProduct;

class ProductRetrieveApi extends RouteApi
{
    /**
     * @param array|mixed[] $params
     * @throws \Exception
     */
    public function handle($params): void
    {
        $id = $params['id'] ? intval($params['id']) : null;
        $data = RetrieveProduct::execute($id);

        $this->setPayload([
            'message' => count($data) > 0 ? 'Product retrieved' : 'Product not found',
            'data' => $data
        ]);
    }
}
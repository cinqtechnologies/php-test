<?php
declare(strict_types=1);

namespace App\RouteApi\Product;

use App\RouteApi\RouteApi;

class ProductDeleteApi extends RouteApi
{
    /**
     * @param int $productId
     * @throws \Exception
     */
    public function handle(int $productId): void
    {
        if (!DeleteProduct::execute($productId)) {
            throw new \Exception('Payment delete error.');
        }

        $this->setPayload([
            'message' => 'Product deleted.'
        ]);
    }
}
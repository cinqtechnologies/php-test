<?php
declare(strict_types=1);

namespace App\RouteApi\Product;

use App\Models\Retailer;
use App\Models\SaveRetailer;
use App\RouteApi\RouteApi;

class RetailerCreateApi extends RouteApi
{
    /**
     * @param array|mixed[] $params
     * @return mixed|void
     * @throws \Exception
     */
    public function handle($params): void
    {
        $product = new Retailer($params['logo'], $params['description'], $params['website']);

        if (! SaveRetailer::execute($product)) {
            throw new \Exception('Retailer save error.');
        }

        $this->setPayload([
            'message' => 'Retailer saved.'
        ]);
    }
}
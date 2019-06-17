<?php
declare(strict_types=1);

namespace App\RouteApi\Retailer;

use App\Models\Retailer;
use App\Models\SaveRetailer;
use App\RouteApi\RouteApi;

class RetailerUpdateApi extends RouteApi
{
    /**
     * @param array|mixed[] $params
     * @return mixed|void
     * @throws \Exception
     */
    public function handle($params)
    {
        $retailer = new Retailer($params['logo'], $params['description'], $params['website'], $params['id']);

        if (!SaveRetailer::execute($retailer)) {
            throw new \Exception('Retailer update error.');
        }

        $this->setPayload([
            'message' => 'Retailer updated.'
        ]);
    }
}
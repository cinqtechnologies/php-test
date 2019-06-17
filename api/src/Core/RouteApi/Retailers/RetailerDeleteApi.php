<?php
declare(strict_types=1);

namespace App\RouteApi\Retailer;

use App\RouteApi\RouteApi;
use App\Models\DeleteRetailer;

class RetailerDeleteApi extends RouteApi
{
    /**
     * @param array $params
     */
    public function handle(array $params): void
    {
        $this->setPayload([
            'message' => DeleteRetailer::execute(intval($params['id'])) ? 'Retailer deleted' : 'Retailer not deleted'
        ]);
    }
}
<?php
declare(strict_types=1);

namespace App\RouteApi\Retailer;

use App\RouteApi\RouteApi;
use App\Models\RetrieveRetailer;

class RetailerRetrieveApi extends RouteApi
{
    /**
     * @param array|mixed[] $params
     * @throws \Exception
     */
    public function handle($params): void
    {
        $id = isset($params['id']) ? intval($params['id']) : null;
        $data = RetrieveRetailer::execute($id);

        $this->setPayload([
            'message' => $data !== false ? 'Retailer retrieved' : 'Retailer not found',
            'data' => $data
        ]);
    }
}
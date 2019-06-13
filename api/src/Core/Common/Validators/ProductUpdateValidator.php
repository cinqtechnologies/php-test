<?php
declare(strict_types=1);

namespace App\Validators;

class ProductUpdateValidator extends ApiValidator
{
    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'id' => 'integer',
            'price' => 'numeric',
            'retailer_id' => 'integer'
        ];
    }
}
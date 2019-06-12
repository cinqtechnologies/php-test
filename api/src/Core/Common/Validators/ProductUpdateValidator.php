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
            'id' => 'required|integer',
            'name' => 'required',
            'price' => 'required|numeric',
            'retailer_id' => 'required|integer',
            'description' => 'required'
        ];
    }
}
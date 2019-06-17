<?php
declare(strict_types=1);

namespace App\Validators;

class ProductCreateValidator extends ApiValidator
{
    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'name' => 'required',
            'price' => 'required|numeric',
            'retailer_id' => 'required|integer',
            'description' => 'required'
        ];
    }
}
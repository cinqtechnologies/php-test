<?php
declare(strict_types=1);

namespace App\Validators;

class ProductDeleteValidator extends ApiValidator
{
    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'id' => 'required|integer'
        ];
    }
}
<?php
declare(strict_types=1);

namespace App\Validators;

class RetailerUpdateValidator extends ApiValidator
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
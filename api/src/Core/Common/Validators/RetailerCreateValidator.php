<?php
declare(strict_types=1);

namespace App\Validators;

class RetailerCreateValidator extends ApiValidator
{
    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'logo' => 'required',
            'website' => 'required',
            'description' => 'required'
        ];
    }
}
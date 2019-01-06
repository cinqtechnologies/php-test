<?php
/**
 * Created by PhpStorm.
 * User: Renata
 * Date: 05/01/2019
 * Time: 21:55
 */

namespace App\Http\Services\Retailer;

use App\Retailer;
use Illuminate\Http\Request;
use Validator;
use Image;

class CreateRetailerService
{
    private static function validate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'description' => 'required',
            'website' => 'required|max:200',
            'logo' => 'required|image|max:40000',
        ])->validate();
    }

    private static function uploadLogo(Request $request)
    {
        return $request->file('logo')->store(
            'logos', 'public'
        );
    }

    public static function create(Request $request)
    {
        self::validate($request);

        $logo = self::uploadLogo($request);

        $retailer = new Retailer();
        $retailer->fill($request->only(['name', 'description']));
        $retailer->website = ltrim(strtolower(trim($request->input('website'))), 'http://');
        $retailer->logo = $logo;
        $retailer->save();

        return $retailer;
    }
}
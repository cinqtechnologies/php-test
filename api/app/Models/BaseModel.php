<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 08/05/19
 * Time: 22:00
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class BaseModel extends Model
{
    protected $rules = array();
    protected $errors = array();

    public function validate($data) {

        $validation = Validator::make($data, $this->rules);

        if($validation->fails())
        {
            $this->errors = $validation->errors();
            return false;
        }

        return true;
    }

    public function getErrors() {
        return $this->errors;
    }
}
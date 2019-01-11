<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('email_content')) {
    function email_content($email = '', $productObj) {
    	if(is_object($productObj)) {
	        $emailText = 'From: ecommerce@ecommerce.com' . PHP_EOL;
			$emailText .= 'To: ' . $email . PHP_EOL;
			$emailText .= 'Subject: Product info' . PHP_EOL;
			$emailText .= 'Product name: '. $productObj->product_name . PHP_EOL;
			$emailText .= 'Product price: '. $productObj->price . PHP_EOL;
			$emailText .= 'Product description: '. $productObj->description . PHP_EOL;
			$emailText .= 'Retailer: '. $productObj->retailer_name . PHP_EOL;

			return $emailText;
		}

		return false;
    }   
}
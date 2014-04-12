<?php

namespace App\Helpers;

class TextHelper
{

	// Format address display. Useful for excel file export, for example.
	// Jl. Dharmahusada 12, Surabaya, Jawa Timur, Indonesia, 123123
	public static function formatAddress($address, $city = '', $state = '', $country ='', $postalCode = '')
    {
		$list = array($address, $city, $state, $country, $postalCode);
		$list = array_filter($list);
		return implode(', ', $list);
	}

    public static function formatPrice($price)
    {
        return 'IDR ' . number_format($price);
    }
}

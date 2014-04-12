<?php
/**
 * Created by Jay from TrioDesign (trio@tgitriodesign.com).
 * Date: 5/6/13
 * Time: 2:05 PM
 *
 */
namespace App\Helpers;

use Skully\Core\ApplicationAwareHelper;

class TimeHelper extends ApplicationAwareHelper{

    public static function isEmpty($date)
    {
        if ($date == '0000-00-00 00:00:00' || empty($date)) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Retrieve date string from input, convert to string acceptable in database.
     * @param $date string
     * @return string
     */
    public static function toDb($date) {
        if (empty($date)) {
            return '0000-00-00 00:00:00';
        }
        else {
            return self::date(\DateTime::ISO8601, strtotime($date));
        }
    }

	// PHP date function with a twist. With standard function, null returned year 1970 date. With this, returns '' instead.
	public static function date($format, $timestamp) {
		if (empty($timestamp)) {
			return '';
		}
		else {
			return date($format, $timestamp);
		}
	}
    public static function toLongDateTimeFormat($timestamp){
		return date(self::$app->config("longDateTimeFormat"), intval($timestamp));
	}

    public static function toShortDateTimeFormat($timestamp){
		return date(self::$app->config("shortDateTimeFormat"), intval($timestamp));
	}

    public static function toLongDateFormat($timestamp){
		return date(self::$app->config("longDateFormat"), intval($timestamp));
	}

    public static function toShortDateFormat($timestamp){
		return date(self::$app->config("shortDateFormat"), intval($timestamp));
	}

    public static function getDay($timestamp){
		return date("d", $timestamp);
	}

    public static function getMonth($timestamp){
		return date("m", $timestamp);
	}

    public static function getYear($timestamp){
		return date("Y", $timestamp);
	}

    public static function diff($timestampStart, $timestampEnd){
		$diff = array(
			"days"      => 0,
			"hours"     => 0,
			"minutes"   => 0,
			"seconds"   => 0
		);

		$t = $timestampEnd - $timestampStart;
		$diff["days"] = floor($t / 86400);
		$t = $t % 86400;
		$diff["hours"] = floor($t / 3600);
		$t = $t % 3600;
		$diff["minutes"] = floor($t / 60);
		$t = $t % 60;
		$diff["seconds"] = $t;

		return $diff;
	}

    public static function timeLeft($until) {
		$remaining = "";
		$temp = self::diff(time(), $until);
		if($temp["days"] > 0)$remaining = $temp["days"]." day" . ($temp["days"] > 1 ? "s" : "");
		else if($temp["hours"] > 0)$remaining = $temp["hours"]." hour" . ($temp["hours"] > 1 ? "s" : "");
		else if($temp["minutes"] > 0)$remaining = $temp["minutes"]." minute" . ($temp["minutes"] > 1 ? "s" : "");
		else if($temp["seconds"] > 0)$remaining = $temp["seconds"]." second" . ($temp["seconds"] > 1 ? "s" : "");
		return $remaining;
	}
}
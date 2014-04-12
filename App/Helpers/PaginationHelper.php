<?php
/**
 * Created by Trio (jay@tgitriodesign.com).
 * Date: 5/6/13
 * Time: 2:05 PM
 *
 */
namespace App\Helpers;
class PaginationHelper
{
	public function create($options = array()){
		//required options :
		//curr  => current page
		//url   => controller url
		//totalRows => total data
		//perPage => rows per page

		//numLinks => num of page link shown default 5
		//noun => default "rows"
		//param => url param

		$default = array(
			"curr"          => 1,
			"url"           => "",
			"totalRows"    => 0,
			"perPage"      => 10,

			"numLinks"     => 5,
			"noun"          => "rows",
			"param"         => "_page",
            "next"          => "next",
            "prev"          => "prev"
		);

		$options = array_merge($default, $options);

		$param = $options["param"];


		$n = ceil($options["totalRows"] / $options["perPage"]);

		$start = ($options["curr"]-1) * $options["perPage"] + 1;
		if($options["totalRows"] == 0)$start = 0;
		$end = $options["perPage"] * $options["curr"];
		if($end > $options["totalRows"])$end = $options["totalRows"];

		$result = array(
			"status" => "",
			"nav" => "",
			"pages" => "",
			"prev" => "",
			"next" => "",
            "numberOfPages" => $n
		);

		$result["status"] = '<span class="status">' . $options["curr"] . "/" . $n . "</span>";

		$left = floor($options["numLinks"] / 2);
		$right = $options["numLinks"] - $left - 1;
		$i = $options["curr"] - $left;

		if($options["curr"] > 1){
			$result["prev"] = '<a class="prev" href="'.str_replace($param, $options["curr"] - 1, $options["url"]).'"><i></i>'.$options["prev"].'</a>';
			$result["nav"] .= $result["prev"];
			$result["pages"] .= '<a href="'.str_replace($param, $options["curr"] - 1, $options["url"]).'">&lt;</a>';
		}
        else{
            $result["prev"] = '<a class="prev disabled" href="#"><i></i>'.$options["prev"].'</a>';
        }

		for(;$i< $options["curr"]; $i++){
			if($i > 0)
				$result["pages"] .= '<a href="'.str_replace($param, $i, $options["url"]).'" >'.$i.'</a>';
		}
		$result["pages"] .= '<a href="#" class="current">'.$options["curr"].'</a>';
		$i++;
		for(;$i> $options["curr"] && $i <= $n && $i <= $options["curr"] + $right; $i++){
			$result["pages"] .= '<a href="'.str_replace($param, $i, $options["url"]).'" >'.$i.'</a>';
		}

		if($options["curr"] < $n){
			$result["next"] = '<a class="next" href="'.str_replace($param, $options["curr"] + 1, $options["url"]).'">'.$options["next"].'<i></i></a>';
			$result["nav"] .= $result["next"];
			$result["pages"] .= '<a href="'.str_replace($param, $options["curr"] + 1, $options["url"]).'">&gt;</a>';
		}
        else{
            $result["next"] = '<a class="next disabled" href="#">'.$options["next"].'<i></i></a>';
        }

		return $result;
	}
}

<?php

class PDF extends \FPDF
{
	function __construct()
	{
		parent::FPDF();
	}

	function BorderedTable($header, $columns, $data, $headerLineHeight=7, $lineHeight=6){
		// Colors, line width and bold font
		$this->SetFillColor(240,240,240);
		$this->SetTextColor(0,0,0);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.1);
		$this->SetFont('','b');
		// Header
		for($i=0;$i<count($header);$i++)
			$this->Cell($header[$i]["width"],$headerLineHeight,$header[$i]["title"],1,0,(empty($header[$i]["align"]) ? 'C' : $header[$i]["align"]),true);
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(250,250,250);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = false;
		foreach($data as $row)
		{
			foreach($columns as $c){
				$this->Cell($c["width"],$lineHeight,$row[$c["index"]],1,0,(empty($c["align"]) ? 'L' : $c["align"]),$fill);
			}
			$this->Ln();
			$fill = !$fill;
		}
	}

	function BorderedTable2($header, $columns, $data, $headerLineHeight=7, $lineHeight=6){
		// Colors, line width and bold font
		$this->SetFillColor(240,240,240);
		$this->SetTextColor(0,0,0);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.1);
		$this->SetFont('','b');
		// Header
		for($i=0;$i<count($header);$i++)
			$this->Cell($header[$i]["width"],$headerLineHeight,$header[$i]["title"],1,0,(empty($header[$i]["align"]) ? 'C' : $header[$i]["align"]),true);
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(250,250,250);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = false;
		foreach($data as $row)
		{
			foreach($columns as $c){
				$this->Cell($c["width"],$lineHeight,$row[$c["index"]],'LR',0,(empty($c["align"]) ? 'L' : $c["align"]),$fill);
			}
			$this->Ln();
			$fill = !$fill;
		}

		// Closing line
		$w = 0;
		foreach($columns as $c){
			$w += $c["width"];
		}
		$this->Cell($w,0,'','T');
		$this->Ln();
	}

	function NoBorderTable($header, $columns, $data, $headerLineHeight=7, $lineHeight=6){
		// Colors, line width and bold font
		$this->SetFillColor(240,240,240);
		$this->SetTextColor(0,0,0);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.1);
		$this->SetFont('','b');
		// Header
		for($i=0;$i<count($header);$i++)
			$this->Cell($header[$i]["width"],$headerLineHeight,$header[$i]["title"],'T',0,(empty($header[$i]["align"]) ? 'C' : $header[$i]["align"]),true);
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(250,250,250);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = false;
		foreach($data as $row)
		{
			foreach($columns as $c){
				$this->Cell($c["width"],$lineHeight,$row[$c["index"]],0,0,(empty($c["align"]) ? 'L' : $c["align"]),$fill);
			}
			$this->Ln();
			$fill = !$fill;
		}
		// Closing line
		$w = 0;
		foreach($columns as $c){
			$w += $c["width"];
		}
		$this->Cell($w,0,'','T');
		$this->Ln();
	}
}

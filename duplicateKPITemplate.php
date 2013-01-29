<?php
/**
 * KPI Dashboard
 *
 * Copyright (C) Oppoin 2012-2013
 *
 * Duplicate the KPI Template in the InputFiles folder into ExcelFiles folder and 
 * change one value in one of the hidden sheets
 *
 * @category   KPIDashboard
 * @package    KPIDashboard
 * @copyright  Copyright (c) Oppoin 2012-2013 
 * @version    0.0.1 21/1/2013
 */

/** call constants.php */
include 'constants.php';
 
/** PHPExcel_IOFactory */
include 'Classes/PHPExcel/IOFactory.php';

$inputFileName = KPI_TEMPLATE_PATH;
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);

$inputFileNameShort = basename($inputFileName);

if (!file_exists($inputFileName)) {
	echo date('H:i:s') , " File " , $inputFileNameShort , ' does not exist' , EOL;
	continue;
}

// here we duplicate the input file to output file

// $result = copy ($inputFileName, KPI_OUTPUT_PATH);
// if ($result){
	// echo date('H:i:s') , " Load Test from $inputFileName successfully copied to " . KPI_OUTPUT_PATH , EOL;
// }


echo date('H:i:s') , " Load from Excel2007 file" , EOL;

$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objReader->setIncludeCharts(TRUE);
$objPHPExcel = $objReader->load($inputFileName);

//change the value of _Hidden1 sheet, cell D2 to 0
$objPHPExcel->getSheetByName('_Hidden1')
			->setCellValue('A1', 'Hello');

$worksheet = $objPHPExcel->getSheetByName('Overview');
$chartNames = $worksheet->getChartNames();
if(empty($chartNames)) {
	echo '    There are no charts in this worksheet' , EOL;
} else {
	natsort($chartNames);
	foreach($chartNames as $i => $chartName) {
		$chart = $worksheet->getChartByName($chartName);
		if (!is_null($chart->getTitle())) {
			$caption = '"' . implode(' ',$chart->getTitle()->getCaption()) . '"';
		} else {
			$caption = 'Untitled';
		}
		echo '    ' , $chartName , ' - ' , $caption , EOL;
		echo str_repeat(' ',strlen($chartName)+3);
		$groupCount = $chart->getPlotArea()->getPlotGroupCount();
		if ($groupCount == 1) {
			$chartType = $chart->getPlotArea()->getPlotGroupByIndex(0)->getPlotType();
			echo '    ' , $chartType , EOL;
		} else {
			$chartTypes = array();
			for($i = 0; $i < $groupCount; ++$i) {
				$chartTypes[] = $chart->getPlotArea()->getPlotGroupByIndex($i)->getPlotType();
			}
			$chartTypes = array_unique($chartTypes);
			if (count($chartTypes) == 1) {
				$chartType = 'Multiple Plot ' . array_pop($chartTypes);
				echo '    ' , $chartType , EOL;
			} elseif (count($chartTypes) == 0) {
				echo '    *** Type not yet implemented' , EOL;
			} else {
				echo '    Combination Chart' , EOL;
			}
		}
	}
}

echo date('H:i:s') , " Write to Excel2007 format" , EOL;
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(true);
$objWriter->save(KPI_OUTPUT_PATH);
echo date('H:i:s') , " File written to " , KPI_OUTPUT_PATH , EOL;


<?php

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Singapore');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Defining paths */
define('DS', DIRECTORY_SEPARATOR);

define('INPUTFILES', 'InputFiles');
define('OUTPUTFILES', 'OutputFiles');
define('KPI_TEMPLATE_PATH', INPUTFILES . DS . 'KPITemplate.xlsx');
define('KPI_OUTPUT_PATH', OUTPUTFILES . DS . 'KPIOutput.xlsx');
define('Q7N_TEMPLATE_PATH', INPUTFILES . DS . 'Q7NTemplate.xls');
define('Q7N_OUTPUT_PATH', OUTPUTFILES . DS . 'Q7NOutput.xlsx');

//define('Q7N_TEMPLATE_PATH', INPUTFILES . DS . 'Appendix II to Annex 5 - FY12_13 Radio Pricing Schedule.xls');

define('ME', 'Wesley Jace Tan');

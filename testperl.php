<?php


echo ("Hello World");


$perl = new Perl();
$perl->require("perl_write.pl");
$perl->eval("writeFile();");

/*
$perlscript_file = "./someperlscript.pl";
ob_start();
passthru($perlscript_file);
$perlreturn = ob_get_contents();
ob_end_clean();*/
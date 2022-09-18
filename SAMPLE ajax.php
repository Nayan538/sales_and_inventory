<?php
include("app/Http/Controllers/View.php");

$view = new View;

if((@$_POST['abc_report_edit']) > 0)
{
	$view->loadContent("include", "assets");
	$view->loadContent("content", "abc-report-edit");
}
?>
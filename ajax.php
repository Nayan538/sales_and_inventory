<?php
include("app/Http/Controllers/View.php");

$view = new View;

$view->loadContent("content", "ajax");
?>
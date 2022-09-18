<?php
# CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");

# CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$eloquent = new Eloquent;
## ===*=== [F]ETCH SUBCATEGROY DATA BASED ON CATEGORY | EDIT PRODUCT ===*=== ##
if($_POST['ajax_edit_product'] == "YES")
{
	$columnName = "*";
	$tableName = "subcategories";
	$whereValue['category_id'] = $_POST['category_id'];
	$subcategoryList = $eloquent->selectData($columnName, $tableName, $whereValue);

	echo '<option value="">Select a Subcategory</option>';
	foreach($subcategoryList AS $eachRow)
	{
		echo '<option value="'. $eachRow['id'] .'" ';
		
		if($eachRow['id'] == $_POST['subcategory_id'])
			echo 'selected';		
		
		echo ' >'. $eachRow['subcategory_name'] .'</option>';
	}
}
## ===*=== [F]ETCH SUBCATEGROY DATA BASED ON CATEGORY | EDIT PRODUCT ===*=== ##
##### LOAD THE "Subcategory List" OF A "Category ID" ON CREATE PRODUCT PAGE
if($_POST['ajax_create_product'] == "YES")
{
	$columnName = "*";
	$tableName = "subcategories";
	$whereValue['category_id'] = $_POST['category_id'];
	$subcategoryList = $eloquent->selectData($columnName, $tableName, $whereValue);

	echo '<option value="">Select a Subcategory</option>';

	foreach($subcategoryList AS $eachRow)
	{
		echo '<option value="'. $eachRow['id'] .'" >'. $eachRow['subcategory_name'] .'</option>';
	}
}
##### LOAD THE "Product List" OF A "Subcategory ID" ON CREATE Order PAGE
if($_POST['ajax_create_order'] == "YES")
{
	$columnName = "*";
	$tableName = "products";
	$whereValue['subcategory_id'] = $_POST['subcategory_id'];
	$productList = $eloquent->selectData($columnName, $tableName, $whereValue);

	echo '<option value="">Select a Product</option>';

	foreach($productList AS $eachRow)
	{
		echo '<option value="'. $eachRow['id'] .'" >'. $eachRow['product_name'] .'</option>';
	}
}
if($_POST['ajax_create_order_price'] == "YES")
{
$columnName = "*";
$tableName = "products";
$whereValue['id'] = $_POST['product_id'];
$customerList = $eloquent->selectData($columnName, $tableName, $whereValue);

foreach($customerList AS $eachRow)
{
	echo '<option value="'. $eachRow['id'] .'" >'. $eachRow['product_price'] .'</option>';
}
}
if($_POST['ajax_customer_number'] == "YES")
{
	$columnName = "*";
	$tableName = "customers";
	$whereValue['id'] = $_POST['customer_id'];
	$customerNumber = $eloquent->selectData($columnName, $tableName, $whereValue);

	foreach($customerNumber AS $eachRow)
	{
		echo '<option value="'. $eachRow['id'] .'" >'. $eachRow['customer_mobile'] .'</option>';
	}
}
if($_POST['ajax_customer_address'] == "YES")
{
	$columnName = "*";
	$tableName = "customers";
	$whereValue['id'] = $_POST['customer_id'];
	$customerAddress = $eloquent->selectData($columnName, $tableName, $whereValue);

	foreach($customerAddress AS $eachRow)
	{
		echo '<option value="'. $eachRow['id'] .'" >'. $eachRow['customer_address'] .'</option>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="public/css/style.css" rel="stylesheet">
		<link href="public/css/custom.css" rel="stylesheet">
	</head>
	<body>
		
		<?php
			## ===*=== [C]ALLING CONTROLLER ===*=== ##
			include("app/Models/Eloquent.php");
			include("app/Http/Controllers/InvoiceValue.php");
			
			## ===*=== [O]BJECT DEFINED ===*=== ##
			$eloquent = new Eloquent;
			$getAmount = new InvoiceValue;
			
#### LIST OF PRODUCTS
if(isset($_POST['invoice_details']))
	{
		#== CREATE A SESSION ON INVOICE ID
		$_SESSION['SSCB_invoice_details'] = $_POST['order_id'];

$columnName["1"] = "customers.customer_name";
$columnName["2"] = "customers.customer_mobile";
$columnName["3"] = "customers.customer_address";
$columnName["4"] = "customers.customer_email";
$columnName["5"] = "orders.order_quantity";
$columnName["6"] = "orders.order_date";
$columnName["7"] = "orders.grand_total";
$columnName["8"] = "categories.category_name";
$columnName["9"] = "subcategories.subcategory_name";
$columnName["10"] = "orders.id";
$columnName["11"] = "products.product_price";
$columnName["12"] = "products.product_name";
$columnName["13"] = "products.product_summary";
$tableName["MAIN"] = "orders";
$joinType = "INNER";
$tableName["1"] = "categories";
$tableName["2"] = "subcategories";
$tableName["3"] = "products";
$tableName["4"] = "customers";
$onCondition["1"] = ["orders.category_id", "categories.id"];
$onCondition["2"] = ["orders.subcategory_id", "subcategories.id"];
$onCondition["3"] = ["orders.product_id", "products.id"];
$onCondition["4"] = ["orders.customer_id", "customers.id"];
$whereValue["orders.id"] = $_SESSION['SSCB_invoice_details'];
$queryResult = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue, @$formatBy, @$paginate);
/*
echo '<pre>';
print_r($queryResult);
echo '</pre>';
*/
}
	?>
		<section class="panel">
			<div class="container">		
				<div class="panel-body invoice">
					<div class="invoice-header">
						<div class="invoice-title col-md-3 col-xs-2" style="margin-top: 0px;">
							<h1>invoice</h1>
							<img class="logo-print" src="public/images/logoFrontEnd.png" alt="" style="width: 220px; height: 60px; margin-top: -65px; margin-bottom: -5px;">
						</div>
						<div class="invoice-info col-md-9 col-xs-10">
							<div style="margin-left: 300px;">
								<div class="col-md-6 col-sm-6">
									
									<?php 
										echo' <p> '. $queryResult[0]['customer_name'] .'<br>'. $queryResult[0]['customer_address'] .'</p>';
									?>
									
								</div>
								<div class="col-md-6 col-sm-6">
									
									<?php 
										echo '<p>Phone: '. $queryResult[0]['customer_mobile'] .'<br> Email : '. $queryResult[0]['customer_email'] .'</p>';
									?>
									
								</div>
							</div>
						</div>
					</div>
					
					<div class="row invoice-to">
						<div class="col-md-4 col-sm-4 pull-left">
							<h4>Invoice To:</h4>
							
							<?php
								echo '<h2>'.$queryResult[0]['customer_name'] .'</h2>
										<p>Phone: +880 '. 
											$queryResult[0]['customer_mobile'] .'<br>'. 
											$queryResult[0]['customer_address'] .'<br>'. 
										'</p>';
							?>
							
						</div>
						<div class="col-md-4 col-sm-5 pull-right">
							<div class="row">
								<div class="col-md-4 col-sm-5 inv-label" style="font-style: normal; font-size: 16px;"> Invoice # </div>
								<div class="col-md-8 col-sm-7"> <?= $queryResult[0]['id'] ?></div>
							</div>
							<div class="row">
								<div class="col-md-4 col-sm-5 inv-label" style="font-style: normal; font-size: 16px;"> Date # </div>
								<div class="col-md-8 col-sm-7"> <?= $queryResult[0]['order_date'] ?> </div>
							</div>
							<br>
							<div class="row">
							<br><br><br><br>
							</div>
					</div>
					<table class="table table-invoice">
						<tr style="color: #73737b; font-weight: bold;">
							<td> # </td>
							<td> Item Description </td>
							<td class="text-center"> Unit Cost </td>
							<td class="text-center"> Quantity </td>
							<td class="text-center"> Total </td>
						</tr>
						<tbody>
							
							<?php
								#== PRODUCT DATA TABLE
								$n = 1;
								foreach($queryResult AS $eachProduct)
								{
									$subTotal = $eachProduct['product_price'] * $eachProduct['order_quantity'];
									echo '
									<tr>
										<td>'. $n .'</td>
										<td>
											<h4>'. $eachProduct['product_name'] .'</h4>
											<p>'. $eachProduct['product_summary'] .'</p>
										</td>
										<td class="text-center">'. $eachProduct['product_price'] .'</td>
										<td class="text-center">'. $eachProduct['order_quantity'] .'</td>
										<td class="text-center">'. $subTotal .'</td>
									</tr>
									';
									$n++;
								}
							?>
							
						</tbody>
					</table>
					<div class="row">
						<div class="col-md-8 col-xs-7 payment-method">
							<h4> Payment Method </h4>
							<p> 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
							<p> 2. Pellentesque tincidunt pulvinar magna quis rhoncus. </p>
							<p> 3. Cras rhoncus risus vitae congue commodo. </p>
							<p style="margin-top: 24px; font-style: normal; font-size: 17px;" class="inv-label"> 
								<span style="color: orange; font-weight: bold;">IN AMOUNT: </span>
								<?php echo $getAmount->inAwords($subTotal) . ' TAKA ONLY'?>
							</p>
							<h5 class="inv-label" style="font-style: normal"> Thank you for your business </h5>
						</div>
						<div class="col-md-4 col-xs-5 invoice-block pull-right">
							<ul class="unstyled amounts">
								
								<?php
									#== TOTAL SUMMARY
									echo '
										
										<li class="grand-total"> Grand Total : 
											'. $GLOBALS['CURRENCY'] ." ". $subTotal.'
										</li>
									';
								?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--=*= INVOICE PRINT SECTION END =*=-->
	</body>
</html>		

<!--=*= JS PRINT SCRIPT =*=-->
<script type="text/javascript">
	window.print();
</script>
<!--=*= JS PRINT SCRIPT =*=-->
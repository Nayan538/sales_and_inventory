<?php
#### CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");

#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$orderCtrl = new Controller;
$eloquent = new Eloquent;

#### LIST OF PRODUCTS
$columnName["1"] = "customers.customer_name";
$columnName["2"] = "customers.customer_mobile";
$columnName["3"] = "customers.customer_address";
$columnName["4"] = "orders.order_quantity";
$columnName["5"] = "orders.grand_total";
$columnName["6"] = "categories.category_name";
$columnName["7"] = "products.product_name";
$columnName["8"] = "orders.id";
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
$queryResult = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue, @$formatBy, @$paginate);


?>

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-sm-12">
			
			<!--breadcrumbs start -->
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">Order List</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					ORDER'S LIST
				</header>
				<div class="panel-body">
					<div class="adv-table">
						<table  class="display table table-bordered table-striped" id="dynamic-table">
							<thead>
								<tr>
									<th>Order Id</th>
									<th>Customer Name</th>
									<th>Customer Number</th>
									<th>Customer Address</th>
									<th>Product Category</th>
									<th>Product Name</th>
									<th>Product Quantity</th>
									<th>Orders Price</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
										foreach ($queryResult as $eachRow) 
										{
										echo '
										<tr class="gradeA">
										<td>'.$eachRow["id"]."-abc".'</td>
										<td>'.$eachRow["customer_name"].'</td>
										<td>'.$eachRow["customer_mobile"].'</td>
										<td>'.$eachRow["customer_address"].'</td>
										<td>'.$eachRow["category_name"].'</td>
										<td>'.$eachRow["product_name"].'</td>
										<td>'.$eachRow["order_quantity"].'</td>
										<td>'.$eachRow["grand_total"].'</td>

										<td class="center">
										<form action="invoice-print.php" method="post" style="display: inline">
										<input type="hidden" name="order_id" value="'. $eachRow['id'] .'"/>
										<button name="invoice_details" class="btn btn-info btn-xs" style="width: 76px;" type="submit">
											<i class="fa fa-pencil-square"></i> View
										</button>
										</form>
										</td>
										</tr> 
										';
										}
								
								?>
							</tbody>
							<tfoot>
								<tr>
									<th>Order Id</th>
									<th>Customer Name</th>
									<th>Customer Number</th>
									<th>Customer Address</th>
									<th>Product Category</th>
									<th>Product Name</th>
									<th>Product Quantity</th>
									<th>Orders Price</th>
									<th>Action</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->
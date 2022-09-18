<?php
#### CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");

#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$eloquent = new Eloquent;

?>

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-sm-12">
			
			<!--breadcrumbs start -->
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">Order Details</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					ORDER DETAILS
				</header>
				<div class="panel-body">
					<div class="adv-table">
						<table  class="display table table-bordered table-striped" id="dynamic-table">
							<thead>
								<tr>
									<th>Customer Name</th>
									<th>Customer Number</th>
									<th>Customer Address</th>
									<th>Product Category</th>
									<th>Product Name</th>
									<th>Product Quantity</th>
									<th>Product Price</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
/*
									$n = 1;
									foreach ($itemData as $eachRow) 
									{
										echo '
										<tr class="gradeA">
										<td>'.$n.'</td>
										<td>'.$eachRow["product_id"].'</td>
										<td>image</td>
										<td>'.$eachRow["product_price"].' &dollar;</td>
										<td class="center">
										<a href="?aid='.$n.'"><button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-o"></i> Delete</button></a>
										</div>
										</td>
										</tr>
										';
										$n++;
									}
									*/
								?>           
							</tbody>        
							<tfoot>
								<tr>
									<th>Customer Name</th>
									<th>Customer Number</th>
									<th>Customer Address</th>
									<th>Product Category</th>
									<th>Product Name</th>
									<th>Product Quantity</th>
									<th>Product Price</th>
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
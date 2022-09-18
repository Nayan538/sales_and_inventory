<?php
#### CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");

#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$eloquent = new Eloquent;

#### DELETE PRODUCT 
if(isset($_REQUEST['did']))
{
	# Get the Delete File Information
	$columnName = "*";
	$tableName = "products";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteFile = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	# Delete the File
	$tableName = "products";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteResult = $eloquent->deleteData($tableName, $whereValue);
	
	if($deleteResult > 0)
	{
		unlink($GLOBALS['PRODUCT_DIRECTORY'].$deleteFile[0]['product_master_image']);
	}
}

#### CHANGE STATUS
if(isset($_POST['change_status']))
{
	$tableName1 = "products";
	$whereValue1["id"] = $_POST['change_status_id'];
	
	if($_POST['current_status'] == "In Stock")
	{
		$columnValue1["product_status"] = "Out of Stock";
	}
	else if($_POST['current_status'] == "Out of Stock")
	{
		$columnValue1["product_status"] = "In Stock";
	}
	$updateStatus = $eloquent->updateData($tableName1, $columnValue1, @$whereValue1);
}

#### LIST OF PRODUCTS
$columnName["1"] = "products.id";
$columnName["2"] = "products.product_name";
$columnName["3"] = "products.product_master_image";
$columnName["4"] = "products.product_quantity";
$columnName["5"] = "products.product_price";
$columnName["6"] = "products.product_status";
$columnName["7"] = "categories.category_name";
$columnName["8"] = "subcategories.subcategory_name";
$tableName["MAIN"] = "products";
$joinType = "INNER";
$tableName["1"] = "categories";
$tableName["2"] = "subcategories";
$onCondition["1"] = ["products.category_id", "categories.id"];
$onCondition["2"] = ["products.subcategory_id", "subcategories.id"];
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
				<li class="active">Product List</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					PRODUCT LIST
				</header>
				<div class="panel-body">
					
					<?php 
						# DELETE MESSAGE
						if (isset($_REQUEST['did'])) 
						{
							if ($deleteResult > 0)
							echo "<div class='alert alert-success'>This Product is deleted successfully</div>";
							else
							echo "<div class='alert alert-danger'>Something went wrong while delete the Product! Please recheck.</div>";
						}
						
						/*
						# STATUS CHANGE MESSAGE
						if (isset($_POST['change_status'])) 
						{
							if ($updateStatus > 0)
							echo "<div class='alert alert-success'>Product status is updated successfully.</div>";
							else
							echo "<div class='alert alert-danger'>Something went wrong while updating the product status! Please recheck.</div>";
						}
						*/
					?>
					
					<div class="adv-table">
						<table class="display table table-bordered" id="dynamic-table">
							<thead>
								<tr>
									<th>Prod. ID</th>
									<th>Category</th>
									<th>SubCategory</th>
									<th>Prod. Name</th>
									<th>Prod. Image</th>
									<th>Prod. Qty.</th>
									<th>Prod. Price</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							
							<?php 
								$n = 1;
								foreach ($queryResult as $eachRow) 
								{
									if(empty($eachRow['product_master_image']))
										$productImage = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";
									else
										$productImage = $GLOBALS['PRODUCT_DIRECTORY'].$eachRow['product_master_image'];
									
									echo '
									<tr class="gradeA">
										<td>'.$n.'</td>
										<td>'.$eachRow['category_name'].'</td>
										<td>'.$eachRow['subcategory_name'].'</td>
										<td>'.$eachRow["product_name"].'</td>
										<td class="center">
											<a target="_blank" href="'.$productImage.'">
												<img src="'.$productImage.'" height="40px" width="45px"></a>
											</td>
										<td>'.$eachRow["product_quantity"].'</td>
										<td>'.$eachRow["product_price"].' <span> TK.</span></td>
										<td  class="center">
											<form method="post" action="">
												<input type="hidden" name="change_status_id" value="'.$eachRow["id"].'"/>
												<input type="hidden" name="current_status" value="'.$eachRow["product_status"].'"/>
												<button name="change_status" class="btn btn-info btn-xs" type="submit">'.$eachRow["product_status"].'</button>
											</form>
										</td>
										<td class="center">
											<div class="row">
											<a data-id="'.$eachRow['id'].'" href="#deleteModal" class="btn btn-danger btn-xs float-right deleteButton" data-toggle="modal"><i class="fa fa-trash-o"></i> Delete</a>
											<form method="post" action="edit-product.php" style="display:inline;">
												<input type="hidden" name="id" value="'.$eachRow["id"].'"/>
												<button name="edit_data" class="btn btn-warning btn-xs" type="submit"><i class="fa fa-pencil-square"></i> Edit</button>
											</form>
											</div>
										</td>
									</tr> 
									';
									$n++;
								}
							?>
							
							</tbody>    
							<tfoot>
								<tr>
									<th>Prod. ID</th>
									<th>Category</th>
									<th>SubCategory</th>
									<th>Prod. Name</th>
									<th>Prod. Image</th>
									<th>Prod. Qty.</th>
									<th>Prod. Price</th>
									<th>Status</th>
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

<!-- Delete Modal Start -->
<div class="modal small fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Delete Product?</h4>
			</div>
			<div class="modal-body">
				<h5>Are you sure you want to delete this Product?</h5>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default"data-dismiss="modal" aria-hidden="true">Cancel</button> 
				<a href="list-customer.php" class="btn btn-danger" id="modalDelete" >Delete</a>
			</div>
		</div>
	</div>
</div>
<!-- Delete Modal End -->

<!-- LIBRARY -->
<script src="public/js/jquery-1.10.2.min.js"></script>

<!-- Script to Delete Start-->
<script>
	$('.deleteButton').click(function(){
		var id = $(this).data('id');
		
		$('#modalDelete').attr('href','list-product.php?did='+id);
	})
</script>
<!-- Script to Delete End-->
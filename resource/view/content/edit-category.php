<?php
#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$eloquent = new Eloquent;

#### UPDATE CATEGORY DATA
if(isset($_POST['try_update']))
{
	$tableName = "categories";
	$columnValue["category_name"] = $_POST['category_name'];
	$columnValue["category_status"] = $_POST['category_status'];
	$whereValue["id"] = $_SESSION['SMC_edit_category_id'];
	
	$updateResult = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}

#### GET EXISTING CATEGORY DATA
if( isset($_POST['try_edit']) )
{
	$_SESSION['SMC_edit_category_id'] = $_POST['category_id'];
	
	$columnName = "*";
	$tableName = "categories";
	$whereValue["id"] = $_SESSION['SMC_edit_category_id'];
	$queryResult = $eloquent->selectData($columnName, $tableName, @$whereValue);
}
else
{
	$columnName = "*";
	$tableName = "categories";
	$whereValue["id"] = $_SESSION['SMC_edit_category_id'];
	$queryResult = $eloquent->selectData($columnName, $tableName, @$whereValue);
}

?>

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			
			<!--breadcrumbs start -->
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">Edit Category</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					EDIT CATEGORY
				</header>
				<div class="panel-body">
				
					<?php 
					# UPDATE MESSAGE
					if(isset($_POST['try_update']))
					{
						if($updateResult > 0)
							echo '<div class="alert alert-success">The Slider record is updated successfully!</div>';
						else
							echo '<div class="alert alert-danger">Something went wrong! Unable to update. Please recheck.</div>';
					}
					?>
					
					<div class="form">
						<form class="cmxform form-horizontal adminex-form" id="signupForm" method="post" action="">
							<div class="form-group ">
								<label for="CategoryName" class="control-label col-lg-2">Category Name</label>
								<div class="col-lg-7">
									<input class=" form-control" name="category_name" type="text" value="<?php echo $queryResult[0]['category_name']?>" />
								</div>
							</div>
							<div class="form-group ">
								<label for="CategoryStatus" class="control-label col-lg-2">Category Status</label>
								<div class="col-lg-7">
									<select class="form-control m-bot15" name="category_status">
										<option <?php if($queryResult[0]['category_status'] == "Active") echo "selected";?>>Active</option>
										<option <?php if($queryResult[0]['category_status'] == "Inactive") echo "selected";?>>Inactive</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button name="try_update" class="btn btn-primary" type="submit">Update</button>
									<a href="list-category.php" class="btn btn-default" style="text-decoration: none;">Category List</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->
<?php	
#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$eloquent = new Eloquent;

#### UPDATE SUBCATEGORY DATA
if(isset($_POST['try_update']))
{
	$_SESSION['SMC_edit_subcategory_id'] = $_POST['id'];
	
	$tableName = "subcategories";
	$columnValue["subcategory_name"] = $_POST['subcategory_name'];
	$columnValue["category_id"] = $_POST['category_id'];
	$columnValue["subcategory_status"] = $_POST['subcategory_status'];
	$whereValue["id"] = $_SESSION['SMC_edit_subcategory_id'];
	
	$updateResult = $eloquent->updateData($tableName, $columnValue, $whereValue);
	
}


#### WHEN USER IS COMING FROM "SUBCATEGORY LIST" PAGE WITH AN "ID", 
#### HOLD THAT ID IN A SESSION VARIABLE
if(isset($_POST['edit_subcategory_id']))
{
	$_SESSION['SMC_edit_subcategory_id'] = $_POST['edit_subcategory_id'];
}

$tableName = $columnValue = $whereValue = null;

$columnName["1"] = "subcategories.subcategory_name";
$columnName["2"] = "subcategories.subcategory_status";
$columnName["3"] = "subcategories.category_id";
$columnName["4"] = "subcategories.id";
$tableName["MAIN"] = "subcategories";
$joinType = "INNER";
$tableName["1"] = "categories";
$onCondition["1"] = ["subcategories.category_id", "categories.id"];
$whereValue["subcategories.id"] = $_SESSION['SMC_edit_subcategory_id'];
$subcategoryDetails = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue);

$tableName = $columnValue = null;

#### LOAD CATEGORY DATA
$columnName = "*";
$tableName = "categories";
$categoryList = $eloquent->selectData($columnName, $tableName);

?>

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			
			<!--breadcrumbs start -->
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">Edit Sub Category</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					EDIT SUB CATEGORY
				</header>
				<div class="panel-body">
					<?php 
						if (isset($_POST['try_update'])) 
						{
							if (@$updateResult > 0) 
								echo "<div class='alert alert-success'>Sub Category is updated successfully</div>";
							else
								echo "<div class='alert alert-danger'>Something went wrong while update the Product! Please recheck.</div>";
						}
					?>
					
					<div class="form">
						<form class="form-horizontal adminex-form" id="subCategory" method="post" action="">
							<div class="form-group ">
								<label for="SubCategoryName" class="control-label col-lg-2">Sub Category Name</label>
								<div class="col-lg-7">
									<input class=" form-control" id="subcategory_name" name="subcategory_name" type="text" value="<?php echo $subcategoryDetails[0]['subcategory_name'];?>"/>
								</div>
							</div>
							<div class="form-group ">
								<label for="MainCategoryName" class="control-label col-lg-2">Category Name</label>
								<div class="col-lg-7">
									<select name="category_id" id="category_id" class="form-control">
										<option>Select a Category</option>
										<?php
											foreach($categoryList as $eachRow)
											{
												echo '<option value="'. $eachRow['id'] .'" '; 
												if($eachRow['id'] == $subcategoryDetails[0]['category_id'])		
													{
														echo 'selected';
													}
												echo ' >'. $eachRow['category_name'] .'</option>' ;
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group ">
								<label for="status" class="control-label col-lg-2">Sub Category Status</label>
								<div class="col-lg-7">
									<select name="subcategory_status" class="form-control">
										<option <?php if($subcategoryDetails[0]['subcategory_status'] == "Active") echo "selected";?>>Active</option>
										<option <?php if($subcategoryDetails[0]['subcategory_status'] == "Inactive") echo "selected";?>>Inactive</option>
									</select>
								</div>
							</div>
							<input type="hidden" name="id" value="<?php echo $subcategoryDetails[0]['id']; ?>" >
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button name="try_update" class="btn btn-primary" type="submit">Update</button>
									<a href="list-subcategory.php" class="btn btn-default" style="text-decoration: none;">SubCategory List</a>
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
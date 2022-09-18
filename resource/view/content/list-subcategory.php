<?php
#### CALLING MODEL or QUERY BUILDER
include("app/Models/Eloquent.php");

$eloquent = new Eloquent;

#### DELETE ADMIN
if(isset($_REQUEST['did']))
{
	# Get the Delete File Information
	$columnName2 = "*";
	$tableName2 = "subcategories";
	$whereValue2["id"] = $_REQUEST['did'];
	$deleteData = $eloquent->selectData($columnName2, $tableName2, @$whereValue2);

	# Delete the Data
	$tableName2 = "subcategories";
	$whereValue2["id"] = $_REQUEST['did'];
	$deleteResult = $eloquent->deleteData($tableName2, $whereValue2);
}

#### CHANGE STATUS
if(isset($_POST['change_status']))
{
	$tableName1 = "subcategories";
	$whereValue1["id"] = $_POST['subcat_status_id'];
	
	if($_POST['current_status']  == "Active")
	{
		$columnValue["subcategory_status"] = "Inactive";
	}		
	else if($_POST['current_status']  == "Inactive")
	{
		$columnValue["subcategory_status"] = "Active";
	}
	
	$changeStatus = $eloquent->updateData($tableName1, $columnValue, @$whereValue1);
}

#### LIST of  SUBCATEGORY DATA
$columnName["1"] = "subcategories.subcategory_name";
$columnName["2"] = "subcategories.subcategory_status";
$columnName["3"] = "subcategories.id";
$columnName["4"] = "categories.category_name";
$tableName["MAIN"] = "subcategories";
$joinType = "INNER";
$tableName["1"] = "categories";
$onCondition["1"] = ["subcategories.category_id", "categories.id"];
$queryResult = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition);

?>

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-sm-12">
			
			<!--breadcrumbs start -->
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">Sub Category List</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					SUB CATEGORY LIST
				</header>
				<div class="panel-body">
				
				<?php
					# DELETE MESSAGE
					if(isset($_REQUEST['did']))
					{
						if($deleteResult > 0)
							echo '<div class="alert alert-success">SubCategory is deleted successfully.</div>';
						else
							echo '<div class="alert alert-danger">Something went wrong to delete! Please recheck.</div>';
					}
					
					# STATUS CHANGE MESSAGE
					if( isset($_POST['change_status']) )
					{
						if($changeStatus > 0)
							echo '<div class="alert alert-success">SubCategory status is changed successfully.</div>';
						else
							echo '<div class="alert alert-danger">Something went wrong to change this status! Please recheck.</div>';
					}
				?>
					
					<div class="adv-table">
						<table  class="display table table-bordered table-striped" id="dynamic-table">
							<thead>
								<tr>
									<th>ID</th>
									<th>Category Name</th>
									<th>Sub Category Name</th>
									<th>Sub Category Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							
							<?php
								$n = 1;
								foreach ($queryResult as $eachRow) 
								{
									echo '
										<tr class="gradeA">
											<td>'.$n.'</td>
											<td>'.$eachRow["category_name"].'</td>
											<td>'.$eachRow["subcategory_name"].'</td>
											<td class="center">
												<form method="post" action="">
													<input type="hidden" name="subcat_status_id" value="'.$eachRow["id"].'"/>
													<input type="hidden" name="current_status" value="'.$eachRow["subcategory_status"].'"/>
													<button name="change_status" class="btn btn-info btn-xs" type="submit">'.$eachRow["subcategory_status"].'</button>
												</form>
											</td>
											<td class="center">
												<div class="row">
													<a data-id="'.$eachRow["id"].'" href="#deleteModal" class="btn btn-danger btn-xs float-right deleteButton" data-toggle="modal"><i class="fa fa-trash-o"></i> Delete</a>
													<form method="post" action="edit-subcategory.php" style="display: inline">
														<input type="hidden" name="edit_subcategory_id" value="'.$eachRow["id"].'"/>
														<button name="edit_subcategory" class="btn btn-warning btn-xs" type="submit"><i class="fa fa-pencil-square"></i> Edit</button>
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
									<th>ID</th>
									<th>Category Name</th>
									<th>Sub Category Name</th>
									<th>Sub Category Status</th>
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
                <h4 class="modal-title">Delete Sub Category?</h4>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this SubCategory?</h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <a href="list-category.php" class="btn btn-danger" id="modalDelete">Delete</a>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal End -->

<!-- jQuery Library -->
<script src="public/js/jquery-1.10.2.min.js"></script>

<!-- Script to Delete Start-->
<script>
$('.deleteButton').click(function() {
    var id = $(this).data('id');
	
    $('#modalDelete').attr('href', 'list-subcategory.php?did=' + id);
})
</script>
<!-- Script to Delete End-->
<?php
#### CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");

#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$eloquent = new Eloquent;

#### DELETE CATEGORY
if(isset($_POST['try_delete']))
{
	# DELETE DATA #
	$tableName = "categories";
	$whereValue["id"] = $_POST['id'];
	$deleteResult = $eloquent->deleteData($tableName, $whereValue);
}

#### CHANGE STATUS
if(isset($_POST['change_status']))
{
	$tableName = "categories";
	$whereValue["id"] = $_POST['category_status_id'];
	
	if($_POST['current_status'] == "Active")
	{
		$columnValue["category_status"] = "Inactive";
	}
	else if($_POST['current_status'] == "Inactive")
	{
		$columnValue["category_status"] = "Active";
	}
	$updateStatus = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}

#### GET CATEGORY LIST
$columnName = "*";
$tableName = "categories";
$queryResult = $eloquent->selectData($columnName, $tableName);

$tableName = $columnName = $whereValue = null;

?>

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
        <div class="col-sm-12">
			
			<!--breadcrumbs start -->
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">List Category</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					CATEGORY LIST
				</header>
				<div class="panel-body">
				
					<?php 
						# DELETE MESSAGE
						if(isset($_POST['try_delete']))
						{
							if($deleteResult > 0)
								echo '<div class="alert alert-success">The Category is deleted successfully</div>';
							else
								echo '<div class="alert alert-danger">Something went wrong! Unable to delete. Please recheck.</div>';
						}
						
						# STATUS CHANGE MESSAGE
						if(isset($_POST['change_status']))
						{
							if($updateStatus > 0)
								echo '<div class="alert alert-success">The Slider is updated successfully</div>';
							else
								echo '<div class="alert alert-danger">Something went wrong! Unable to change status. Please recheck.</div>';
						}
					?>
				
					<div class="adv-table">
						<table  class="display table table-bordered table-striped" id="dynamic-table">
							<thead>
								<tr>
									<th>Category ID</th>
									<th>Category Name</th>
									<th>Category Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							
							<?php 
								$n=1;
								foreach($queryResult AS $eachRow)
								{
									echo '
									<tr class="gradeA">
										<td>'.$n.'</td>
										<td>'.$eachRow['category_name'].'</td>
										<td class="center">
											<form method="post" action="">
												<input type="hidden" name="category_status_id" value="'.$eachRow['id'].'" />
												<input type="hidden" name="current_status" value="'.$eachRow['category_status'].'" />
												<button name="change_status" class="btn btn-info btn-xs" type="submit">'.$eachRow['category_status'].'</button>
											</form>
										</td>
										<td class="center">
											<div class="row">
												<form method="post" action="" style="display: inline;">
													<input type="hidden" name="id" value="'.$eachRow['id'].'"/>
													<button name="try_delete" class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash-o"></i> Delete</button>
												</form>
												<form method="post" action="edit-category.php" style="display: inline;">
													<input type="hidden" name="category_id" value="'.$eachRow['id'].'"/>
													<button name="try_edit" class="btn btn-warning btn-xs" type="submit"><i class="fa fa-pencil-square"></i> Edit</button>
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
									<th>Category ID</th>
									<th>Category Name</th>
									<th>Category Status</th>
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
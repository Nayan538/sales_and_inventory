<?php
#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$eloquent = new Eloquent;

#### UPDATE CATEGORY DATA
if(isset($_POST['try_update']))
{
	$tableName = "customers";
	$columnValue["customer_name"] = $_POST['customer_name'];
	$columnValue["customer_mobile"] = $_POST['customer_mobile'];
	$columnValue["customer_address"] = $_POST['customer_address'];
	$columnValue["customer_email"] = $_POST['customer_email'];
	$whereValue["id"] = $_SESSION['SMC_edit_customer_id'];
	
	$updateResult = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}
#### GET EXISTING CATEGORY DATA
if( isset($_POST['try_edit']) )
{
	$_SESSION['SMC_edit_customer_id'] = $_POST['customer_id'];
	
	$columnName = "*";
	$tableName = "customers";
	$whereValue["id"] = $_SESSION['SMC_edit_customer_id'];
	$queryResult = $eloquent->selectData($columnName, $tableName, @$whereValue);
}
else
{
	$columnName = "*";
	$tableName = "customers";
	$whereValue["id"] = $_SESSION['SMC_edit_customer_id'];
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
				<li class="active">Edit Customer</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					EDIT CUSTOMER
				</header>
				<div class="panel-body">
				
					<?php 
					# UPDATE MESSAGE
					if(isset($_POST['try_update']))
					{
						if($updateResult > 0)
							echo '<div class="alert alert-success">The Customer record is updated successfully!</div>';
						else
							echo '<div class="alert alert-danger">Something went wrong! Unable to update. Please recheck.</div>';
					}
					?>
					
					<form action="" method="post">
                        <div class="form-group required-field">
                            <label for="acc-name">First Name</label>
                            <input name="customer_name" type="text" class="form-control" id="acc-name" value="<?php echo $queryResult[0]['customer_name']?>">
                        </div>
						<div class="form-group required-field">
                            <label for="acc-email">Contact No</label>
                            <input name="customer_mobile" type="number" class="form-control" id="acc-email"  value="<?php echo $queryResult[0]['customer_mobile']?>">
                        </div>
						
						<div class="form-group required-field">
                            <label for="acc-email">Full Address</label>
                            <input name="customer_address" type="text" class="form-control" id="acc-email" value="<?php echo $queryResult[0]['customer_address']?>">
                        </div>
                        <div class="form-group required-field">
                            <label for="acc-email">Email Address</label>
                            <input name="customer_email" type="email" class="form-control" id="acc-email" value="<?php echo $queryResult[0]['customer_email']?>">
                        </div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button name="try_update" class="btn btn-primary" type="submit">Update</button>
								<a href="list-customer.php" class="btn btn-default" style="text-decoration: none;">Customer List</a>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->
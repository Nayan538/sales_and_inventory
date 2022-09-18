 <?php
# CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/HomeController.php");

#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");
# CALLING MODEL / QUERY BUILDER
$eloquent = new Eloquent;

# SAVE CUSTOMER #
if(isset($_POST['try_registration']))
{
	$tableName = "customers";
	$columnValue["customer_name"] = $_POST['customer_name'];
	$columnValue["customer_mobile"] = $_POST['contact_no'];
	$columnValue["customer_address"] = $_POST['customer_addr'];
	$columnValue["customer_email"] = $_POST['email_address'];
	$columnValue["created_at"] = date("Y-m-d H:i:s");
	$saveCustomer = $eloquent->insertData($tableName, $columnValue);
}

?>

<div class="wrapper">
    <div class="row">
		<div class="col-lg-12">
		
		<!--breadcrumbs start -->
        <ul class="breadcrumb panel">
            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li class="active">Create Customer</li>
        </ul>
        <!--breadcrumbs end -->
		
            <section class="panel">
                <header class="panel-heading">
                    New Customer Registration Form
                </header>
                <div class="panel-body">
						<?php 
						if(isset($_POST['try_registration']))
						{
							if($saveCustomer['NO_OF_ROW_INSERTED'])
							{
								echo '
									<div class="alert alert-success">
										 Successfully registered on Customer. 
									</div>
								';
							}
						}
						?>
                        
                        <form class="cmxform form-horizontal" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="acc-name" class="control-label col-lg-2">First Name</label>
                                <div class="col-lg-7">
                                    <input name="customer_name" type="text" class="form-control" id="acc-name" placeholder="Enter the Customer Name" required>
                                </div>
                            </div>
							<div class="form-group ">
                                <label for="acc-email" class="control-label col-lg-2">Contact No</label>
                                <div class="col-lg-7">
                                    <input name="contact_no" type="number" class="form-control" id="acc-email" placeholder="8801*********" required>
                                </div>
                            </div>
							
							<div class="form-group ">
                                <label for="acc-email" class="control-label col-lg-2">Full Address</label>
                                <div class="col-lg-7">
                                    <textarea name="customer_addr" type="text" class="form-control" id="acc-email" placeholder="Give your full address"></textarea>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="acc-email" class="control-label col-lg-2">Email Address</label>
                                <div class="col-lg-7">
                                    <input name="email_address" type="email" class="form-control" id="acc-email" required>
                                </div>
                            </div>

                            <!-- End .form-group -->

                            <div class="form-footer">
                                <a href="dashboard.php" class="control-label col-lg-2"><i class="icon-angle-double-left"></i>Back</a>

                                <div class="form-footer-right" class="control-label col-lg-2">
                                    <button name="try_registration" type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div><!-- End .form-footer -->
                        </form>
					</div>
			</section>
        </div>
	</div>
</div>

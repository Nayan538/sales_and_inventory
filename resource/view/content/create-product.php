<?php
#### CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");

#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$control = new Controller;
$eloquent = new Eloquent;

#### LOAD CATEGORY LIST
$columnName = "*";
$tableName = "categories";
$categoryList = $eloquent->selectData($columnName, $tableName);

#### INSERT PRODUCT DATA
if(isset($_POST['create_product']))
{
	$filename = "PRODUCT_" . date("YmdHis") . "_" . $_FILES['product_master_image']['name'];

	$imageResult = $control->checkImage(
		$_FILES['product_master_image']['type'], 
		$_FILES['product_master_image']['size'], 
		$_FILES['product_master_image']['error']
	);
	
	if($imageResult == 1)
	{
		$tableName = "products";
		$columnValue["category_id"] = $_POST['category_id'];
		$columnValue["subcategory_id"] = $_POST['subcategory_id'];
		$columnValue["product_name"] = $_POST['product_name'];
		$columnValue["product_summary"] = $_POST['product_summary'];
		$columnValue["product_details"] = $_POST['product_details'];
		$columnValue["product_quantity"] = $_POST['product_quantity'];
		$columnValue["product_price"] = $_POST['product_price'];
		$columnValue["product_status"] = $_POST['product_status'];
		$columnValue["product_master_image"] = $filename;
		$columnValue["created_at"] = date("Y-m-d H:i:s");
		
		$queryResult = $eloquent->insertData($tableName, $columnValue);
		
		if(@$queryResult > 0)
			move_uploaded_file($_FILES['product_master_image']['tmp_name'], $GLOBALS['PRODUCT_DIRECTORY'] . $filename);	
	}
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
				<li class="active">Create Product</li>
			</ul>
			<!--breadcrumbs end -->

			<section class="panel">
				<header class="panel-heading">
					CREATE PRODUCTS
				</header>
				<div class="panel-body">

					<?php 
						# INSERT MESSAGE
						if(isset($_POST['create_product'])) 
						{
							if(@$queryResult > 0)
								echo "<div class='alert alert-success'>New Product is created successfully!</div>";
							else
								echo "<div class='alert alert-danger'>Something went wrong while adding the Product! Please recheck.</div>";
						}
					?>

					<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2">Category</label>
							<div class="col-lg-7">

									<select name="category_id" id="category_id" class="form-control" required>
										<option value="">Select a Category</option> 
										<?php
										foreach($categoryList AS $eachRow)
										{
											echo '<option value="'.$eachRow['id'].'">' . $eachRow['category_name'] . '</option>';
										}
										?>
									</select>
							</div>
						</div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2">Subcategory</label>
							<div class="col-lg-7">
									<select name="subcategory_id" id="subcategory_id" class="form-control" required>
										<option value="">Select a Subcategory</option>
									</select>
							</div>
						</div>
						<div class="form-group">
							<label for="ProductName" class="col-lg-2 col-sm-2 control-label">Product Name</label>
							<div class="col-lg-7">
								<input type="text" name="product_name" class="form-control" id="product_name" required>
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductSummary" class="col-lg-2 col-sm-2 control-label">Product Summary</label>
							<div class="col-lg-10">
								<div class="form-group">
									<div class="col-md-10">
										<textarea name="product_summary" class="form-control" id="summerOne" rows="9" required></textarea>
									</div>
								</div>
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductDetails" class="col-lg-2 col-sm-2 control-label">Product Details</label>
							<div class="col-lg-10">
								<div class="form-group">
									<div class="col-md-10">
										<textarea name="product_details" class="form-control" id="summerTwo" rows="9" required></textarea>
									</div>
								</div>
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductQuantity" class="col-lg-2 col-sm-2 control-label">Product Quantity</label>
							<div class="col-lg-7">
								<input type="number" name="product_quantity" class="form-control" id="product_quantity" required>
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductPrice" class="col-lg-2 col-sm-2 control-label">Product Price</label>
							<div class="col-lg-7">
								<input type="number" step="any" name="product_price" class="form-control" id="product_price" required>
							</div>
						</div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2">Product Status</label>
							<div class="col-lg-7">
									<select name="product_status" class="form-control m-bot15" required>
										<option>In Stock</option>
										<option>Out of Stock</option>
									</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 ">Product Image</label>
							<div class="controls col-md-9">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<span class="btn btn-default btn-file">
										<input type="file" name="product_master_image" class="default" onchange="readURL(this);" required />
									</span>
									<span class="fileupload-preview" style="margin-left:5px;"></span>
									<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Product Preview</label>
							<div class="col-md-9">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail" style="width: 160px; height: 160px;">
										<img style="height: 100%; width: 100%;" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="blah"/>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-5">
								<button name="create_product" class="btn btn-success" type="submit">Save</button>
								<button class="btn btn-default" type="reset">Reset</button>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->

<!-- ---------- AJAX CODE TO LOAD SUBCATEGORY AGAINST CATEGORY ---------- -->
<script src="public/js/jquery-1.10.2.min.js"></script>
<script>
    $(document).ready(function(){
        $("#category_id").change(function() {
			
            var cat_id = $(this).val();
			
            if(cat_id != "")
			{
                $.ajax({
                    url:"ajax.php",
                    data:{
						ajax_create_product: "YES",
						category_id:cat_id
					},
                    type:'POST',
                    success:function(response) 
					{
                        var resp = $.trim(response);
                        $("#subcategory_id").html(resp);

                        if(resp == "")
                            $("#subcategory_id").html("<option value=''>No Subcategory Found</option>");
                    }
                });
            }
            else 
			{
                $("#subcategory_id").html("<option value=''>Select a Subcategory</option>");
            }
        })
    });
</script>
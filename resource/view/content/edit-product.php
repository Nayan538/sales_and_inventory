<?php
#### CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");
	
#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");
	
$eloquent = new Eloquent;
$control = new Controller;
	
#### UPDATE PRODUCT
if(isset($_POST['update_data']))
{
	if(empty($_FILES['product_master_image']['name']))
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
		$whereValue["id"] = $_SESSION['SMC_product_product_id'];
		$updateResult = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	}
	else
	{
		if($control->checkImage(@$_FILES['product_master_image']['type'], @$_FILES['product_master_image']['size'], @$_FILES['product_master_image']['error']) == 1)
		{
			$filename = "PRODUCT_" . date("YmdHis") . "_" . $_FILES['product_master_image']['name'];
			
			$tableName = "products";
			$columnValue["category_id"] = $_POST['category_id'];
			$columnValue["subcategory_id"] = $_POST['subcategory_id'];
			$columnValue["product_name"] = $_POST['product_name'];
			$columnValue["product_summary"] = $_POST['product_summary'];
			$columnValue["product_details"] = $_POST['product_details'];
			$columnValue["product_master_image"] = $filename;
			$columnValue["product_quantity"] = $_POST['product_quantity'];
			$columnValue["product_price"] = $_POST['product_price'];
			$columnValue["product_status"] = $_POST['product_status'];
			$whereValue["id"] = $_SESSION['SMC_product_product_id'];
			$updateResult = $eloquent->updateData($tableName, $columnValue, @$whereValue);
			
			if($updateResult > 0)
			{
				move_uploaded_file($_FILES['product_master_image']['tmp_name'], $GLOBALS['PRODUCT_DIRECTORY'] . $filename);
				
				unlink($_SESSION['SMC_edit_data_image_file_old']);
			}
		}
	}
}

##### GET PRODUCT ID FROM THE "EDIT" BUTTON OF PRODUCT LIST PAGE
if(isset($_POST['edit_data']))
{
	# HOLD PRODUCT ID IN A SESSION
	$_SESSION['SMC_product_product_id'] = $_POST['id'];
}

#### GET PRODUCT DETAILS 
$tableName = $columnValue = $whereValue = null;

$columnName["1"] = "products.product_name";
$columnName["2"] = "products.product_master_image";
$columnName["3"] = "products.product_quantity";
$columnName["4"] = "products.product_price";
$columnName["5"] = "products.product_status";
$columnName["6"] = "products.product_details";
$columnName["7"] = "products.product_summary";
$columnName["8"] = "products.category_id";
$columnName["9"] = "products.subcategory_id";
$columnName["10"] = "categories.id";
$columnName["11"] = "categories.category_name";
$columnName["12"] = "subcategories.id";
$columnName["13"] = "subcategories.subcategory_name";
$tableName["MAIN"] = "products";
$joinType = "INNER";
$tableName["1"] = "categories";
$tableName["2"] = "subcategories";
$onCondition["1"] = ["products.category_id", "categories.id"];
$onCondition["2"] = ["products.subcategory_id", "subcategories.id"];
$whereValue['products.id'] = $_SESSION['SMC_product_product_id'];
$productDetails = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue, @$formatBy, @$paginate);

#### GET CATEGORY DATA
$columnName = "*";
$tableName = "categories";
$categoryList = $eloquent->selectData($columnName, $tableName);

# STORING OLD PRODUCT IMAGE IN A SESSION VARIABLE
$_SESSION['SMC_edit_data_image_file_old'] = $GLOBALS['PRODUCT_DIRECTORY'] . $productDetails[0]['product_master_image']; 

?>

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			
			<!--breadcrumbs start -->
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">Edit Product</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					EDIT PRODUCTS
				</header>
				<div class="panel-body">
					
					<?php 
						# UPDATE MESSAGE
						if (isset($_POST['update_data'])) 
						{
							if (@$updateResult > 0) 
							echo "<div class='alert alert-success'>This Product is updated successfully</div>";
							else
							echo "<div class='alert alert-danger'>Something went wrong while update the Product! Please recheck.</div>";
						}
					?>
					
					<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
						
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2">Category</label>
							<div class="col-lg-7">
								<select name="category_id" id="category_id" class="form-control">
									<option value="">Select a Category</option>
									
									<?php 
									foreach($categoryList AS $eachRow)
									{
										echo '<option value="'.$eachRow['id'].'" ';
										
										if($eachRow['id'] == $productDetails[0]['category_id'])
											echo 'selected';
										
										echo ' >'.$eachRow['category_name'].'</option>';
									}
									?>
									
								</select>
							</div>
						</div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2">Subcategory</label>
							<div class="col-lg-7">
								<select id="subcategory_id" name="subcategory_id" class="form-control">
								<option> Select A Subcategory </option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="ProductName" class="col-lg-2 col-sm-2 control-label">Product Name</label>
							<div class="col-lg-7">
								<input type="text" name="product_name" class="form-control" value="<?php echo $productDetails[0]['product_name']?>">
							</div>
						</div>	
						<div class="form-group">
							<label for="ProductSummary" class="col-lg-2 col-sm-2 control-label">Product Summary</label>
							<div class="col-lg-8">
								<textarea name="product_summary" id="summerOne" >
									<?php echo $productDetails[0]['product_summary']?>
								</textarea>
							</div>
						</div>	
						<div class="form-group">
							<label for="ProductDetails" class="col-lg-2 col-sm-2 control-label">Product Details</label>
							<div class="col-lg-8">
								<textarea name="product_details" id="summerTwo">
									<?php echo $productDetails[0]['product_details']?>
								</textarea>
							</div>
						</div>	
						<div class="form-group">
							<label for="ProductQuantity" class="col-lg-2 col-sm-2 control-label">Product Quantity</label>
							<div class="col-lg-7">
								<input type="number" name="product_quantity" class="form-control" value="<?php echo $productDetails[0]['product_quantity']?>">
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductPrice" class="col-lg-2 col-sm-2 control-label">Product Price</label>
							<div class="col-lg-7">
								<input type="number" step="any" name="product_price" class="form-control" value="<?php echo $productDetails[0]['product_price']?>">
							</div>
						</div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2">Product Status</label>
							<div class="col-lg-7">
								<select name="product_status" class="form-control m-bot15">
									<option <?php if($productDetails[0]['product_status'] == "In Stock") echo "selected";?>>In Stock</option>
									<option <?php if($productDetails[0]['product_status'] == "Out of Stock") echo "selected";?>>Out of Stock</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 ">Product Image</label>
							<div class="controls col-md-9">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<span class="btn btn-default btn-file">
										<input type="file" name="product_master_image" class="default" onchange="readURL(this);" value="<?php echo $productDetails[0]['product_master_image'];?>"/>
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
										<img style="height: 100%; width: 100%;" src="<?php echo $GLOBALS['PRODUCT_DIRECTORY'] . $productDetails[0]['product_master_image'] ;?>" alt="" id="blah"/>
									</div>
								</div>
							</div>
						</div>
						
						<input type="hidden" name="product_id" value="<?php echo $productDetails[0]['id']?>"/>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button name="update_data" class="btn btn-primary" type="submit">Update</button>
								<a href="list-product.php" class="btn btn-default" style="text-decoration: none;">Product List</a>
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
$(document).ready(function() {
	
	// WHEN EDITED 
        var cat_id = <?php echo $productDetails[0]['category_id']; ?>;

        if (cat_id != "") {
            $.ajax({
                url: "ajax.php",
                data: {
					ajax_edit_product: "YES",
                    category_id: cat_id,
					subcategory_id: <?php echo $productDetails[0]['subcategory_id']; ?>
                },
                type: 'POST',
                success: function(response) {
                    var resp = $.trim(response);
                    $("#subcategory_id").html(resp);

                    if (resp == "")
                        $("#subcategory_id").html("<option value=''>No Subcategory Found</option>");
                }
            });
        } else {
            $("#subcategory_id").html("<option value=''>Select a Subcategory</option>");
        }
    
	// WHEN NEWLY ADDED
	
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
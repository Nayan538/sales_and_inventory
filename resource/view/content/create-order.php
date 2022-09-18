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
   
   #### LOAD CUSTOMER LIST
   $columnName = "*";
   $tableName = "customers";
   $customerList = $eloquent->selectData($columnName, $tableName);
   
   # SAVE ORDER #
   if(isset($_POST['create_order']))
   {
   	$columnName = "*";
   	$tableName = "products";
   	$whereValue["id"] = $_POST['product_id'];
   	$productPrice = $eloquent->selectData($columnName, $tableName,$whereValue);
   
   	$tableName = "orders";
   	$columnValue["order_date"] = $_POST['order_date'];
   	$columnValue["customer_id"] = $_POST['customer_name'];
   	$columnValue["category_id"] = $_POST['category_id'];
   	$columnValue["subcategory_id"] = $_POST['subcategory_id'];
   	$columnValue["product_id"] = $_POST['product_id'];
   	$columnValue["product_price"] = $productPrice[0]['product_price'];
   	$columnValue["order_quantity"] = $_POST['order_quantity'];
   	$columnValue["grand_total"] = $productPrice[0]['product_price'] * $_POST['order_quantity'];
   	$saveCustomer = $eloquent->insertData($tableName, $columnValue);
   }
   if(isset($_POST['create_order']))
   {
   	$tableName = "products";
   	$columnValue["product_quantity"] = $_GET["product_quantity"] - $_POST['order_quantity'];
   	$whereValue["id"] = $_POST['product_id'];
   	$updateResult = $eloquent->updateData($tableName, $columnValue,@$whereValue);
   
   	echo '<pre>';
   	print_r($updateResult);
   	echo '</pre>';
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
            <li class="active">Create Orders</li>
         </ul>
         <!--breadcrumbs end -->
         <section class="panel">
            <header class="panel-heading">
               CREATE Order
            </header>
            <div class="panel-body">
               <?php 
                  # INSERT MESSAGE
                  if(isset($_POST['create_order'])) 
                  {
                  	if($saveCustomer > 0)
                  		echo "<div class='alert alert-success'>New Order is created successfully!</div>";
                  	else
                  		echo "<div class='alert alert-danger'>Something went wrong while adding the Order! Please recheck.</div>";
                  }
                  ?>
               <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                  <div class="form-group">
                     <label for="CustomerName" class="col-lg-2 col-sm-2 control-label">Customer Name</label>
                     <div class="col-lg-4">
                        <select name="customer_name" id="customer_id" class="form-control" >
                           <option value="">Select a Customer</option>
                           <?php
                              foreach($customerList AS $eachRow)
                              {
                              	echo '<option value="'.$eachRow['id'].'">' . $eachRow['customer_name'] . '</option>';
                              }
                              ?>
                        </select>
                     </div>
                     <label for="CustomerNumber" class="col-lg-2 col-sm-2 control-label">Customer Number</label>
                     <div class="col-lg-4">
                        <select name="customer_mobile" id="customer_mobile" class="form-control">
                           <option value=""></option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group ">
                     <label for="CustomerAddress" class="col-lg-2 col-sm-2 control-label">Customer Address</label>
                     <div class="col-lg-4">
                        <select name="customer_address" id="customer_address" class="form-control" >
                           <option value=""></option>
                        </select>
                     </div>
                     <label for="OrdersDate" class="control-label col-lg-2">Orders Date</label>
                     <div class="col-lg-4">
                        <input type="date" step="any" name="order_date" class="form-control" id="order_date" >
                     </div>
                  </div>
                  <div class="form-group ">
                     <label for="ProductStatus" class="control-label col-lg-2">Category</label>
                     <div class="col-lg-4">
                        <select name="category_id" id="category_id" class="form-control" >
                           <option value="">Select a Category</option>
                           <?php
                              foreach($categoryList AS $eachRow)
                              {
                              	echo '<option value="'.$eachRow['id'].'">' . $eachRow['category_name'] . '</option>';
                              }
                              ?>
                        </select>
                     </div>
                     <label for="ProductStatus" class="control-label col-lg-2">Subcategory</label>
                     <div class="col-lg-4">
                        <select name="subcategory_id" id="subcategory_id" class="form-control" >
                           <option value="">Select a Subcategory</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="ProductName" class="col-lg-2 col-sm-2 control-label">Product Name</label>
                     <div class="col-lg-4">
                        <select name="product_id" id="product_id" class="form-control" >
                           <option value="">Select a Product</option>
                        </select>
                     </div>
                     <label for="ProductPrice" class="col-lg-2 col-sm-2 control-label">Product Price</label>
                     <div class="col-lg-4">
                        <select name="product_price" id="product_price" class="form-control" >
                           <option value=""></option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="OrdersQuantity" class="col-lg-2 col-sm-2 control-label">Orders Quantity</label>
                     <div class="col-lg-4">
                        <input type="number" name="order_quantity" class="form-control" id="order_quantity" >
                     </div>
                     <label for="grand_total" class="col-lg-2 col-sm-2 control-label">Orders Price</label>
                     <div class="col-lg-4">
                        <input type="number" step="any" name="grand_total" class="form-control" id="grand_total">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="OrdersQuantity" class="col-lg-2 col-sm-2 control-label">Payment Method</label>
                     <div class="col-lg-4">
                        <select name="payment_method" id="payment_method" class="form-control" >
                           <option value="">Select Payment Method</option>
                           <option value="Cash">Cash</option>
                           <option value="bKash">bKash</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-lg-offset-2 col-lg-10">
                        <button name="create_order" class="btn btn-success" type="submit">Save</button>
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
<script src="public/js/jquery-1.10.2.min.js"></script>
<script>
   $(document).ready(function(){
   
   var product_price = <?php echo $productPrice[0]['product_price']; ?>;
   
     	$("product_price, #order_quantity").keyup(function(){
   
     	var grand_total=0;    	
     	var x = Number($("#product_price").val(product_price));
     	var y = Number($("#order_quantity").val());
     	var grand_total=x * y;  
   
     	$('#grand_total').val(grand_total);
   
     });
   });
</script>
<!-- ---------- AJAX CODE TO LOAD SUBCATEGORY AGAINST CATEGORY ---------- -->
<script src="public/js/jquery-1.10.2.min.js"></script>
<script>
   $(document).ready(function(){
       $("#customer_id").change(function() {
   
           var cn_id = $(this).val();
   
           if(cn_id != "")
   {
               $.ajax({
                   url:"ajax.php",
                   data:{
   		ajax_customer_number: "YES",
   		customer_id:cn_id
   	},
                   type:'POST',
                   success:function(response) 
   	{
                       var resp = $.trim(response);
                       $("#customer_mobile").html(resp);
   
                       if(resp == "")
                           $("#customer_mobile").html("<option value=''>No Number Found</option>");
                   }
               });
           }
           else 
   {
               $("#customer_mobile").html("<option value=''></option>");
           }
       })
   });
</script>
<!-- ---------- AJAX CODE TO LOAD SUBCATEGORY AGAINST CATEGORY ---------- -->
<script src="public/js/jquery-1.10.2.min.js"></script>
<script>
   $(document).ready(function(){
       $("#customer_id").change(function() {
   
           var ca_id = $(this).val();
   
           if(ca_id != "")
   {
               $.ajax({
                   url:"ajax.php",
                   data:{
   		ajax_customer_address: "YES",
   		customer_id:ca_id
   	},
                   type:'POST',
                   success:function(response) 
   	{
                       var resp = $.trim(response);
                       $("#customer_address").html(resp);
   
                       if(resp == "")
                           $("#customer_address").html("<option value=''>No Address Found</option>");
                   }
               });
           }
           else 
   {
               $("#customer_address").html("<option value=''></option>");
           }
       })
   });
</script>
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
<!-- ---------- AJAX CODE TO LOAD Product AGAINST SUBCATEGORY ---------- -->
<script src="public/js/jquery-1.10.2.min.js"></script>
<script>
   $(document).ready(function(){
          $("#subcategory_id").change(function() {
   		
              var subcat_id = $(this).val();
   		
              if(subcat_id != "")
   		{
                  $.ajax({
                      url:"ajax.php",
                      data:{
   					ajax_create_order: "YES",
   					subcategory_id:subcat_id
   				},
                      type:'POST',
                      success:function(response) 
   				{
                          var resp = $.trim(response);
                          $("#product_id").html(resp);
   
                          if(resp == "")
                              $("#product_id").html("<option value=''>No Product Found</option>");
                      }
                  });
              }
              else 
   		{
                  $("#product_id").html("<option value=''>Select a Product</option>");
              }
          })
      });
</script>
<script src="public/js/jquery-1.10.2.min.js"></script>
<script>
   $(document).ready(function(){
          $("#product_id").change(function() {
   		
              var pro_id = $(this).val();
   		
              if(pro_id != "")
   		{
                  $.ajax({
                      url:"ajax.php",
                      data:{
   					ajax_create_order_price: "YES",
   					product_id:pro_id
   				},
                      type:'POST',
                      success:function(response) 
   				{
                          var resp = $.trim(response);
                          $("#product_price").html(resp);
   
                          if(resp == "")
                              $("#product_price").html("<option value=''>Product Price Not Abailable </option>");
                      }
                  });
              }
              else 
   		{
                  $("#product_price").html("<option value=''></option>");
              }
          })
      });
</script>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Product</title>

	<link rel="stylesheet" href="./public/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<style>
		*{
			padding: 0;
			margin: 0;
			box-sizing: border-box;
			outline: none;
		}
		body{
			font-family: 'Poppins', sans-serif;
		}
		.menu,
		.content{
			width: 100%;
			
		}
		.data{
			display: none;
		}
	</style>
</head>
<body>
<form id="product_form" name="#product_form" method="post" action="/add-product" >
<!-- HEADER -->
<div class="container" style="padding:20px">
  <div class="row">
    <div class="col-md-8">
		<h2>Product Add</h2>
    </div>
    <div class="col-md-4">
		<div class="button-box">
			<button type="submit" class="btn btn-success" style="margin-right: 20px;" id="save-btn"> Save </button>
			<button type="button" class="btn btn-danger" id="cancel-btn"> Cancel </button>
			
		</div>
    </div>
	<hr>
</div>
	
	<div class="form-group">
		<label for="sku" class="form-label">SKU :</label>
		<input type="text" name="sku" id="sku" class="form-control" required>
	</div>
	
	<div class="form-group">
		<label for="name">Name :</label>
		<input type="text" name="name" id="name" class="form-control" required>
	</div>
	
	<div class="form-group">
		<label for="price">Price :</label>
		<input type="number" name="price" id="price" class="form-control" required>
	</div>

	<div class="wrapper">
		<div class="menu">
			<label for = "productType">Type Switcher</label>
			<select id="productType" name="productType">
				<option value="dvd">DVD</option>
				<option value="furniture">Furniture</option>
				<option value="book">Book</option>
			</select>
		</div>


		<div class="content">
			<div id="dvd" class="data form-group">
				<label for = "size">Size(MB)</label>
				<input type="number" name="size" id="size" class="form-control">
				<p>* Please provide Size in MB</p>
			</div>
			<div id="furniture" class="data form-group">
				<div>
					<label for = "height">Height(CM)</label>
					<input type="number" name="height" id="height" class="form-control">
				</div>
				<div>
					<label for = "width">Width(CM)</label>
					<input type="number" name="width" id="width" class="form-control">
				</div>
				<div>
					<label for = "length">Length(CM)</label>
					<input type="number" name="length" id="length" class="form-control">
				</div>
				<p>* Please provide dimensions in HxWxL format</p>
			</div>
			<div id="book" class="data form-group">
				<label for = "weight">Weight(KG)</label>
				<input type="number" name="weight" id="weight" class="form-control">
				<p>* Please provide Weight in KG</p>
			</div>
		</div>
	</div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$("#productType").on('change', function(){
			$(".data").hide();
			$("#" + $(this).val()).fadeIn(300);
		}).change();
	});
</script>

<?php

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				
			$sku =  $_REQUEST['sku'];
			$name = $_REQUEST['name'];
			$price =  $_REQUEST['price'];
			$productType = $_REQUEST['productType'];
			$size = empty($_REQUEST['size']) ? 0 : $_REQUEST['size'] ;
			$weight = empty($_REQUEST['weight']) ? 0 : $_REQUEST['weight'] ;
			$height = empty($_REQUEST['height']) ? 0 : $_REQUEST['height'] ;
			$width = empty($_REQUEST['width']) ? 0 : $_REQUEST['width'] ;
			$length = empty($_REQUEST['length']) ? 0 : $_REQUEST['length'] ;
			
			$missingData = true;
			if($productType === 'book'){
				if(empty($weight)){
					$missingData = false; 
					echo "<div style='color:red;'>Missing required data</div>";
				}
			}elseif($productType === 'dvd'){
				if(empty($size)){
					$missingData = false; 
					echo "<div style='color:red;'>Missing required data</div>";
				}
			}if($productType === 'furniture'){
				if(empty($height) || empty($width) || empty($length)){
					$missingData = false; 
					echo "<div style='color:red;'>Missing required data</div>";
				}
			}

			if($missingData){
				include './modules/Database.php';
				$db = new Database();			
				$query = "INSERT INTO `products` (`sku`, `name`, `price`, `weight`, `size`, `height`, `width`, `length`, `product_type`) VALUES ('$sku', '$name', '$price', '$weight', '$size', '$height', '$width', '$length', '$productType')";
				
				$db->add_product($query);
			?>
			<script type="text/javascript"> location.href = "/"; </script>
			<?php
			}
			
	}

?>

<script type="text/javascript">
    document.getElementById("cancel-btn").onclick = function () {
        location.href = "/";
    };
</script>

<!-- FOOTER -->
<?php include './public/footer.html';?>

</body>
</html>
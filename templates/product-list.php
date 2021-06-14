<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Product List</title>

	<link rel="stylesheet" href="./public/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<!-- HEADER -->
<div class="container" style="padding:20px">
  <div class="row">
    <div class="col-md-8">
		<h2>Product List</h2>
    </div>
    <div class="col-md-4">
		<div class="button-box">
			<button type="button" class="btn btn-success" style="margin-right: 20px;" id="add-product-btn"> ADD </button>
			<button type="submit" class="btn btn-danger" id="delete-product-btn" form="delete-form"> MASS DELETE </button>
		</div>
    </div>
	<hr>
  </div>
  <?php 
		include './modules/Database.php';
        $db = new Database();
        $db->list_products();
  ?>
<!-- PRODUCT LIST -->
<form id="delete-form" action="#" method="post">
<div class="container" >
	<div class="row">
	<?php foreach($db->getProducts() as $product){ ?>
		<div class="col-md-2 product-grid border">
			<input type="checkbox" name="delete-checkbox[]" class="delete-checkbox" value=<?php echo $product->getSKU()?> />
			<div class="product-box">
			<?php
				echo "<div> {$product->getSKU()} </div>";
				echo "<div> {$product->getName()} </div>";
				echo "<div> {$product->getPrice()} $ </div>";
				echo "<div> {$product->getSizeWeightDimension()} </div>";
			?>
			</div>
		</div>
	<?php }; ?>
	</div>
</form>
</div>
<?php
if (isset($_POST['delete-checkbox'])){
	$skuForDeleteList = '';
	foreach ($_POST['delete-checkbox'] as $sku) {
		$skuForDeleteList .= "'$sku',";
	}
	$skuForDeleteList = substr($skuForDeleteList, 0, -1);
	$db->delete_products($skuForDeleteList);
	$_POST = array();
	$_POST['delete-checkbox'] = NULL;
	?>
	
	<script type="text/javascript"> location.href = "/"; </script>
	<?php
	}
?>

<!-- FOOTER -->
<?php include './public/footer.html';?>
</div>

<script type="text/javascript">
    document.getElementById("add-product-btn").onclick = function () {
        location.href = "/add-product";
    };
</script>
</body>
</html>
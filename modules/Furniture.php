<?php

include_once "Product.php";

    class Furniture extends Products{
	
		private $height;
		private $width;
		private $length;
	
		public function __construct($sku, $name, $price, $height, $width, $length, $productType){
			parent::__construct($sku, $name, $price, $productType);
			$this->height = $height;
			$this->width = $width;
			$this->length = $length;
		}
	
		public function getSizeWeightDimension(){
			return "Dimension : {$this->height}x{$this->width}x{$this->length}";
		}
	}
?>
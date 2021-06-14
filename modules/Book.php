<?php

    include_once "Product.php";

    class Book extends Products{
	
		private $weight;
	
		public function __construct($sku, $name, $price, $weight, $productType){
			parent::__construct($sku, $name, $price, $productType);
			$this->weight = $weight;
		}
	
		public function getSizeWeightDimension(){
			return "Weight : {$this->weight} KG";
		}
	}
?>
<?php

include_once "Product.php";

    class Dvd extends Products{
        
        private $size;

        public function __construct($sku, $name, $price, $size, $productType){
            parent::__construct($sku, $name, $price, $productType);
            $this->size = $size;
        }

        public function getSizeWeightDimension(){
            return "Size : {$this->size} MB";
        }
    }
?>
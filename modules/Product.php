<?php
    abstract class Products{
        
        private $sku;
        private $name;
        private $price;
        private $productType;    
        
        public function __construct($sku, $name, $price, $productType){
            $this->sku = $sku;
            $this->name = $name;
            $this->price = $price;
            $this->productType = $productType;
        }

        public function setSKU($sku){
            $this->sku = $sku;
        }

        public function getSKU(){
            return $this->sku;
        }

        public function getName(){
            return $this->name;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function setPrice($price){
            $this->price = $price;
        }

        public function getPrice(){
            return $this->price;
        }

        public function setProductType($productType){
            $this->productType = $productType;
        }

        public function getProductType(){
            return $this->productType;
        }

        abstract public function getSizeWeightDimension();

    }
?>
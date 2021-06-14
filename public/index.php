<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        require __DIR__ . './views/ProductList.php';
        break;
    case '' :
        require __DIR__ . '/views/ProductList.php';
        break;
    case '/add-product' :
        require __DIR__ . '/views/AddProduct.php';
        break;
    default:
        require __DIR__ . '/views/index.php';
        break;
}

?>
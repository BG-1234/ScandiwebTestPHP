<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        require __DIR__ . '/templates/product-list.php';
        break;
    case '' :
        require __DIR__ . '/templates/product-list.php';
        break;
    case '/add-product' :
        require __DIR__ . '/templates/add-product.php';
        break;
    default:
        require __DIR__ . '/index.php';
        break;
}

?>
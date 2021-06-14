<?php
    
    include_once "Product.php";
    include_once "Book.php";
    include_once "Dvd.php";
    include_once "Furniture.php";
	
	
	
class Database
{  
    private $url = 'mysql:host=localhost;dbname=id17022146_scandiweb_db';  
    private $username = 'id17022146_scandiweb';  
    private $password = 'i@[Rco@Z@5Fe$3iJ'; 
    private $pdo = NULL;
	private $products = array();
	
    public function __construct()  
    {  
        try {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $this->pdo = new PDO($this->url , $this->username, $this->password, $pdo_options);
        }
        catch (Exception $e)
        {
            die('Error : ' . $e->getMessage());
        }
    }  
	
	public function getProducts(){
		return $this->products;
	}

    public function list_products(){
        if($this->pdo){
            $data = $this->pdo->query("SELECT * FROM products")->fetchAll();
			foreach ($data as $row) {
                $productType = $row['product_type'];
                if($productType == 'book')
                    $this->products[] = new Book($row['sku'], $row['name'], $row['price'], $row['weight'], $productType);
                elseif ($productType == 'dvd')
                    $this->products[] = new Dvd($row['sku'], $row['name'], $row['price'], $row['size'], $productType);
                elseif ($productType == 'furniture')
                    $this->products[] = new Furniture($row['sku'], $row['name'], $row['price'], $row['height'], $row['width'], $row['length'], $productType);
            }
			
        }
    }

    public function delete_products($skuDeleteList)  
    {  
		$sql = "DELETE FROM `products` WHERE sku IN ({$skuDeleteList})";
		$stmt= $this->pdo->exec($sql);
        $this->list_products();  
    }  
	
	public function add_product($query)  
    {  
		$stmt= $this->pdo->exec($query);  
    }  
}  

?>
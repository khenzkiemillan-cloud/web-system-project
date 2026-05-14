<?php namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model {
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['category_id', 'name', 'description', 'cost_price', 'retail_price', 'stock', 'min_stock'];

    public function getProductsWithCategory() {
        return $this->select('products.id, products.name, products.category_id, products.cost_price, products.retail_price, products.stock, products.min_stock, products.description, categories.name as category_name')
                    ->join('categories', 'categories.id = products.category_id', 'left')
                    ->findAll();
    }
}
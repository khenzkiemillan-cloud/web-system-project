<?php namespace App\Models;
use CodeIgniter\Model;

class SaleItemModel extends Model {
    protected $table = 'sale_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sale_id', 'product_id', 'price', 'quantity', 'subtotal'];

    public function getItemsBySale($sale_id) {
        return $this->select('sale_items.*, products.name as product_name, products')
                    ->join('products', 'products.id = sale_items.product_id')
                    ->where('sale_id', $sale_id)
                    ->findAll();
    }
}
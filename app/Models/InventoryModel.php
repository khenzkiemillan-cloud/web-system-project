<?php namespace App\Models;
use CodeIgniter\Model;

class InventoryModel extends Model {
    protected $table = 'inventory_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'change_qty', 'type', 'remarks'];

    public function getLogs() {
        return $this->select('inventory_logs.*, products.name as product_name, products.sku')
                    ->join('products', 'products.id = inventory_logs.product_id')
                    ->orderBy('inventory_logs.created_at', 'DESC')
                    ->findAll();
    }
}
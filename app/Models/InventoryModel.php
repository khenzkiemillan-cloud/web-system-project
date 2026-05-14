<?php namespace App\Models;
use CodeIgniter\Model;

class InventoryModel extends Model {
    protected $table = 'inventory_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'change_qty', 'type', 'remarks'];

    public function getLogs() {
    // ✅ CORRECT
    return $this->select('inventory_logs.id, inventory_logs.created_at, inventory_logs.change_qty, inventory_logs.type, inventory_logs.remarks, products.name as product_name')
                ->join('products', 'products.id = inventory_logs.product_id', 'left')
                ->orderBy('inventory_logs.created_at', 'DESC')
                ->findAll();
}
}
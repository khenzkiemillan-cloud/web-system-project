<?php namespace App\Models;
use CodeIgniter\Model;

class SaleModel extends Model {
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $allowedFields = ['invoice_no', 'customer_id', 'total_amount', 'amount_paid', 'change_amount', 'payment_type'];

    public function getSalesHistory() {
        return $this->select('sales.*, customers.name as customer_name')
                    ->join('customers', 'customers.id = sales.customer_id', 'left')
                    ->orderBy('sales.created_at', 'DESC')
                    ->findAll();
    }
}
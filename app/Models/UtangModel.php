<?php namespace App\Models;
use CodeIgniter\Model;

class UtangModel extends Model {
    protected $table = 'utangs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sale_id', 'customer_id', 'total_debt', 'remaining_debt', 'status', 'due_date'];

    public function getUtangLedger() {
    // ✅ CORRECT
    return $this->select('utangs.id, utangs.total_debt, utangs.remaining_debt, utangs.status, utangs.due_date, customers.name as customer_name, sales.invoice_no')
                ->join('customers', 'customers.id = utangs.customer_id')
                ->join('sales', 'sales.id = utangs.sale_id')
                ->orderBy('utangs.status', 'ASC')
                ->findAll();
}
}
<?php namespace App\Models;
use CodeIgniter\Model;

class CustomerModel extends Model {
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'phone', 'email', 'address', 'credit_limit'];

    public function getCustomersWithDebt() {
        return $this->select('customers.*, COALESCE(SUM(utangs.remaining_debt), 0) as total_utang')
                    ->join('utangs', 'utangs.customer_id = customers.id AND utangs.status != "paid"', 'left')
                    ->groupBy('customers.id')
                    ->findAll();
    }
}
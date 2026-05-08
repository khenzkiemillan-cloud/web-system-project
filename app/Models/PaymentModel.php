<?php namespace App\Models;
use CodeIgniter\Model;

class PaymentModel extends Model {
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['utang_id', 'amount_paid', 'payment_date', 'payment_method'];

    public function getHistory() {
        return $this->select('payments.*, customers.name as customer_name, utangs.total_debt, sales.invoice_no')
                    ->join('utangs', 'utangs.id = payments.utang_id')
                    ->join('customers', 'customers.id = utangs.customer_id')
                    ->join('sales', 'sales.id = utangs.sale_id')
                    ->orderBy('payments.payment_date', 'DESC')
                    ->findAll();
    }
}
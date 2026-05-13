<?php namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\CustomerModel;
use App\Models\SaleModel;
use App\Models\SaleItemModel;
use App\Models\UtangModel;
use App\Models\InventoryModel;

class Sales extends BaseController {
    public function create() {
        $prodModel = new ProductModel();
        $custModel = new CustomerModel();

        $data['products']  = json_encode($prodModel->where('stock >', 0)->findAll());
        $data['customers'] = $custModel->getCustomersWithDebt();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('sales/create', $data);
        echo view('templates/footer');
    }

    public function store() {
        $db = \Config\Database::connect();
        $db->transStart();

        $saleModel = new SaleModel();
        $itemModel = new SaleItemModel();
        $utangModel = new UtangModel();
        $prodModel = new ProductModel();
        $invModel = new InventoryModel();

        $cart = json_decode($this->request->getPost('cart_data'), true);
        $customerId = $this->request->getPost('customer_id') ?: null;
        $paymentType = $this->request->getPost('payment_type');
        $totalAmount = floatval($this->request->getPost('total_amount'));
        $amountPaid = floatval($this->request->getPost('amount_paid'));

        $invoiceNo = 'INV-' . time();

        $saleData = [
            'invoice_no'   => $invoiceNo,
            'customer_id'  => $customerId,
            'total_amount' => $totalAmount,
            'amount_paid'  => $paymentType === 'utang' ? 0 : $amountPaid,
            'change_amount'=> $paymentType === 'utang' ? 0 : ($amountPaid - $totalAmount),
            'payment_type' => $paymentType
        ];
        
        $saleModel->save($saleData);
        $saleId = $saleModel->getInsertID();

        foreach($cart as $item) {
            $itemModel->save([
                'sale_id'    => $saleId,
                'product_id' => $item['id'],
                'price'      => $item['retail_price'],
                'quantity'   => $item['quantity'],
                'subtotal'   => $item['retail_price'] * $item['quantity']
            ]);

            $prod = $prodModel->find($item['id']);
            $prodModel->update($item['id'], ['stock' => $prod['stock'] - $item['quantity']]);
            $invModel->save([
                'product_id' => $item['id'],
                'change_qty' => -$item['quantity'],
                'type'       => 'sale',
                'remarks'    => "Sold via $invoiceNo"
            ]);
        }

        if ($paymentType === 'utang') {
            $utangModel->save([
                'sale_id'        => $saleId,
                'customer_id'    => $customerId,
                'total_debt'     => $totalAmount,
                'remaining_debt' => $totalAmount,
                'status'         => 'unpaid',
                'due_date'       => date('Y-m-d', strtotime('+30 days'))
            ]);
        }

        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            return redirect()->back()->with('error', 'Transaction Failed!');
        }

       return redirect()->to(base_url('sales/create'))->with('success', 'Sale completed successfully!');
    }

    public function receipt($id) {
        $saleModel = new SaleModel();
        $itemModel = new SaleItemModel();

        $data['sale'] = $saleModel->select('sales.*, customers.name as customer_name')
                                  ->join('customers', 'customers.id = sales.customer_id', 'left')
                                  ->where('sales.id', $id)
                                  ->first();
        $data['items'] = $itemModel->getItemsBySale($id);

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('sales/receipt', $data);
        echo view('templates/footer');
    }

    public function history() {
        $saleModel = new SaleModel();
        $data['sales'] = $saleModel->getSalesHistory();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('sales/history', $data);
        echo view('templates/footer');
    }
}
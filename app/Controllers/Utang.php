<?php namespace App\Controllers;
use App\Models\UtangModel;
use App\Models\PaymentModel;

class Utang extends BaseController {
    public function index() {
        $model = new UtangModel();
        $data['ledgers'] = $model->getUtangLedger();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('utang/index', $data);
        echo view('templates/footer');
    }

    public function payment($id) {
        $model = new UtangModel();
        $data['ledger'] = $model->select('utangs.*, customers.name as customer_name, sales.invoice_no')
                                ->join('customers', 'customers.id = utangs.customer_id')
                                ->join('sales', 'sales.id = utangs.sale_id')
                                ->where('utangs.id', $id)
                                ->first();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('utang/payment', $data);
        echo view('templates/footer');
    }

    public function pay($id) {
        $utangModel = new UtangModel();
        $payModel = new PaymentModel();

        $paymentAmount = floatval($this->request->getPost('payment_amount'));
        $paymentMethod = $this->request->getPost('payment_method');

        $utang = $utangModel->find($id);
        $newRemaining = $utang['remaining_debt'] - $paymentAmount;

        $status = 'partially_paid';
        if ($newRemaining <= 0) {
            $status = 'paid';
            $newRemaining = 0;
        }

        $utangModel->update($id, [
            'remaining_debt' => $newRemaining,
            'status'         => $status
        ]);

        $payModel->save([
            'utang_id'       => $id,
            'amount_paid'    => $paymentAmount,
            'payment_method' => $paymentMethod
        ]);

        return redirect()->to(base_url('utang'))->with('success', 'Payment recorded successfully!');
    }

    public function history() {
        $payModel = new PaymentModel();
        $data['payments'] = $payModel->getHistory();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('utang/history', $data);
        echo view('templates/footer');
    }
}
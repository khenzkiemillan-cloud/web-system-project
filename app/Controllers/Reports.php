<?php namespace App\Controllers;
use App\Models\SaleModel;
use App\Models\InventoryModel;
use App\Models\UtangModel;

class Reports extends BaseController {
    public function sales_report() {
        $model = new SaleModel();
        $data['sales'] = $model->getSalesHistory();
        $data['total_sum'] = $model->selectSum('total_amount')->first()['total_amount'] ?? 0.00;

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('reports/sales_report', $data);
        echo view('templates/footer');
    }

    public function inventory_report() {
        $model = new InventoryModel();
        $data['logs'] = $model->getLogs();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('reports/inventory_report', $data);
        echo view('templates/footer');
    }

    public function utang_report() {
        $model = new UtangModel();
        $data['ledgers'] = $model->getUtangLedger();
        $data['outstanding_debt'] = $model->selectSum('remaining_debt')->where('status !=', 'paid')->first()['remaining_debt'] ?? 0.00;

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('reports/utang_report', $data);
        echo view('templates/footer');
    }
}
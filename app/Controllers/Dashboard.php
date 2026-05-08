<?php namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\SaleModel;
use App\Models\UtangModel;

class Dashboard extends BaseController {
    public function index() {
        $productModel = new ProductModel();
        $saleModel = new SaleModel();
        $utangModel = new UtangModel();

        $data['total_products'] = $productModel->countAll();
        $data['low_stock']      = $productModel->where('stock <= min_stock')->findAll();
        $data['today_sales']    = $saleModel->selectSum('total_amount')->where('DATE(created_at)', date('Y-m-d'))->first()['total_amount'] ?? 0.00;
        $data['total_utang']    = $utangModel->selectSum('remaining_debt')->where('status !=', 'paid')->first()['remaining_debt'] ?? 0.00;

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('dashboard/index', $data);
        echo view('templates/footer');
    }
}
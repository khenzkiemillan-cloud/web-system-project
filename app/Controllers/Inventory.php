<?php namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\InventoryModel;

class Inventory extends BaseController {
    public function index() {
        $prodModel = new ProductModel();
        $logModel = new InventoryModel();

        $data['products'] = $prodModel->findAll();
        $data['logs']     = $logModel->getLogs();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('inventory/index', $data);
        echo view('templates/footer');
    }

    public function addStock() {
        $prodModel = new ProductModel();
        $logModel = new InventoryModel();

        $prod_id = $this->request->getPost('product_id');
        $qty = $this->request->getPost('change_qty');
        $remarks = $this->request->getPost('remarks');

        $prod = $prodModel->find($prod_id);
        $new_stock = $prod['stock'] + $qty;

        $prodModel->update($prod_id, ['stock' => $new_stock]);
        $logModel->save([
            'product_id' => $prod_id,
            'change_qty' => $qty,
            'type'       => 'stock-in',
            'remarks'    => $remarks
        ]);

        return redirect()->to(base_url('inventory'))->with('success', 'Stocks added successfully!');
    }
}
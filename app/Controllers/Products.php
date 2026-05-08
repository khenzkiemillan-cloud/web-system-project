<?php namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Products extends BaseController {
    public function index() {
        $model = new ProductModel();
        $data['products'] = $model->getProductsWithCategory();
        
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('products/index', $data);
        echo view('templates/footer');
    }

    public function create() {
        $catModel = new CategoryModel();
        $data['categories'] = $catModel->findAll();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('products/create', $data);
        echo view('templates/footer');
    }

    public function store() {
        $model = new ProductModel();
        $model->save([
            'category_id'  => $this->request->getPost('category_id') ?: null,
            'sku'          => $this->request->getPost('sku'),
            'barcode'      => $this->request->getPost('barcode'),
            'name'         => $this->request->getPost('name'),
            'description'  => $this->request->getPost('description'),
            'cost_price'   => $this->request->getPost('cost_price'),
            'retail_price' => $this->request->getPost('retail_price'),
            'stock'        => $this->request->getPost('stock'),
            'min_stock'    => $this->request->getPost('min_stock'),
        ]);
        return redirect()->to(base_url('products'))->with('success', 'Product Created successfully!');
    }

    public function edit($id = null) {
        $model = new ProductModel();
        $catModel = new CategoryModel();
        $data['product'] = $model->find($id);
        $data['categories'] = $catModel->findAll();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('products/edit', $data);
        echo view('templates/footer');
    }

    public function update($id = null) {
        $model = new ProductModel();
        $model->update($id, [
            'category_id'  => $this->request->getPost('category_id'),
            'sku'          => $this->request->getPost('sku'),
            'barcode'      => $this->request->getPost('barcode'),
            'name'         => $this->request->getPost('name'),
            'description'  => $this->request->getPost('description'),
            'cost_price'   => $this->request->getPost('cost_price'),
            'retail_price' => $this->request->getPost('retail_price'),
            'stock'        => $this->request->getPost('stock'),
            'min_stock'    => $this->request->getPost('min_stock'),
        ]);
        return redirect()->to(base_url('products'))->with('success', 'Product updated successfully!');
    }

    public function delete($id = null) {
        $model = new ProductModel();
        $model->delete($id);
        return redirect()->to(base_url('products'))->with('success', 'Product deleted successfully!');
    }
}
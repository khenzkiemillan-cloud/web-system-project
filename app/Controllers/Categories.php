<?php namespace App\Controllers;
use App\Models\CategoryModel;

class Categories extends BaseController {
    public function index() {
        $model = new CategoryModel();
        $data['categories'] = $model->findAll();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('categories/index', $data);
        echo view('templates/footer');
    }

    public function create() {
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('categories/create');
        echo view('templates/footer');
    }

    public function store() {
        $model = new CategoryModel();
        $model->save([
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ]);
        return redirect()->to(base_url('categories'))->with('success', 'Category created successfully!');
    }

    public function edit($id = null) {
        $model = new CategoryModel();
        $data['category'] = $model->find($id);

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('categories/edit', $data);
        echo view('templates/footer');
    }

    public function update($id = null) {
        $model = new CategoryModel();
        $model->update($id, [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ]);
        return redirect()->to(base_url('categories'))->with('success', 'Category updated successfully!');
    }

    public function delete($id = null) {
        $model = new CategoryModel();
        $model->delete($id);
        return redirect()->to(base_url('categories'))->with('success', 'Category deleted successfully!');
    }
}
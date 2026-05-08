<?php namespace App\Controllers;
use App\Models\CustomerModel;

class Customers extends BaseController {
    public function index() {
        $model = new CustomerModel();
        $data['customers'] = $model->getCustomersWithDebt();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('customers/index', $data);
        echo view('templates/footer');
    }

    public function create() {
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('customers/create');
        echo view('templates/footer');
    }

    public function store() {
        $model = new CustomerModel();
        $model->save([
            'name'         => $this->request->getPost('name'),
            'phone'        => $this->request->getPost('phone'),
            'email'        => $this->request->getPost('email'),
            'address'      => $this->request->getPost('address'),
            'credit_limit' => $this->request->getPost('credit_limit'),
        ]);
        return redirect()->to(base_url('customers'))->with('success', 'Customer profile created!');
    }

    public function edit($id = null) {
        $model = new CustomerModel();
        $data['customer'] = $model->find($id);

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('templates/navbar');
        echo view('customers/edit', $data);
        echo view('templates/footer');
    }

    public function update($id = null) {
        $model = new CustomerModel();
        $model->update($id, [
            'name'         => $this->request->getPost('name'),
            'phone'        => $this->request->getPost('phone'),
            'email'        => $this->request->getPost('email'),
            'address'      => $this->request->getPost('address'),
            'credit_limit' => $this->request->getPost('credit_limit'),
        ]);
        return redirect()->to(base_url('customers'))->with('success', 'Customer profile updated!');
    }

    public function delete($id = null) {
        $model = new CustomerModel();
        $model->delete($id);
        return redirect()->to(base_url('customers'))->with('success', 'Customer profile deleted!');
    }
}
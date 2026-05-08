<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Customer Accounts</h1>
    <a href="<?= base_url('customers/create') ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2 rounded-xl transition shadow-md"><i class="fa-solid fa-plus mr-2"></i>New Customer</a>
</div>

<div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead>
            <tr class="text-slate-400 border-b">
                <th class="py-3">Name</th>
                <th class="py-3">Phone</th>
                <th class="py-3">Address</th>
                <th class="py-3 text-right">Credit Limit</th>
                <th class="py-3 text-right">Active Debt (Utang)</th>
                <th class="py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($customers as $customer): ?>
                <tr class="border-b hover:bg-slate-50 transition">
                    <td class="py-3 font-bold text-slate-800"><?= $customer['name'] ?></td>
                    <td class="py-3 text-slate-500"><?= $customer['phone'] ?: 'N/A' ?></td>
                    <td class="py-3 text-slate-500"><?= $customer['address'] ?: 'N/A' ?></td>
                    <td class="py-3 text-right font-bold text-slate-700">₱<?= number_format($customer['credit_limit'], 2) ?></td>
                    <td class="py-3 text-right font-black text-rose-600">₱<?= number_format($customer['total_utang'], 2) ?></td>
                    <td class="py-3 text-center flex items-center justify-center space-x-2">
                        <a href="<?= base_url('customers/edit/'.$customer['id']) ?>" class="text-blue-500 hover:text-blue-700 bg-blue-50 p-2 rounded-lg transition"><i class="fa-solid fa-pen"></i></a>
                        <form action="<?= base_url('customers/'.$customer['id']) ?>" method="POST" onsubmit="return confirm('Are you sure?');">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="text-rose-500 hover:text-rose-700 bg-rose-50 p-2 rounded-lg transition"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
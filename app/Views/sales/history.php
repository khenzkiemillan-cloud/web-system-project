<h1 class="text-2xl font-bold text-slate-800 mb-6">Sales Transaction History</h1>

<div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead>
            <tr class="text-slate-400 border-b">
                <th class="py-3">Invoice Code</th>
                <th class="py-3">Timestamp</th>
                <th class="py-3">Customer</th>
                <th class="py-3 text-right">Total Amount</th>
                <th class="py-3 text-right">Amount Paid</th>
                <th class="py-3 text-center">Type</th>
                <th class="py-3 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($sales as $sale): ?>
                <tr class="border-b hover:bg-slate-50 transition">
                    <td class="py-3 font-semibold text-slate-800"><?= $sale['invoice_no'] ?></td>
                    <td class="py-3 text-slate-500"><?= date('Y-m-d H:i', strtotime($sale['created_at'])) ?></td>
                    <td class="py-3 font-bold"><?= $sale['customer_name'] ?: 'Guest Walk-in' ?></td>
                    <td class="py-3 text-right font-extrabold text-indigo-600">₱<?= number_format($sale['total_amount'], 2) ?></td>
                    <td class="py-3 text-right text-slate-500">₱<?= number_format($sale['amount_paid'], 2) ?></td>
                    <td class="py-3 text-center">
                        <span class="px-2 py-0.5 rounded-full font-bold text-xs uppercase <?= $sale['payment_type'] === 'cash' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' ?>">
                            <?= $sale['payment_type'] ?>
                        </span>
                    </td>
                    <td class="py-3 text-center">
                        <a href="<?= base_url('sales/receipt/'.$sale['id']) ?>" class="text-indigo-500 bg-indigo-50 px-3 py-1.5 rounded-lg hover:bg-indigo-100 text-xs font-bold transition">View Receipt</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
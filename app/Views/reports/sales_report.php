<div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-6 flex justify-between items-center" id="report-header">
    <div>
        <h1 class="text-2xl font-black text-slate-800">Master Sales Report</h1>
        <p class="text-sm text-slate-400">Total historical sales transactions logged inside the system</p>
    </div>
    <div class="text-right">
        <span class="block text-xs font-bold uppercase text-slate-400">Accumulated Total sales</span>
        <span class="text-3xl font-black text-indigo-600">₱<?= number_format($total_sum, 2) ?></span>
    </div>
</div>

<div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead>
            <tr class="text-slate-400 border-b">
                <th class="py-3">Invoice Ref</th>
                <th class="py-3">Date</th>
                <th class="py-3">Customer</th>
                <th class="py-3 text-center">Type</th>
                <th class="py-3 text-right">Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($sales as $sale): ?>
                <tr class="border-b">
                    <td class="py-3 font-semibold text-slate-800"><?= $sale['invoice_no'] ?></td>
                    <td class="py-3 text-slate-500"><?= date('Y-m-d H:i', strtotime($sale['created_at'])) ?></td>
                    <td class="py-3 font-bold"><?= $sale['customer_name'] ?: 'Guest Walk-in' ?></td>
                    <td class="py-3 text-center">
                        <span class="px-2 py-0.5 rounded-full font-bold text-xs uppercase bg-slate-100"><?= $sale['payment_type'] ?></span>
                    </td>
                    <td class="py-3 text-right font-extrabold text-indigo-600">₱<?= number_format($sale['total_amount'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
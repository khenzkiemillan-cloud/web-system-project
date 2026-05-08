<h1 class="text-2xl font-bold text-slate-800 mb-6">Credit Payment Ledger Logs</h1>

<div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead>
            <tr class="text-slate-400 border-b">
                <th class="py-3">Timestamp</th>
                <th class="py-3">Invoice Reference</th>
                <th class="py-3">Customer Name</th>
                <th class="py-3">Payment Method</th>
                <th class="py-3 text-right">Amount Paid</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($payments as $payment): ?>
                <tr class="border-b hover:bg-slate-50 transition">
                    <td class="py-3 text-slate-500 text-xs"><?= date('Y-m-d H:i', strtotime($payment['payment_date'])) ?></td>
                    <td class="py-3 font-semibold text-slate-800"><?= $payment['invoice_no'] ?></td>
                    <td class="py-3 font-bold"><?= $payment['customer_name'] ?></td>
                    <td class="py-3 text-slate-500 text-xs"><span class="bg-slate-100 border px-2 py-0.5 rounded font-bold uppercase"><?= $payment['payment_method'] ?></span></td>
                    <td class="py-3 text-right font-black text-emerald-600">₱<?= number_format($payment['amount_paid'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>  
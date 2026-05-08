<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Utang (Credit Ledger) Accounts</h1>
    <a href="<?= base_url('utang/history') ?>" class="bg-indigo-50 text-indigo-600 font-bold px-4 py-2 rounded-xl border border-indigo-100 hover:bg-indigo-100 transition"><i class="fa-solid fa-receipt mr-2"></i>Payment History</a>
</div>

<div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead>
            <tr class="text-slate-400 border-b">
                <th class="py-3">Invoice Code</th>
                <th class="py-3">Customer Name</th>
                <th class="py-3 text-right">Original Debt</th>
                <th class="py-3 text-right">Remaining Debt</th>
                <th class="py-3 text-center">Due Date</th>
                <th class="py-3 text-center">Account Status</th>
                <th class="py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($ledgers as $ledger): ?>
                <tr class="border-b hover:bg-slate-50 transition">
                    <td class="py-3 font-semibold text-slate-800"><?= $ledger['invoice_no'] ?></td>
                    <td class="py-3 font-bold"><?= $ledger['customer_name'] ?></td>
                    <td class="py-3 text-right text-slate-500">₱<?= number_format($ledger['total_debt'], 2) ?></td>
                    <td class="py-3 text-right font-black text-rose-600">₱<?= number_format($ledger['remaining_debt'], 2) ?></td>
                    <td class="py-3 text-center text-slate-500"><?= $ledger['due_date'] ? date('Y-m-d', strtotime($ledger['due_date'])) : 'No Limit' ?></td>
                    <td class="py-3 text-center">
                        <span class="px-2 py-0.5 rounded-full font-bold text-xs uppercase <?= $ledger['status'] === 'paid' ? 'bg-emerald-100 text-emerald-700' : ($ledger['status'] === 'partially_paid' ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700') ?>">
                            <?= $ledger['status'] ?>
                        </span>
                    </td>
                    <td class="py-3 text-center">
                        <?php if($ledger['status'] !== 'paid'): ?>
                            <a href="<?= base_url('utang/payment/'.$ledger['id']) ?>" class="bg-indigo-600 text-white font-bold px-3 py-1.5 rounded-lg text-xs hover:bg-indigo-700 transition"><i class="fa-solid fa-cash-register mr-1"></i>Pay</a>
                        <?php else: ?>
                            <span class="text-emerald-500 font-extrabold text-xs"><i class="fa-solid fa-circle-check"></i> Paid</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
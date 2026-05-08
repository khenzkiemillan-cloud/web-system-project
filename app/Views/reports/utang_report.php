<div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-black text-slate-800">Accounts Receivable (Utang Report)</h1>
        <p class="text-sm text-slate-400">Summary tracking of outstanding debts and line-of-credit status</p>
    </div>
    <div class="text-right">
        <span class="block text-xs font-bold uppercase text-slate-400">Total Outstanding Debt</span>
        <span class="text-3xl font-black text-rose-600">₱<?= number_format($outstanding_debt, 2) ?></span>
    </div>
</div>

<div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead>
            <tr class="text-slate-400 border-b">
                <th class="py-3">Invoice Ref</th>
                <th class="py-3">Customer Name</th>
                <th class="py-3 text-right">Orig. Debt Balance</th>
                <th class="py-3 text-right">Rem. Debt Balance</th>
                <th class="py-3 text-center">Due Date</th>
                <th class="py-3 text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($ledgers as $ledger): ?>
                <tr class="border-b">
                    <td class="py-3 font-semibold text-slate-800"><?= $ledger['invoice_no'] ?></td>
                    <td class="py-3 font-bold"><?= $ledger['customer_name'] ?></td>
                    <td class="py-3 text-right text-slate-500">₱<?= number_format($ledger['total_debt'], 2) ?></td>
                    <td class="py-3 text-right font-black text-rose-600">₱<?= number_format($ledger['remaining_debt'], 2) ?></td>
                    <td class="py-3 text-center text-slate-500"><?= $ledger['due_date'] ? date('Y-m-d', strtotime($ledger['due_date'])) : 'No Limit' ?></td>
                    <td class="py-3 text-center">
                        <span class="text-xs px-2 py-0.5 rounded-full font-bold uppercase bg-slate-100"><?= $ledger['status'] ?></span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
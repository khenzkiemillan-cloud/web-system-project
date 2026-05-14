<div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <h1 class="text-2xl font-black text-slate-800">
            <i class="fa-solid fa-file-contract mr-2 text-rose-600"></i>Accounts Receivable (Utang Report)
        </h1>
        <p class="text-sm text-slate-400 mt-1">Summary tracking of outstanding debts and line-of-credit status</p>
    </div>
    
    <div class="text-right bg-rose-50 px-6 py-4 rounded-2xl border border-rose-100">
        <span class="block text-xs font-bold uppercase text-rose-400 tracking-wider">Total Outstanding Debt</span>
        <span class="text-3xl font-black text-rose-600">₱<?= number_format($outstanding_debt, 2) ?></span>
    </div>
</div>

<div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead>
            <tr class="text-slate-400 border-b border-slate-200">
                <th class="py-3 px-4 font-bold uppercase tracking-wider text-xs">Invoice Ref</th>
                <th class="py-3 px-4 font-bold uppercase tracking-wider text-xs">Customer Name</th>
                <th class="py-3 px-4 text-right font-bold uppercase tracking-wider text-xs">Orig. Debt</th>
                <th class="py-3 px-4 text-right font-bold uppercase tracking-wider text-xs">Rem. Debt</th>
                <th class="py-3 px-4 text-center font-bold uppercase tracking-wider text-xs">Due Date</th>
                <th class="py-3 px-4 text-center font-bold uppercase tracking-wider text-xs">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($ledgers as $ledger): ?>
                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                    <td class="py-4 px-4">
                        <span class="font-mono font-semibold text-slate-700"><?= $ledger['invoice_no'] ?></span>
                    </td>
                    <td class="py-4 px-4">
                        <span class="font-bold text-slate-800"><?= $ledger['customer_name'] ?></span>
                    </td>
                    <td class="py-4 px-4 text-right">
                        <span class="text-slate-500">₱<?= number_format($ledger['total_debt'], 2) ?></span>
                    </td>
                    <td class="py-4 px-4 text-right">
                        <span class="font-black text-rose-600">₱<?= number_format($ledger['remaining_debt'], 2) ?></span>
                    </td>
                    <td class="py-4 px-4 text-center">
                        <span class="text-slate-500 font-medium">
                            <?= $ledger['due_date'] ? date('M d, Y', strtotime($ledger['due_date'])) : 'No Limit' ?>
                        </span>
                    </td>
                    <td class="py-4 px-4 text-center">
                        <?php if($ledger['status'] === 'paid'): ?>
                            <!-- ✅ PAID - Green -->
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                <i class="fa-solid fa-circle-check mr-1.5"></i> Paid
                            </span>
                        <?php elseif($ledger['status'] === 'partially_paid'): ?>
                            <!-- ⚠️ PARTIALLY PAID - Amber -->
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-200">
                                <i class="fa-solid fa-circle-half-stroke mr-1.5"></i> Partial
                            </span>
                        <?php else: ?>
                            <!-- ❌ UNPAID - Red -->
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-rose-100 text-rose-700 border border-rose-200">
                                <i class="fa-solid fa-circle-exclamation mr-1.5"></i> Unpaid
                            </span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
    <div class="bg-rose-50 border border-rose-100 rounded-2xl p-4">
        <div class="flex items-center justify-between">
            <div>
                <span class="block text-xs font-bold uppercase text-rose-400 tracking-wider">Unpaid Accounts</span>
                <span class="block text-2xl font-black text-rose-600 mt-1">
                    <?= count(array_filter($ledgers, fn($l) => $l['status'] === 'unpaid')) ?>
                </span>
            </div>
            <div class="w-12 h-12 bg-rose-100 rounded-2xl flex items-center justify-center">
                <i class="fa-solid fa-circle-exclamation text-rose-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4">
        <div class="flex items-center justify-between">
            <div>
                <span class="block text-xs font-bold uppercase text-amber-400 tracking-wider">Partially Paid</span>
                <span class="block text-2xl font-black text-amber-600 mt-1">
                    <?= count(array_filter($ledgers, fn($l) => $l['status'] === 'partially_paid')) ?>
                </span>
            </div>
            <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center">
                <i class="fa-solid fa-circle-half-stroke text-amber-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-4">
        <div class="flex items-center justify-between">
            <div>
                <span class="block text-xs font-bold uppercase text-emerald-400 tracking-wider">Fully Paid</span>
                <span class="block text-2xl font-black text-emerald-600 mt-1">
                    <?= count(array_filter($ledgers, fn($l) => $l['status'] === 'paid')) ?>
                </span>
            </div>
            <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center">
                <i class="fa-solid fa-circle-check text-emerald-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>
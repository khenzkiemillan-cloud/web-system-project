<div class="max-w-md mx-auto bg-white border border-gray-100 rounded-2xl p-8 shadow-md">
    <h2 class="text-xl font-bold mb-6 border-b pb-4 text-slate-800"><i class="fa-solid fa-wallet text-indigo-600 mr-2"></i>Record Credit Payment</h2>
    <div class="bg-slate-50 p-4 rounded-xl space-y-2 mb-6">
        <div class="flex justify-between text-sm"><span class="text-slate-400">Customer:</span><span class="font-bold"><?= $ledger['customer_name'] ?></span></div>
        <div class="flex justify-between text-sm"><span class="text-slate-400">Invoice Ref:</span><span class="font-mono"><?= $ledger['invoice_no'] ?></span></div>
        <div class="flex justify-between text-sm"><span class="text-slate-400">Original Balance:</span><span class="font-semibold">₱<?= number_format($ledger['total_debt'], 2) ?></span></div>
        <div class="flex justify-between text-sm"><span class="text-slate-400">Current Remaining Balance:</span><span class="font-extrabold text-rose-600">₱<?= number_format($ledger['remaining_debt'], 2) ?></span></div>
    </div>
    
    <form action="<?= base_url('utang/pay/'.$ledger['id']) ?>" method="POST" class="space-y-4">
        <div>
            <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Cash Payment Amount (₱)</label>
            <input type="number" step="0.01" name="payment_amount" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none font-bold" max="<?= $ledger['remaining_debt'] ?>" required>
        </div>
        <div>
            <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Payment Method</label>
            <select name="payment_method" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                <option value="Cash">Cash Handover</option>
                <option value="G-Cash">G-Cash (Electronic)</option>
                <option value="Bank Transfer">Bank Transfer</option>
            </select>
        </div>
        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl transition">Submit Payment</button>
    </form>
</div>
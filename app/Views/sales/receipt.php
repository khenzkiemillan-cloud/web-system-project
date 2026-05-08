<div class="max-w-md mx-auto bg-white p-8 rounded-2xl border border-gray-100 shadow-xl" id="receipt-print">
    <div class="text-center pb-6 border-b border-dashed">
        <h1 class="text-2xl font-black text-slate-800">MHAXX STORE</h1>
        <p class="text-xs text-slate-400 mt-1">123 Street Barangay Road, City</p>
        <p class="text-xs text-slate-400">Phone: +63 912 345 6789</p>
    </div>
    
    <div class="py-4 border-b border-dashed text-sm space-y-1">
        <div class="flex justify-between">
            <span class="text-slate-400">Invoice:</span>
            <span class="font-semibold text-slate-800"><?= $sale['invoice_no'] ?></span>
        </div>
        <div class="flex justify-between">
            <span class="text-slate-400">Date:</span>
            <span><?= date('Y-m-d H:i', strtotime($sale['created_at'])) ?></span>
        </div>
        <div class="flex justify-between">
            <span class="text-slate-400">Customer:</span>
            <span class="font-bold"><?= $sale['customer_name'] ?: 'Guest Walk-In' ?></span>
        </div>
    </div>

    <div class="py-4 border-b border-dashed space-y-3">
        <?php foreach($items as $item): ?>
            <div class="flex justify-between text-sm">
                <div>
                    <span class="font-semibold"><?= $item['product_name'] ?></span>
                    <span class="block text-xs text-slate-400"><?= $item['quantity'] ?> x ₱<?= number_format($item['price'], 2) ?></span>
                </div>
                <span class="font-bold">₱<?= number_format($item['subtotal'], 2) ?></span>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="py-4 space-y-2 text-sm border-b border-dashed">
        <div class="flex justify-between font-black text-base text-slate-800">
            <span>Total Payable:</span>
            <span>₱<?= number_format($sale['total_amount'], 2) ?></span>
        </div>
        <div class="flex justify-between text-slate-500">
            <span>Amount Paid:</span>
            <span>₱<?= number_format($sale['amount_paid'], 2) ?></span>
        </div>
        <div class="flex justify-between text-slate-500">
            <span>Change Amount:</span>
            <span>₱<?= number_format($sale['change_amount'], 2) ?></span>
        </div>
        <div class="flex justify-between text-slate-500">
            <span>Payment Method:</span>
            <span class="uppercase font-bold text-xs bg-slate-100 px-2 py-0.5 rounded"><?= $sale['payment_type'] ?></span>
        </div>
    </div>

    <div class="text-center pt-6 text-xs text-slate-400">
        <p>Thank you for purchasing with us!</p>
        <p class="mt-2">MHAXX Store System</p>
    </div>
</div>

<div class="flex justify-center space-x-4 mt-6">
    <button onclick="window.print()" class="bg-indigo-600 text-white font-bold px-6 py-2 rounded-lg hover:bg-indigo-700 transition"><i class="fa-solid fa-print mr-2"></i>Print Receipt</button>
    <a href="<?= base_url('sales/create') ?>" class="bg-slate-200 text-slate-700 font-bold px-6 py-2 rounded-lg hover:bg-slate-300 transition">Back to POS</a>
</div>
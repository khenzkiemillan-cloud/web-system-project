<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
        <h2 class="text-lg font-bold mb-4 border-b pb-4 text-slate-800">
            <i class="fa-solid fa-plus mr-2 text-indigo-600"></i>Stock-In / Adjust Stocks
        </h2>
        <form action="<?= base_url('inventory/addStock') ?>" method="POST" class="space-y-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Select Product</label>
                <select name="product_id" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-white" required>
                    <option value="">-- Choose Product --</option>
                    <?php foreach($products as $product): ?>
                        <!-- ✅ SKU REMOVED -->
                        <option value="<?= $product['id'] ?>">
                            <?= $product['name'] ?> (Stock: <?= $product['stock'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Stock Addition (Quantity)</label>
                <input type="number" name="change_qty" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" min="1" required>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Remarks</label>
                <textarea name="remarks" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" rows="3" placeholder="Supplier order, inventory adjustment, etc." required></textarea>
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl transition">Apply Adjustment</button>
        </form>
    </div>

    <div class="lg:col-span-2 bg-white border border-gray-100 rounded-2xl p-6 shadow-sm overflow-x-auto">
        <h2 class="text-lg font-bold mb-4 border-b pb-4 text-slate-800">
            <i class="fa-solid fa-history mr-2 text-emerald-600"></i>Recent Stock Logs
        </h2>
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="text-slate-400 border-b">
                    <th class="py-3">Timestamp</th>
                    <th class="py-3">Product Name</th>
                    <th class="py-3 text-center">Change Qty</th>
                    <th class="py-3 text-center">Type</th>
                    <th class="py-3">Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($logs as $log): ?>
                    <tr class="border-b">
                        <td class="py-3 text-slate-500 text-xs"><?= date('Y-m-d H:i', strtotime($log['created_at'])) ?></td>
                        <!-- ✅ SKU REMOVED -->
                        <td class="py-3 font-semibold"><?= $log['product_name'] ?></td>
                        <td class="py-3 text-center">
                            <span class="font-bold text-emerald-600">+<?= $log['change_qty'] ?></span>
                        </td>
                        <td class="py-3 text-center">
                            <span class="text-xs px-2 py-0.5 rounded-full font-bold bg-emerald-100 text-emerald-700 uppercase">
                                <?= $log['type'] ?>
                            </span>
                        </td>
                        <td class="py-3 text-slate-500 italic"><?= $log['remarks'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
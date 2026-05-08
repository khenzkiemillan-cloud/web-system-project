<div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-6">
    <h1 class="text-2xl font-black text-slate-800">Inventory Logs Audit</h1>
    <p class="text-sm text-slate-400">Full audit trail tracking stock arrivals, POS checkouts, and adjustments</p>
</div>

<div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead>
            <tr class="text-slate-400 border-b">
                <th class="py-3">Timestamp</th>
                <th class="py-3">Product Name</th>
                <th class="py-3 text-center">Quantity Adjustment</th>
                <th class="py-3 text-center">Log Type</th>
                <th class="py-3">Log Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($logs as $log): ?>
                <tr class="border-b">
                    <td class="py-3 text-slate-500 text-xs"><?= date('Y-m-d H:i', strtotime($log['created_at'])) ?></td>
                    <td class="py-3 font-semibold text-slate-800"><?= $log['product_name'] ?></td>
                    <td class="py-3 text-center font-bold <?= $log['change_qty'] < 0 ? 'text-rose-500' : 'text-emerald-500' ?>">
                        <?= $log['change_qty'] > 0 ? '+' . $log['change_qty'] : $log['change_qty'] ?>
                    </td>
                    <td class="py-3 text-center">
                        <span class="text-xs px-2 py-0.5 rounded-full font-bold uppercase bg-slate-100"><?= $log['type'] ?></span>
                    </td>
                    <td class="py-3 text-slate-500 italic"><?= $log['remarks'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
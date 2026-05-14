<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide">
                Today's Revenue
            </span>

            <span class="block text-2xl font-black text-slate-800 mt-1">
                ₱<?= number_format($today_sales, 2) ?>
            </span>
        </div>

        <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-xl">
            <i class="fa-solid fa-money-bill-trend-up"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide">
                Total Products
            </span>

            <span class="block text-2xl font-black text-slate-800 mt-1">
                <?= $total_products ?>
            </span>
        </div>

        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-xl">
            <i class="fa-solid fa-box"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide">
                Active Receivables (Utang)
            </span>

            <span class="block text-2xl font-black text-rose-600 mt-1">
                ₱<?= number_format($total_utang, 2) ?>
            </span>
        </div>

        <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-2xl flex items-center justify-center text-xl">
            <i class="fa-solid fa-file-invoice-dollar"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide">
                Low Stock Alert
            </span>

            <span class="block text-2xl font-black text-amber-500 mt-1">
                <?= count($low_stock) ?>
            </span>
        </div>

        <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center text-xl">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
    </div>

</div>

<div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">

    <div class="flex items-center justify-between mb-4 border-b pb-4">

        <h2 class="text-lg font-bold text-slate-800">
            <i class="fa-solid fa-triangle-exclamation text-amber-500 mr-2"></i>
            Critical Low Stocks
        </h2>

        <a href="<?= base_url('inventory') ?>"
           class="text-xs bg-indigo-50 text-indigo-600 hover:bg-indigo-100 font-bold px-3 py-1.5 rounded-lg transition">
            Manage Stocks
        </a>

    </div>

    <table class="w-full text-left text-sm">

        <thead>
            <tr class="text-slate-400 border-b">
                <th class="py-3">Product Name</th>
                <th class="py-3 text-center">In-Stock</th>
                <th class="py-3 text-center">Safety Level</th>
            </tr>
        </thead>

        <tbody>

            <?php if(empty($low_stock)): ?>

                <tr>
                    <td colspan="3" class="py-4 text-center text-slate-400">
                        All products have safe stock levels!
                    </td>
                </tr>

            <?php else: ?>

                <?php foreach($low_stock as $product): ?>

                    <tr class="border-b">

                        <td class="py-3 font-semibold text-slate-700">
                            <?= $product['name'] ?>
                        </td>

                        <td class="py-3 text-center">
                            <span class="bg-rose-100 text-rose-700 px-2 py-1 rounded-full font-bold">
                                <?= $product['stock'] ?>
                            </span>
                        </td>

                        <td class="py-3 text-center text-slate-400">
                            <?= $product['min_stock'] ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php endif; ?>

        </tbody>

    </table>

</div>
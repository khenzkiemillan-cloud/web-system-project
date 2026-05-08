<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Products Catalog</h1>
    <a href="<?= base_url('products/create') ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2 rounded-xl transition shadow-md"><i class="fa-solid fa-plus mr-2"></i>New Product</a>
</div>

<div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead>
            <tr class="text-slate-400 border-b">
                <th class="py-3">SKU</th>
                <th class="py-3">Barcode</th>
                <th class="py-3">Product Name</th>
                <th class="py-3">Category</th>
                <th class="py-3 text-right">Cost Price</th>
                <th class="py-3 text-right">Retail Price</th>
                <th class="py-3 text-center">In-Stock</th>
                <th class="py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product): ?>
                <tr class="border-b hover:bg-slate-50 transition">
                    <td class="py-3 font-semibold text-slate-800"><?= $product['sku'] ?></td>
                    <td class="py-3 text-slate-500"><?= $product['barcode'] ?: 'N/A' ?></td>
                    <td class="py-3 font-semibold"><?= $product['name'] ?></td>
                    <td class="py-3 text-slate-500"><?= $product['category_name'] ?: 'Uncategorized' ?></td>
                    <td class="py-3 text-right text-slate-500">₱<?= number_format($product['cost_price'], 2) ?></td>
                    <td class="py-3 text-right font-bold text-indigo-600">₱<?= number_format($product['retail_price'], 2) ?></td>
                    <td class="py-3 text-center">
                        <span class="px-2 py-1 rounded-full font-bold text-xs <?= $product['stock'] <= $product['min_stock'] ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700' ?>">
                            <?= $product['stock'] ?>
                        </span>
                    </td>
                    <td class="py-3 text-center flex items-center justify-center space-x-2">
                        <a href="<?= base_url('products/edit/'.$product['id']) ?>" class="text-blue-500 hover:text-blue-700 bg-blue-50 p-2 rounded-lg transition"><i class="fa-solid fa-pen"></i></a>
                        <form action="<?= base_url('products/'.$product['id']) ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="text-rose-500 hover:text-rose-700 bg-rose-50 p-2 rounded-lg transition"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
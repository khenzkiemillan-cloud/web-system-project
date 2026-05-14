<div class="max-w-2xl mx-auto bg-white border border-gray-100 rounded-2xl p-8 shadow-md">
    <h2 class="text-xl font-bold mb-6 border-b pb-4 text-slate-800">
        <i class="fa-solid fa-boxes-stacked mr-2 text-indigo-600"></i>Create New Product
    </h2>

    <form action="<?= base_url('products') ?>" method="POST" class="space-y-4">

        <div>
            <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Product Name</label>
            <input type="text" name="name"
                class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none"
                placeholder="Item descriptive name" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Category</label>
                <select name="category_id"
                    class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                    <option value="">Select Category</option>
                    <?php foreach($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Safety stock limit</label>
                <input type="number" name="min_stock"
                    class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none"
                    value="5" required>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Cost Price (₱)</label>
                <input type="number" step="0.01" name="cost_price"
                    class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Retail Price (₱)</label>
                <input type="number" step="0.01" name="retail_price"
                    class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Starting Stock</label>
                <input type="number" name="stock"
                    class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none"
                    value="0" required>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Description (Optional)</label>
            <textarea name="description"
                class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none"
                rows="3"></textarea>
        </div>

        <div class="flex justify-end space-x-4 pt-4 border-t">
            <a href="<?= base_url('products') ?>"
                class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-6 py-3 rounded-xl transition">
                Cancel
            </a>

            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-3 rounded-xl transition">
                Save Product
            </button>
        </div>

    </form>
</div>
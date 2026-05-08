<div class="max-w-xl mx-auto bg-white border border-gray-100 rounded-2xl p-8 shadow-md">
    <h2 class="text-xl font-bold mb-6 border-b pb-4 text-slate-800"><i class="fa-solid fa-pen mr-2 text-indigo-600"></i>Edit Category</h2>
    <form action="<?= base_url('categories/'.$category['id']) ?>" method="POST" class="space-y-4">
        <input type="hidden" name="_method" value="PUT">
        <div>
            <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Category Name</label>
            <input type="text" name="name" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" value="<?= $category['name'] ?>" required>
        </div>
        <div>
            <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Description</label>
            <textarea name="description" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" rows="4"><?= $category['description'] ?></textarea>
        </div>
        <div class="flex justify-end space-x-4 pt-4 border-t">
            <a href="<?= base_url('categories') ?>" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-6 py-3 rounded-xl transition">Cancel</a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-3 rounded-xl transition">Update Category</button>
        </div>
    </form>
</div>
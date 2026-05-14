<div class="max-w-xl mx-auto bg-white border border-gray-100 rounded-2xl p-8 shadow-md">
    <h2 class="text-xl font-bold mb-6 border-b pb-4 text-slate-800">
        <i class="fa-solid fa-pen mr-2 text-indigo-600"></i>Edit Customer Profile
    </h2>
    <form action="<?= base_url('customers/'.$customer['id']) ?>" method="POST" class="space-y-4">
        <input type="hidden" name="_method" value="PUT">
        
        <div>
            <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Full Name</label>
            <input type="text" name="name" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" value="<?= $customer['name'] ?>" required>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Phone Number</label>
                <input type="text" name="phone" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" value="<?= $customer['phone'] ?>">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Credit Limit (₱)</label>
                <input type="number" step="0.01" name="credit_limit" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" value="<?= $customer['credit_limit'] ?>" required>
            </div>
        </div>
        
        <div>
            <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Email Address</label>
            <input type="email" name="email" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" value="<?= $customer['email'] ?>">
        </div>
        
        <div>
            <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Address Details</label>
            <textarea name="address" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" rows="3"><?= $customer['address'] ?></textarea>
        </div>
        
        <div class="flex justify-end space-x-4 pt-4 border-t">
            <a href="<?= base_url('customers') ?>" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-6 py-3 rounded-xl transition">Cancel</a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-3 rounded-xl transition">Update Profile</button>
        </div>
    </form>
</div>
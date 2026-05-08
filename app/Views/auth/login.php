<!DOCTYPE html>
<html lang="en">
<head>
    <title>MHAXX Store - Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-black text-slate-800">MHAXX STORE</h1>
            <p class="text-sm text-slate-400 mt-2">Sign in to your administrative dashboard</p>
        </div>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="bg-rose-100 text-rose-700 p-3 mb-4 rounded text-sm text-center"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <form action="<?= base_url('login') ?>" method="POST" class="space-y-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Username</label>
                <input type="text" name="username" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Password</label>
                <input type="password" name="password" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white p-3 rounded-lg font-bold transition">Sign In</button>
        </form>
        <p class="text-center text-xs text-slate-400 mt-6">Don't have an account? <a href="<?= base_url('register') ?>" class="text-indigo-600 font-bold hover:underline">Register</a></p>
    </div>
</body>
</html>
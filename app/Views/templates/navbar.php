<div class="flex-1 flex flex-col min-w-0">
    <header class="bg-white border-b border-gray-200 flex items-center justify-between px-6 py-4">
        <div class="flex items-center space-x-4 md:hidden">
            <button class="text-slate-700 focus:outline-none">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <h1 class="text-lg font-bold">MHAXX</h1>
        </div>
        <div class="hidden md:flex items-center space-x-2 text-gray-500 text-sm">
            <i class="fa-regular fa-clock"></i>
            <span><?= date('l, d F Y') ?></span>
        </div>
        <div class="flex items-center space-x-4">
            <div class="text-right">
                <span class="block font-semibold text-slate-700"><?= session()->get('username') ?></span>
                <span class="block text-xs uppercase tracking-wide text-slate-400 font-bold"><?= session()->get('role') ?></span>
            </div>
            <div class="w-10 h-10 rounded-full bg-slate-800 text-white flex items-center justify-center font-bold">
                <?= strtoupper(substr(session()->get('username'), 0, 1)) ?>
            </div>
        </div>
    </header>
    <main class="flex-1 p-6 overflow-y-auto">
        <!-- Toast Alerts -->
        <?php if(session()->getFlashdata('success')): ?>
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded-r shadow-sm flex items-center justify-between">
                <div><?= session()->getFlashdata('success') ?></div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">&times;</button>
            </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="bg-rose-100 border-l-4 border-rose-500 text-rose-700 p-4 mb-6 rounded-r shadow-sm flex items-center justify-between">
                <div><?= session()->getFlashdata('error') ?></div>
                <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700">&times;</button>
            </div>
        <?php endif; ?>
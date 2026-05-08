<aside class="w-64 bg-slate-800 text-white flex-shrink-0 hidden md:flex flex-col">
    <div class="p-6 border-b border-slate-700">
        <h1 class="text-xl font-bold tracking-wider"><i class="fa-solid fa-store mr-2 text-indigo-400"></i>MHAXX STORE</h1>
        <p class="text-xs text-slate-400 mt-1">Cashier: <?= session()->get('username') ?></p>
    </div>
    <nav class="flex-1 p-4 space-y-2">
        <a href="<?= base_url('dashboard') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-700 transition">
            <i class="fa-solid fa-chart-line w-5 text-indigo-400"></i> <span>Dashboard</span>
        </a>
        <a href="<?= base_url('sales/create') ?>" class="flex items-center space-x-3 p-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition">
            <i class="fa-solid fa-cash-register w-5"></i> <span>POS Terminal</span>
        </a>
        <a href="<?= base_url('products') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-700 transition">
            <i class="fa-solid fa-boxes-stacked w-5 text-indigo-400"></i> <span>Products</span>
        </a>
        <a href="<?= base_url('categories') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-700 transition">
            <i class="fa-solid fa-tags w-5 text-indigo-400"></i> <span>Categories</span>
        </a>
        <a href="<?= base_url('inventory') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-700 transition">
            <i class="fa-solid fa-warehouse w-5 text-indigo-400"></i> <span>Stock Management</span>
        </a>
        <a href="<?= base_url('sales/history') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-700 transition">
            <i class="fa-solid fa-receipt w-5 text-indigo-400"></i> <span>Sales History</span>
        </a>
        <a href="<?= base_url('customers') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-700 transition">
            <i class="fa-solid fa-users w-5 text-indigo-400"></i> <span>Customers</span>
        </a>
        <a href="<?= base_url('utang') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-700 transition">
            <i class="fa-solid fa-hand-holding-dollar w-5 text-red-400"></i> <span>Utang Ledger</span>
        </a>
        <div class="pt-4 border-t border-slate-700">
            <p class="px-3 text-xs uppercase text-slate-500 font-bold tracking-wider">Reports</p>
            <a href="<?= base_url('reports/sales') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-700 transition">
                <i class="fa-solid fa-file-invoice-dollar w-5 text-emerald-400"></i> <span>Sales Report</span>
            </a>
            <a href="<?= base_url('reports/inventory') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-700 transition">
                <i class="fa-solid fa-file-waveform w-5 text-emerald-400"></i> <span>Inventory Logs</span>
            </a>
            <a href="<?= base_url('reports/utang') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-700 transition">
                <i class="fa-solid fa-file-contract w-5 text-emerald-400"></i> <span>Utang Report</span>
            </a>
        </div>
    </nav>
    <div class="p-4 border-t border-slate-700">
        <a href="<?= base_url('logout') ?>" class="flex items-center space-x-3 p-3 rounded-lg bg-rose-600 hover:bg-rose-700 transition">
            <i class="fa-solid fa-right-from-bracket w-5"></i> <span>Sign Out</span>
        </a>
    </div>
</aside>
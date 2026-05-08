<div x-data="posSystem()" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Products Panel -->
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div class="flex items-center justify-between mb-4 border-b pb-4">
            <h2 class="text-lg font-bold text-slate-800"><i class="fa-solid fa-boxes-stacked text-indigo-600 mr-2"></i>Product Catalog</h2>
            <input type="text" x-model="search" placeholder="Search product/SKU..." class="border px-4 py-2 rounded-lg text-sm outline-none focus:ring-2 focus:ring-indigo-500 w-64">
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 h-[550px] overflow-y-auto pr-2">
            <template x-for="product in filteredProducts()" :key="product.id">
                <div @click="addToCart(product)" class="border p-4 rounded-xl cursor-pointer hover:border-indigo-500 hover:shadow-md transition bg-slate-50 flex flex-col justify-between">
                    <div>
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider" x-text="product.sku"></span>
                        <span class="block font-black text-slate-800 mt-1 text-sm" x-text="product.name"></span>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-indigo-600 font-extrabold text-lg">₱<span x-text="parseFloat(product.retail_price).toFixed(2)"></span></span>
                        <span class="text-xs font-bold px-2 py-0.5 rounded-full" :class="product.stock < 10 ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700'" x-text="'Stock: ' + product.stock"></span>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Checkout Cart Panel -->
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
        <div>
            <h2 class="text-lg font-bold mb-4 border-b pb-4 text-slate-800"><i class="fa-solid fa-cart-shopping text-emerald-600 mr-2"></i>Checkout Cart</h2>
            <div class="space-y-4 h-[250px] overflow-y-auto mb-4 border-b pb-4">
                <template x-for="item in cart" :key="item.id">
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex-1">
                            <span class="block font-bold" x-text="item.name"></span>
                            <span class="text-xs text-slate-400">₱<span x-text="parseFloat(item.retail_price).toFixed(2)"></span> each</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button @click="changeQty(item, -1)" class="w-6 h-6 bg-slate-200 hover:bg-slate-300 rounded font-bold">-</button>
                            <span class="font-bold w-6 text-center" x-text="item.quantity"></span>
                            <button @click="changeQty(item, 1)" class="w-6 h-6 bg-slate-200 hover:bg-slate-300 rounded font-bold">+</button>
                            <button @click="removeFromCart(item)" class="text-rose-500 hover:text-rose-700 pl-2"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <form action="<?= base_url('sales/store') ?>" method="POST" @submit="validateCheckout($event)">
            <input type="hidden" name="cart_data" :value="JSON.stringify(cart)">
            <input type="hidden" name="total_amount" :value="total">

            <div class="space-y-3 mb-4">
                <div class="flex justify-between font-black text-xl text-slate-800">
                    <span>Total Amount:</span>
                    <span>₱<span x-text="total.toFixed(2)"></span></span>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Customer Selection</label>
                    <select name="customer_id" x-model="selectedCustomer" @change="onCustomerChange()" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                        <option value="">Guest Walk-in</option>
                        <?php foreach($customers as $customer): ?>
                            <option value="<?= $customer['id'] ?>" 
                                    data-limit="<?= $customer['credit_limit'] ?>" 
                                    data-debt="<?= $customer['total_utang'] ?>">
                                <?= $customer['name'] ?> (Debt: ₱<?= number_format($customer['total_utang'], 2) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Transaction Method</label>
                    <select name="payment_type" x-model="paymentType" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                        <option value="cash">Cash Tendered</option>
                        <option value="utang" :disabled="!selectedCustomer">Utang Ledger (On Credit)</option>
                    </select>
                </div>
                <div x-show="paymentType === 'cash'">
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Cash Tendered (₱)</label>
                    <input type="number" name="amount_paid" x-model="amountPaid" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div x-show="paymentType === 'cash'" class="flex justify-between text-sm font-bold text-slate-600 mt-2">
                    <span>Change Return:</span>
                    <span :class="change < 0 ? 'text-rose-500' : 'text-emerald-600'">₱<span x-text="change.toFixed(2)"></span></span>
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl transition shadow-md flex items-center justify-center space-x-2">
                <i class="fa-solid fa-file-invoice-dollar"></i> <span>Complete Transaction</span>
            </button>
        </form>
    </div>
</div>

<script>
function posSystem() {
    return {
        products: <?= $products ?>,
        search: '',
        cart: [],
        selectedCustomer: '',
        paymentType: 'cash',
        amountPaid: 0,
        customerDebt: 0,
        customerLimit: 0,

        filteredProducts() {
            return this.products.filter(p => p.name.toLowerCase().includes(this.search.toLowerCase()) || p.sku.toLowerCase().includes(this.search.toLowerCase()));
        },
        addToCart(product) {
            let item = this.cart.find(i => i.id === product.id);
            if (item) {
                if (item.quantity < product.stock) item.quantity++;
            } else {
                this.cart.push({...product, quantity: 1});
            }
        },
        changeQty(item, dir) {
            let p = this.products.find(p => p.id === item.id);
            if (dir === 1 && item.quantity < p.stock) item.quantity++;
            if (dir === -1 && item.quantity > 1) item.quantity--;
        },
        removeFromCart(item) {
            this.cart = this.cart.filter(i => i.id !== item.id);
        },
        get total() {
            return this.cart.reduce((sum, item) => sum + (item.retail_price * item.quantity), 0);
        },
        get change() {
            return this.amountPaid - this.total;
        },
        onCustomerChange() {
            if (!this.selectedCustomer) {
                this.paymentType = 'cash';
                return;
            }
            let el = document.querySelector(`option[value="${this.selectedCustomer}"]`);
            this.customerLimit = parseFloat(el.dataset.limit);
            this.customerDebt = parseFloat(el.dataset.debt);
        },
        validateCheckout(e) {
            if (this.cart.length === 0) {
                alert('Cart is empty!');
                e.preventDefault();
                return;
            }
            if (this.paymentType === 'cash' && this.change < 0) {
                alert('Insufficient cash tendered!');
                e.preventDefault();
                return;
            }
            if (this.paymentType === 'utang') {
                let currentTotalLimit = this.customerDebt + this.total;
                if (currentTotalLimit > this.customerLimit) {
                    alert(`Credit limit exceeded! Customer Credit Limit: ₱${this.customerLimit.toFixed(2)}. Existing Debt: ₱${this.customerDebt.toFixed(2)}`);
                    e.preventDefault();
                }
            }
        }
    }
}
</script>
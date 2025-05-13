<div class="sidebar-wrapper">
    <nav class="mt-2"> <!--begin::Sidebar Menu-->
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

            <li class="nav-header">Initialization</li>
            <x-new-nav-link title="Dashboard" bi_icon="bi-speedometer" route="admin.dashboard" />
            {{-- <x-new-nav-link title="Overview" bi_icon="bi-wallet" route="admin.accounts-summary" /> --}}
            @if (auth()->user()->hasPermission('manage roles'))
                <x-new-nav-link-dropdown title="Roles" bi_icon="bi-person-check" route="admin.roles*">
                    <x-new-nav-link title="Role Overview" bi_icon="" route="admin.roles.index" />
                    <x-new-nav-link title="Create Role" bi_icon="" route="admin.roles.create" />
                </x-new-nav-link-dropdown>
            @endif
            @if (auth()->user()->hasPermission('manage users'))
                <x-new-nav-link-dropdown title="Users" bi_icon="bi-people" route="admin.users*">
                    <x-new-nav-link title="User Overview" bi_icon="" route="admin.users.index" />
                    <x-new-nav-link title="Create User" bi_icon="" route="admin.users.create" />
                </x-new-nav-link-dropdown>
            @endif
            @if (auth()->user()->hasPermission('manage banks'))
                <x-new-nav-link-dropdown title="Banks" bi_icon="bi-bank" route="admin.banks*">
                    <x-new-nav-link title="Bank Overview" bi_icon="" route="admin.banks.index" />
                    <x-new-nav-link title="Create Bank" bi_icon="" route="admin.banks.create" />
                </x-new-nav-link-dropdown>
            @endif
            <li class="nav-header">CRM</li>
            @if (auth()->user()->hasPermission('manage clients'))
                <x-new-nav-link-dropdown title="Customers" bi_icon="bi-people" route="admin.clients*">
                    <x-new-nav-link title="Customer Overview" bi_icon="" route="admin.clients.index" />
                    <x-new-nav-link title="Create Customer" bi_icon="" route="admin.clients.create" />
                </x-new-nav-link-dropdown>
            @endif
            @if (auth()->user()->hasPermission('manage suppliers'))
                <x-new-nav-link-dropdown title="Suppliers" bi_icon="bi-truck-flatbed" route="admin.suppliers*">
                    <x-new-nav-link title="Supplier Overview" bi_icon="" route="admin.suppliers.index" />
                    <x-new-nav-link title="Create Supplier" bi_icon="" route="admin.suppliers.create" />
                </x-new-nav-link-dropdown>

                <li class="nav-header">Product Management</li>
            @endif
            @if (auth()->user()->hasPermission('manage units'))
                <x-new-nav-link-dropdown title="Units" bi_icon="bi-box" route="admin.units*">
                    <x-new-nav-link title="Units List" bi_icon="" route="admin.units.index" />
                    <x-new-nav-link title="Create Unit" bi_icon="" route="admin.units.create" />
                </x-new-nav-link-dropdown>
            @endif
            @if (auth()->user()->hasPermission('manage brands'))
                <x-new-nav-link-dropdown title="Brands" bi_icon="bi-tags" route="admin.brands*">
                    <x-new-nav-link title="Brand Overview" bi_icon="" route="admin.brands.index" />
                    <x-new-nav-link title="Create Brand" bi_icon="" route="admin.brands.create" />
                </x-new-nav-link-dropdown>
            @endif
            @if (auth()->user()->hasPermission('manage product categories'))
                <x-new-nav-link-dropdown title="Product Categories" bi_icon="bi-boxes"
                    route="admin.product-categories*">
                    <x-new-nav-link title="Categorie Overview" bi_icon="" route="admin.product-categories.index" />
                    <x-new-nav-link title="Create Category" bi_icon="" route="admin.product-categories.create" />
                </x-new-nav-link-dropdown>
            @endif
            @if (auth()->user()->hasPermission('manage products'))
                <x-new-nav-link-dropdown title="Products" bi_icon="bi-box" route="admin.products*">
                    <x-new-nav-link title="Product Overview" bi_icon="" route="admin.products.index" />
                    <x-new-nav-link title="Create Product" bi_icon="" route="admin.products.create" />
                </x-new-nav-link-dropdown>
            @endif
            <li class="nav-header">Accounting & Inventory</li>


            @if (auth()->user()->hasPermission('manage purchases'))
                <x-new-nav-link-dropdown title="Purchases" bi_icon="bi-cash-stack" route="admin.purchases*">
                    <x-new-nav-link title="Purchase Overview" bi_icon="" route="admin.purchases.index" />
                    <x-new-nav-link title="Create Purchase" bi_icon="" route="admin.purchases.create" />
                </x-new-nav-link-dropdown>
            @endif
            @if (auth()->user()->hasPermission('manage sales'))
                <x-new-nav-link-dropdown title="Sales" bi_icon="bi-graph-up" route="admin.sales*">
                    <x-new-nav-link title="Sale Overview" bi_icon="" route="admin.sales.index" />
                    <x-new-nav-link title="Create Sale" bi_icon="" route="admin.sales.create" />
                </x-new-nav-link-dropdown>
            @endif
            @if (auth()->user()->hasPermission('manage orders'))
                <x-new-nav-link-dropdown title="Orders" bi_icon="bi-cart" route="admin.orders*">
                    <x-new-nav-link title="Orders Overview" bi_icon="" route="admin.orders.index" />
                    <x-new-nav-link title="Create Order" bi_icon="" route="admin.orders.create" />
                </x-new-nav-link-dropdown>
            @endif
            @if (auth()->user()->hasPermission('manage quotations'))
                <x-new-nav-link-dropdown title="Quotations" bi_icon="bi-quote" route="admin.quotations*">
                    <x-new-nav-link title="Quotation Overview" bi_icon="" route="admin.quotations.index" />
                    <x-new-nav-link title="Create Quotation" bi_icon="" route="admin.quotations.create" />
                </x-new-nav-link-dropdown>
            @endif
            @if (auth()->user()->hasPermission('manage invoices'))
                <x-new-nav-link-dropdown title="Invoices" bi_icon="bi-file-text" route="admin.invoices*">
                    <x-new-nav-link title="Invoice Overview" bi_icon="" route="admin.invoices.index" />
                    <x-new-nav-link title="Create Invoice" bi_icon="" route="admin.invoices.create" />
                </x-new-nav-link-dropdown>
            @endif
            @if (auth()->user()->hasPermission('manage payments'))
                <x-new-nav-link-dropdown title="Sale Payments" bi_icon="bi-file-text" route="admin.sale-payments*">
                    <x-new-nav-link title="Sale Payment Overview" bi_icon="" route="admin.sale-payments.index" />
                    <x-new-nav-link title="Create Sale Payment" bi_icon="" route="admin.sale-payments.create" />
                </x-new-nav-link-dropdown>
            @endif
            @if (auth()->user()->hasPermission('manage payments'))
                <x-new-nav-link-dropdown title="Purchase Payments" bi_icon="bi-file-text"
                    route="admin.purchase-payments*">
                    <x-new-nav-link title="Purchase Payment Overview" bi_icon=""
                        route="admin.purchase-payments.index" />
                    <x-new-nav-link title="Create Purchase Payment" bi_icon=""
                        route="admin.purchase-payments.create" />
                </x-new-nav-link-dropdown>
            @endif
            @if (auth()->user()->hasPermission('manage credit notes'))
                <x-new-nav-link-dropdown title="Credit Notes" bi_icon="bi-receipt" route="admin.credit-notes*">
                    <x-new-nav-link title="Credit Note Overview" bi_icon="" route="admin.credit-notes.index" />
                    <x-new-nav-link title="Create Credit Note" bi_icon="" route="admin.credit-notes.create" />
                </x-new-nav-link-dropdown>
            @endif
            @if (auth()->user()->hasPermission('manage delivery notes'))
                <x-new-nav-link-dropdown title="Delivery Notes" bi_icon="bi-truck" route="admin.delivery-notes*">
                    <x-new-nav-link title="Delivery Note Overview" bi_icon="" route="admin.delivery-notes.index" />
                    <x-new-nav-link title="Create Delivery Note" bi_icon=""
                        route="admin.delivery-notes.create" />
                </x-new-nav-link-dropdown>
            @endif
        </ul> <!--end::Sidebar Menu-->
    </nav>
</div>

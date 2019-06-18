<nav class="sidebar-nav">
    <ul class="nav in side-menu">
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-user"></i> <span class="hide-menu">Customers</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('customers.index') }}">Customer List</a>
                </li>
                <li>
                    <a href="{{ route('customers.create') }}">Add a New Customer</a>
                </li>

            </ul>
        </li>
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-user" style="margin-top: -50px;"></i> <span class="hide-menu">Incoming Items & Outgoing Items</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('item.index') }}">Incoming Items & Outgoing Items</a>
                </li>
                <li>
                    <a href="{{ route('item.create') }}">Add a New Incoming or Outgoing Item</a>
                </li>

            </ul>
        </li>

        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-user"></i> <span class="hide-menu">Billing</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('billing.index') }}">Billing List</a>
                </li>
                <li>
                    <a href="{{ route('billing.create',['type'=>0]) }}">Add a New Incoming Billing</a>
                </li>
                <li>
                    <a href="{{ route('billing.create',['type'=>1]) }}">Add a New Outgoing Billing</a>
                </li>

            </ul>
        </li>

        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-user"></i> <span class="hide-menu">Products</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('products.index') }}">Product List</a>
                </li>
                <li>
                    <a href="{{ route('products.create') }}">Add a New Product</a>
                </li>

            </ul>
        </li>



        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-user"></i> <span class="hide-menu">Bank</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('banks.index') }}">Bank List</a>
                </li>
                <li>
                    <a href="{{ route('banks.create') }}">Add a New Bank</a>
                </li>

            </ul>
        </li>
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-user"></i> <span class="hide-menu">Operations</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('operations.index') }}">Operation List</a>
                </li>
                <li>
                    <a href="{{ route('operations.create',['type'=>0]) }}">Make Payment</a>
                </li>
                <li>
                    <a href="{{ route('operations.create',['type'=>1]) }}">Get Collections</a>
                </li>

            </ul>
        </li>
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-user"></i> <span class="hide-menu">Offers</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('offers.index') }}">Offer List</a>
                </li>
                <li>
                    <a href="{{ route('offers.create')}}">Make Offer</a>
                </li>

            </ul>
        </li>
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-user"></i> <span class="hide-menu">Chart</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('chart.index') }}">Chart</a>
                </li>

            </ul>
        </li>
    </ul>
    <!-- /.side-menu -->
</nav>

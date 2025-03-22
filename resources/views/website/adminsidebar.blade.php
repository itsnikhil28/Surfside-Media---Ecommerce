<div class="section-menu-left">
    <div class="box-logo">
        <a href="/admin-dashboard" id="site-logo-inner">
            <img src="{{asset('admin/images/logo/logo.png')}}" class="" alt=""
                data-light="{{asset('admin/images/logo/logo.png')}}"
                data-dark="{{asset('admin/images/logo/logo.png')}}">
        </a>
        <div class="button-show-hide">
            <i class="icon-menu-left"></i>
        </div>
    </div>
    <div class="center">
        <div class="center-item">
            <div class="center-heading">Main Home</div>
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="/admin-dashboard" class="{{request()->is('admin-dashboard') ? 'active' : ''}}">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">Dashboard</div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="center-item">
            <ul class="menu-list">
                <li class="menu-item has-children">
                    <a href="javascript:void(0);"
                        class="menu-item-button {{ request()->is('add-product') || request()->is('products') ? 'active' : '' }}">
                        <div class="icon"><i class="icon-shopping-cart"></i></div>
                        <div class="text">Products</div>
                    </a>
                    <ul class="sub-menu"
                        style="{{ request()->is('add-product') || request()->is('products') ? 'display: block;' : 'display: none;' }}">
                        <li class="sub-menu-item">
                            <a href="/add-product" class="{{request()->is('add-product') ? 'active' : ''}}">
                                <div class="text">Add Product</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="/products" class="{{request()->is('products') ? 'active' : ''}}">
                                <div class="text">Products</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button {{ request()->is('add-brand') || request()->is('brands') ? 'active' : '' }}">
                        <div class="icon"><i class="icon-layers"></i></div>
                        <div class="text">Brand</div>
                    </a>
                    <ul class="sub-menu" style="{{ request()->is('add-brand') || request()->is('brands') ? 'display: block;' : 'display: none;' }}">
                        <li class="sub-menu-item">
                            <a href="/add-brand" class="{{request()->is('add-brand') ? 'active' : ''}}">
                                <div class="text">Add New Brand</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="/brands" class="{{request()->is('brands') ? 'active' : ''}}">
                                <div class="text">Brands</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button {{ request()->is('add-category') || request()->is('categories') ? 'active' : '' }}">
                        <div class="icon"><i class="icon-layers"></i></div>
                        <div class="text">Category</div>
                    </a>
                    <ul class="sub-menu" style="{{ request()->is('add-category') || request()->is('categories') ? 'display: block;' : 'display: none;' }}">
                        <li class="sub-menu-item">
                            <a href="/add-category" class="{{request()->is('add-category') ? 'active' : ''}}">
                                <div class="text">Add New Category</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="/categories" class="{{request()->is('categories') ? 'active' : ''}}">
                                <div class="text">Categories</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button {{ request()->is('order-tracking') || request()->is('orders') ? 'active' : '' }}" >
                        <div class="icon"><i class="icon-file-plus"></i></div>
                        <div class="text">Order</div>
                    </a>
                    <ul class="sub-menu" style="{{ request()->is('order-tracking') || request()->is('orders') ? 'display: block;' : 'display: none;' }}">
                        <li class="sub-menu-item">
                            <a href="/orders" class="{{request()->is('orders') ? 'active' : ''}}">
                                <div class="text">Orders</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="/order-tracking" class="{{request()->is('order-tracking') ? 'active' : ''}}">
                                <div class="text">Order tracking</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="/sales" class="{{request()->is('sales') ? 'active' : ''}}">
                        <div class="icon"><i class="icon-shopping-cart"></i></div>
                        <div class="text">Sales</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/sliders" class="{{request()->is('sliders') ? 'active' : ''}}">
                        <div class="icon"><i class="icon-image"></i></div>
                        <div class="text">Slider</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/coupons" class="{{request()->is('coupons') ? 'active' : ''}}">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">Coupns</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="/users" class="{{request()->is('users') ? 'active' : ''}}">
                        <div class="icon"><i class="icon-user"></i></div>
                        <div class="text">User</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="/settings" class="{{request()->is('settings') ? 'active' : ''}}">
                        <div class="icon"><i class="icon-settings"></i></div>
                        <div class="text">Settings</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
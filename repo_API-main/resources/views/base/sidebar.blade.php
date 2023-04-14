<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            @php
              $classDashbroadItem = 'nav-link collapsed';

              if (Request::is("admin/dashbroad") || Request::is("admin/dashbroad/*")) {
                $classDashbroadItem = 'nav-link';
              }
            @endphp

            <a class="{{ $classDashbroadItem }}" href="{{route('dashbroad.index')}}">
                <i class="bi bi-house-fill"></i>
                <span>Dashbroad</span>
            </a>
        </li>

        <li class="nav-item">
            @php
              $classOrderItem = 'nav-link collapsed';

              if (Request::is("admin/orders/*") || Request::is("admin/orders")) {
                $classOrderItem = 'nav-link';
              }
            @endphp
            
            <a class="{{ $classOrderItem }}" href="{{route('orders.index')}}">
              <i class="bx bx-box fs-6"></i>
              <span>Đơn hàng</span>
            </a>
        </li>

        <li class="nav-item" >
            @php
              $classProductItem = 'nav-link collapsed';
              $classProductShowChildItem = 'nav-content collapse';
              $categoryActive = '';
              $shippingActive = '';
              $promoActive = '';

              if (Request::is("admin/products") || Request::is("admin/products/*")) {
                $classProductItem = 'nav-link';
                $classProductShowChildItem = 'nav-content collapse show';
              }

              if (Request::is("admin/categories") || Request::is("admin/categories/*")) {
                $classProductItem = 'nav-link';
                $classProductShowChildItem = 'nav-content collapse show';
                $categoryActive = 'active';
              }

              if (Request::is("admin/shipping") || Request::is("admin/shipping/*")) {
                $classProductItem = 'nav-link';
                $classProductShowChildItem = 'nav-content collapse show';
                $shippingActive = 'active';
              }

              if (Request::is("admin/promo") || Request::is("admin/promo/*")) {
                $classProductItem = 'nav-link';
                $classProductShowChildItem = 'nav-content collapse show';
                $promoActive = 'active';
              }


            @endphp

            <a class="{{ $classProductItem }}" href="{{route('products.index')}}">
                <i class="bx bxs-purchase-tag fs-6"></i><span>Sản phẩm</span>
            </a>
            <ul id="charts-nav" class="{{ $classProductShowChildItem }}">
                <li>
                  <a href="{{route('categories.index')}}" class="{{ $categoryActive }}">
                    <i class="bi bi-collection-fill fs-6"></i><span>Bộ sưu tập</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('shipping.index')}}" class="{{ $shippingActive }}">
                    <i class="bi bi-truck-flatbed fs-6"></i><span>Vận chuyển</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('promo.index')}}" class="{{ $promoActive }}">
                    <i class="bi bi-percent fs-6"></i><span>Giảm giá</span>
                  </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            @php
              $classCustomerItem = 'nav-link collapsed';

              if (Request::is("admin/customers") || Request::is("admin/customers/*")) {
                $classCustomerItem = 'nav-link';
              }
            @endphp

            <a class="{{ $classCustomerItem }}" href="{{route('customers.index')}}">
                <i class="bx bxs-user fs-6"></i>
                <span>Khách hàng</span>
            </a>
        </li>
    </ul>

</aside>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link {{ !Request::is("admin/order") && !Request::is("admin/order/*") ? 'collapsed' : null }}" href="{{route('admin.order.index')}}">
        <i class="bi bi-cart-dash"></i>
        <span>Order</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ !Request::is("admin/product") && !Request::is("admin/product/*") ? 'collapsed' : null }}" href="{{route('admin.product.index')}}">
        <i class="bi bi-archive"></i><span>Product</span>
      </a>
      <ul id="charts-nav" class="nav-content collapse {{ Request::is("admin/product") || Request::is("admin/product/*") ? 'show' : null }}">
        <li>
          <a href="{{route('admin.product.create')}}" class="{{ request()->route()->named('admin.product.create') ? 'active' : null }}">
            <i class="bi bi-plus-circle fs-6"></i><span>Add Product</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.product.index')}}" class="{{ request()->route()->named('admin.product.index') ? 'active' : null }}">
            <i class="bi bi-list fs-6"></i><span>Product List</span>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ !Request::is("admin/category") && !Request::is("admin/category/*") ? 'collapsed' : null }}" href="{{route('admin.category.index')}}">
        <i class="bi bi-list-task"></i>
        <span>Category</span>
      </a>
      <ul id="charts-nav" class="nav-content collapse {{ Request::is("admin/category") || Request::is("admin/category/*") ? 'show' : null }}">
        <li>
          <a href="{{route('admin.category.create')}}" class="{{ request()->route()->named('admin.category.create') ? 'active' : null }}">
            <i class="bi bi-plus-circle fs-6"></i><span>Add Category</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.category.index')}}" class="{{ request()->route()->named('admin.category.index') ? 'active' : null }}">
            <i class="bi bi-list fs-6"></i><span>Category List</span>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ !Request::is("admin/shipping") && !Request::is("admin/shipping/*") ? 'collapsed' : null }}" href="{{route('admin.shipping.index')}}">
        <i class="bi bi-truck-flatbed fs-6"></i>
        <span>Shipping</span>
      </a>
      <ul id="charts-nav" class="nav-content collapse {{ Request::is("admin/shipping") || Request::is("admin/shipping/*") ? 'show' : null }}">
        <li>
          <a href="{{route('admin.shipping.create')}}" class="{{ request()->route()->named('admin.shipping.create') ? 'active' : null }}">
            <i class="bi bi-plus-circle fs-6"></i><span>Add Shipping</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.shipping.index')}}" class="{{ request()->route()->named('admin.shipping.index') ? 'active' : null }}">
            <i class="bi bi-list fs-6"></i><span>Shipping List</span>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ !Request::is("admin/promo") && !Request::is("admin/promo/*") ? 'collapsed' : null }}" href="{{route('admin.promo.index')}}">
        <i class="bi bi-tags"></i>
        <span>Promo</span>
      </a>
      <ul id="charts-nav" class="nav-content collapse {{ Request::is("admin/promo") || Request::is("admin/promo/*") ? 'show' : null }}">
        <li>
          <a href="{{route('admin.promo.create')}}" class="{{ request()->route()->named('admin.promo.create') ? 'active' : null }}">
            <i class="bi bi-plus-circle fs-6"></i><span>Add Promo</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.promo.index')}}" class="{{ request()->route()->named('admin.promo.index') ? 'active' : null }}">
            <i class="bi bi-list fs-6"></i><span>Promo List</span>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ !Request::is("admin/customer") && !Request::is("admin/customer/*") ? 'collapsed' : null }}" href="{{route('admin.customer.index')}}">
        <i class="bi bi-people"></i>
        <span>Customer</span>
      </a>
    </li>
  </ul>
</aside>
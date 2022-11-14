  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{route('dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link " href="{{route('banners')}}">
          <i class="bi bi-list"></i>
          <span>Banner</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('category')}}">
              <i class="bi bi-circle"></i><span>Product Category</span>
            </a>
          </li>
          <li>
            <a href="{{route('sub_category')}}">
              <i class="bi bi-circle"></i><span>Product Sub Category</span>
            </a>
          </li>
          <li>
            <a href="{{route('products')}}">
              <i class="bi bi-circle"></i><span>Product List</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav --
      <!-- End Blank Page Nav -->

    </ul>

  </aside>

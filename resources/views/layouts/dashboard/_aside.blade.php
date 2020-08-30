  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('pos.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">POS</span>
      </a>
      <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('default.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">user name</a>
          {{-- <a href="#" class="d-block">{{auth()->user()->first_name.' ' .auth()->user()->last_name}}</a> --}}
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                @lang('dashboard.dashboard')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            </ul>
          </li>
          @if (auth()->user()->hasPermission('read-users'))
          <li class="nav-item">
            <a href="{{route('dashboard.users.index')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                @lang('dashboard.users')
                {{-- <span class="right badge badge-info">1</span> --}}
              </p>
            </a>
          </li>
          @endif
          @if (auth()->user()->hasPermission('read-categories'))
          <li class="nav-item">
            <a href="{{route('dashboard.categories.index')}}" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                @lang('dashboard.categories')
            {{-- <span class="right badge badge-info">1</span> --}}
              </p>
            </a>
          </li>
          @endif
          @if (auth()->user()->hasPermission('read-products'))
          <li class="nav-item">
            <a href="{{route('dashboard.products.index')}}" class="nav-link">
              <i class="nav-icon fas fa-box-open"></i>
              <p>
                @lang('dashboard.products')
            {{-- <span class="right badge badge-info">1</span> --}}
              </p>
            </a>
          </li>
          @endif
          @if (auth()->user()->hasPermission('read-clients'))
          <li class="nav-item">
            <a href="{{route('dashboard.clients.index')}}" class="nav-link">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                @lang('dashboard.clients')
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{route('dashboard.vendors.index')}}" class="nav-link">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                @lang('dashboard.vendors')
              </p>
            </a>
          </li>
          @if (auth()->user()->hasPermission('read-orders'))
          <li class="nav-item">
            <a href="{{route('dashboard.orders.index')}}" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                @lang('dashboard.orders')
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{route('dashboard.invoices.index')}}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                @lang('dashboard.invoices')
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboard.invoices.create')}}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                @lang('invoice-create')
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboard.transactions.index')}}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                @lang('dashboard.transactions')
              </p>
            </a>
          </li>
                    <li class="nav-item">
            <a href="{{route('dashboard.bills.index')}}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                @lang('dashboard.bills')
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboard.bills.create')}}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                @lang('bill-create')
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                @lang('dashboard.charts')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flot</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inline</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

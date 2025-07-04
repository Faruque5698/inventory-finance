<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <a class="nav-link" href="{{route('products.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Product
                </a>

                <a class="nav-link" href="{{route('inventories.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                    Inventory
                </a>

                <a class="nav-link" href="{{route('sales.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                    Sales
                </a>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{\Illuminate\Support\Facades\Auth::user()->name}}
        </div>
    </nav>
</div>

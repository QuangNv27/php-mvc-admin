<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="<?=$_ENV['BASE_URL']?>admin/user">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                {{--  --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUser" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    User
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseUser" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?=$_ENV['BASE_URL']?>admin/user">Danh sách</a>
                        <a class="nav-link" href="<?=$_ENV['BASE_URL']?>admin/user/add">Thêm mới</a>
                    </nav>
                </div>
                {{--  --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Product
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?=$_ENV['BASE_URL']?>admin/product">Danh sách</a>
                        <a class="nav-link" href="<?=$_ENV['BASE_URL']?>admin/product/add">Thêm mới</a>
                    </nav>
                </div>
                {{--  --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCate" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCate" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?=$_ENV['BASE_URL']?>admin/category">Danh sách</a>
                        <a class="nav-link" href="<?=$_ENV['BASE_URL']?>admin/category/add">Thêm mới</a>
                    </nav>
                </div>
                {{--  --}}
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>
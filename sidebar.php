<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Sistem Absensi</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <!--<li class="nav-item <?php /*if ((isset($_GET['halaman']) && $_GET['halaman'] == 'dashboard') || isset($_GET['halaman']) == false) :*/?> active <?php /*endif;*/?>">
                <a class="nav-link" href="index.php?halaman=dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>-->

            <li class="nav-item <?php if ((isset($_GET['halaman']) && $_GET['halaman'] == 'mata-kuliah'))  :?> active <?php endif;?>">
                <a class="nav-link" href="mata-kuliah.php?halaman=mata-kuliah">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <span>Mata Kuliah</span>
                </a>
            </li>

            <li class="nav-item <?php if ((isset($_GET['halaman']) && $_GET['halaman'] == 'data-absen'))  :?> active <?php endif;?>">
                <a class="nav-link" href="data-absen.php?halaman=data-absen">
                    <i class="fa fa-calendar" aria-hidden="true"></i>   
                    <span>Data Absen</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
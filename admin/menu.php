<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
        <div class="sidebar-brand-text mx-3">CTC - BOOKING</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="home.php">
            <i class="fas fa-book"></i>
            <span>รายการจอง</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item active">
        <a class="nav-link" href="roomManager.php">
            <i class="fas fa-door-open"></i>
            <span>จัดการห้องประชุม</span></a>
    </li>
    <?php if (!empty($_SESSION["status"])) {
        if ($_SESSION["status"] == "admin") {
    ?>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item active">
                <a class="nav-link" href="userManager.php">
                    <i class="fas fa-user-alt"></i>
                    <span>จัดการผู้ใช้งาน</span></a>
            </li>
    <?php }
    } ?>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item active">
        <a class="nav-link" href="history.php">
            <i class="fas fa-history"></i>
            <span>ประวัติการจอง</span></a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item active">
        <a class="nav-link" href="charts.php">
            <i class="fas fa-chart-area"></i>
            <span>สถิติการจอง</span></a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item active">
        <a class="nav-link" href="calendar.php">
            <i class="fas fa-calendar"></i>
            <span>ปฏิทิน</span></a>
    </li>
    <!-- Heading -->
    <!-- <div class="sidebar-heading">
        Interface
    </div> -->

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li> -->

</ul>
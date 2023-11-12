<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item ">
            <a class="nav-link " href="../views/main-dashboard.php">
                <i class="bi bi-speedometer"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item ">
            <a class="nav-link " href="../views/transaction.php">
                <i class="bi bi-shop"></i>
                <span>Transaction</span>
            </a>
        </li>

        <li class="nav-item ">
            <a class="nav-link " href="../views/stocks.php">
                <i class="bi bi-boxes"></i>
                <span>Stocks</span>
            </a>
        </li>

        <li class="nav-item ">
            <a class="nav-link " href="../views/menu-items.php">
                <i class="bi bi-basket"></i>
                <span>Menu items</span>
            </a>
        </li>

        <li class="nav-item ">
            <a class="nav-link " href="../views/capitals.php">
                ₱ &nbsp;&nbsp;
                <span>Capitals</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#pages-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bezier"></i><span>Branches</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="pages-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="../views/sagayterminal.php">
                        <i class="bi bi-truck fs-6"></i><span>Sagay Terminal</span>
                    </a>
                </li>
                <li>
                    <a href="../views/nonescostnewsite.php">
                        <i class="bi bi-bank fs-6"></i><span>NONESCOST New Site</span>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#settings-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gear"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="settings-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="../views/owner-acount-settings.php">
                        <i class="bi bi-person-circle fs-6"></i><span>Account</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="../logout.php" class="nav-link collapsed">
                <i class="bi bi-box-arrow-in-left"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</aside>
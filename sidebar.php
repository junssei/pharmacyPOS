<div class="sidebar">
    <div class="sidebarheader">
        <div class="logoheader">
            <img src="images/logo.svg" alt="logo" draggable="false" />
        </div>
        <div class="companyname">
            <a href='dashboard.php'> MAYLUZ PHARMACY </a>
        </div>
    </div>
    <div class="userbox">
        <div class="profileimage">
            <img class="userprofile" src="images/User1.png" alt="profile" draggable="false">
            <img class="changeprofile" src="images/changeprofile.png" alt="cameraicon" draggable="false">
        </div>
        <div class="profilename">
            <div class="usernamebox">
                <p class="username">
                    <?php echo $_SESSION['user'] ?>
                </p>
            </div>
            <p class="userposition">
                <?php echo $_SESSION['position'] ?>
            </p>
        </div>
    </div>
    <div>
        <?php $currentPage = basename($_SERVER['REQUEST_URI']); ?>
        <ul class="sidebar-links">
            <div>
                <li class="nav-link">
                    <a href="dashboard.php" <?php if ($currentPage === "dashboard.php") { ?> class="active-link" <?php } ?>>
                        <img src="images/dashb.png" alt="dashboardIcon">
                        <span class="nav-text"> Dashboard </span>
                    </a>
                </li>
                <li class="nav-link dropdown">
                    <a href="#" class="dropdown-btn">
                        <div>
                            <img src="images/inventory.png" alt="dashboardIcon">
                            <span class="nav-text"> Inventory </span>
                        </div>
                        <img class="dropdownicon" src="images/downnicon2.png">
                    </a>
                    <div class="dropdown-container">
                        <a href="category.php" <?php if ($currentPage === "category.php") { ?> class="active-link" <?php } ?>>Category</a>
                        <a href="medicine.php" <?php if ($currentPage === "medicine.php") { ?> class="active-link" <?php } ?>>Medicine</a>
                    </div>
                </li>
                <li class="nav-link dropdown">
                    <a href="#" class="dropdown-btn">
                        <div>
                            <img src="images/report.png" alt="dashboardIcon">
                            <span class="nav-text"> Report </span>
                        </div>
                        <img class="dropdownicon" src="images/downnicon2.png">
                    </a>
                    <div class="dropdown-container">
                        <a href="salesReport.php" <?php if ($currentPage === "salesReport.php") { ?> class="active-link" <?php } ?>>Sales Report</a>
                        <a href="inventoryReport.php" <?php if ($currentPage === "inventoryReport.php") { ?> class="active-link" <?php } ?>>Inventory Report</a>
                    </div>
                </li>
                <li class="nav-link">
                    <a href="pos.php">
                        <img src="images/pos.png" alt="dashboardIcon">
                        <span class="nav-text"> POS View </span>
                    </a>
                </li>
            </div>
            <div>
                <li class="nav-link">
                    <a href="employee.php" <?php if ($currentPage === "employee.php") { ?> class="active-link" <?php } ?>>
                        <img src="images/people.png" alt="dashboardIcon">
                        <span class="nav-text"> Employee </span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="logout.php">
                        <img src="images/logouticon.png" alt="logoutIcon">
                        <span class="nav-text"> Logout </span>
                    </a>
                </li>
            </div>
        </ul>
    </div>
</div>
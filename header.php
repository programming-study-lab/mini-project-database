
<header>
        <div class="container">
            <div style="text-align:center;width:100%;">
                <h2>Webboard</h2>
                <nav>
                    <a href="index.php">
                        <img src="images/home.png" width="50" height="50"> หน้าหลัก
                    </a>
                    <?php 
                        if (isset($_SESSION['ID'])) {
                            if ($_SESSION['ID'] == 1) {
                                echo '<a href="Admin.php">
                                <img src="images/admin.png" width="50" height="50"> Admin
                                </a>';
                            }
                        } else {
                            
                        }
                    ?>
                    
                    <a href="user.php">
                        <img src="images/user.png" width="50" height="50"> User
                    </a>
                    <a href="logout.php">
                        <img src="images/logout.png" width="50" height="50"> ออกจากระบบ
                    </a>
                </nav>
            </div>
</header>
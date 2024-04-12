<nav class="navbar fixed-top navbar-expand-lg navbar-light w-100 bg-light mainNavbar">
    <div class="container">
        <a class="navbar-brand" href="#">Villa Delos Reyes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gallery.php">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="offers.php">Offers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="viewfeedbacks.php">Feedbacks</a>
                </li>
                <li class="nav-item">
                    <span class="text-dark nav-link">
                        <?php
                        if (isset($_SESSION['email'])) {
                            echo "Hi, " . $_SESSION['email'];
                        }
                        ?>
                    </span>
                </li>
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo '<a class="btn btn-danger" href="../../logout.php">Logout</a>';
                    } else {
                        echo '<a class="btn btn-success" href="../../index.php">Login</a>';
                    }
                    ?>
                </li>
            </ul>
            <li class="nav-item">
                <!-- Add icon with button using bootstrap -->
                <a href="BookNow.php" id="button" class="btn btn-primary">Book Now</a>
            </li>
        </div>
    </div>
</nav>
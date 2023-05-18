<!-- Start Navbar Section -->
<nav class="navbar navbar-expand-lg bg-light fixed-top">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="#">Online Voting System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="makeVote.php">Create a vote</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="messages.php">Contact us</a>
                    </li>
                    
                    
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php
                        if(isset($_SESSION['user'])){
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <?= $_SESSION['user']->username ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile.php">my Profile</a></li>
                            <li><a class="dropdown-item" href="my_messages.php">my Messages</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                    <?php
                        }else
                        {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Signup</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="login.php">Login</a>
                    </li>
                    <?php
                        }
                    ?>
                    
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar Section -->
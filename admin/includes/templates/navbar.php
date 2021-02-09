<?php




?>





    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
        <a class="navbar-brand" href="dashboard.php"><?php echo lang('DASHBOARD') ?></a>
        <button class="navbar-toggler" type="button"
                data-toggle="collapse"
                data-target="#app-nav"
                aria-controls="app-nav"
                aria-expanded="false"
                aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="app-nav">
            <ul class="navbar-nav mr-auto">
                <!--  <li class="nav-item active">
                <a class="nav-link" href="#"><?php /*echo lang('HOME_ADMIN') */?></span></a>
            </li>-->
                <li class="nav-item">
                    <a class="nav-link" href="categories.php"><?php echo lang('CATEGORIES') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo lang('ITEMS') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="members.php"><?php echo lang('MEMBRES') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo lang('STATISTICS') ?></a>
                </li>

            </ul>
            <ul class="navbar-nav">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION['username']?>
                    </a>
                    <div class="dropdown-menu lastItem" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['id']?>"><?php echo lang('EDIT_PROFILE') ?></a>
                        <a class="dropdown-item" href="#"><?php echo lang('SETTINGS') ?></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php"><?php echo lang('LOGOUT') ?></a>
                    </div>
                </li>

            </ul>
        </div>
        </div>
    </nav>


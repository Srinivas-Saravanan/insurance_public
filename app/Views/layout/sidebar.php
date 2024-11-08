<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= base_url('/') ?>" class="brand-link">
        <span class="brand-text font-weight-light">Insurance</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <?php $currentURI = uri_string(); ?>

                <?php if (session()->has('loggedAdmin')): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('/') ?>" class="nav-link <?= ($currentURI == 'home/home') || strpos($currentURI, 'home/view') === 0 || ($currentURI == 'home/newFam') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('home/dashboard2') ?>" class="nav-link <?= ($currentURI == 'home/dashboard2') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('home/rules') ?>" class="nav-link <?= ($currentURI == 'home/rules' || strpos($currentURI, 'home/ruler/') === 0) ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-gavel"></i>
                            <p>Rules</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/logout') ?>" class="nav-link <?= ($currentURI == 'logout') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Log Out</p>
                        </a>
                    </li>

                <?php elseif (session()->has('loggedUser')): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('/') ?>" class="nav-link <?= ($currentURI == 'home/home') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('home/dashboard2') ?>" class="nav-link <?= ($currentURI == 'home/dashboard2') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/logout') ?>" class="nav-link <?= ($currentURI == 'logout') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Log Out</p>
                        </a>
                    </li>

                <?php elseif (session()->has('loggedEmp')): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('/payment') ?>" class="nav-link <?= ($currentURI == 'payment') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-credit-card"></i>
                            <p>Renewal</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/logout') ?>" class="nav-link <?= ($currentURI == 'logout') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Log Out</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    
</aside>



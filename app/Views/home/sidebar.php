<div class="sidebar">
    <h2>Menu</h2>
    <?php $currentURI = uri_string(); ?>
    
    <?php if (session()->has('loggedAdmin')): ?>
        <a href="<?= base_url('/') ?>" class="<?= ($currentURI == 'home/home')||strpos($currentURI,'home/view') ===0 || ($currentURI == 'home/newFam') ? 'active' : '' ?>">Home</a>
        <a href="<?= base_url('home/dashboard2') ?>" class="<?= ($currentURI == 'home/dashboard2') ? 'active' : '' ?>">Dashboard</a>
        <a href="<?= base_url('home/rules') ?>" class="<?= ($currentURI == 'home/rules' || strpos($currentURI, 'home/ruler/') === 0) ? 'active' : '' ?>">Rules</a>
        <a href="<?= base_url('/logout') ?>" class="<?= ($currentURI == 'logout') ? 'active' : '' ?>">Log Out</a>
    
    <?php elseif (session()->has('loggedUser')): ?>
        <a href="<?= base_url('/') ?>" class="<?= ($currentURI == 'home/home') ? 'active' : '' ?>">Home</a>
        <a href="<?= base_url('home/dashboard2') ?>" class="<?= ($currentURI == 'home/dashboard2') ? 'active' : '' ?>">Dashboard</a>
        <a href="<?= base_url('/logout') ?>" class="<?= ($currentURI == 'logout') ? 'active' : '' ?>">Log Out</a>

        <?php elseif(session()->has('loggedEmp')):?>
            <a href="<?= base_url('/logout') ?>" class="<?= ($currentURI == 'logout') ? 'active' : '' ?>">Log Out</a>
    <?php endif; ?>
</div>

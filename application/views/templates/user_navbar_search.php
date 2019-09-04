<nav class="navbar navbar-expand-lg navbar-light">
    <form action="<?= base_url('user/search'); ?>" method="get">
        <div class="input-group1" style="margin-top:5px;width:auto;">
            <input type="text" class="form-control" id="keywordFilter" placeholder="Search" value="<?= $_GET['keyword']; ?>" name="keyword">
        </div>
    </form>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i><span> Home</span></a>
            <a class="nav-item nav-link" href="<?= base_url('user/belanjaan'); ?>"><i class="fas fa-fw fa-shopping-basket"></i><span> Belanjaan</span></a>
            <a class="nav-item nav-link" href="<?= base_url('user/edit_profile'); ?>"><i class="fas fa-fw fa-id-card"></i><span> Setting Profile</span></a>
            <a class="nav-item nav-link" href="<?= base_url('user/about'); ?>"><i class="fas fa-fw fa-question-circle"></i><span> About</span></a>
            <a class="nav-item nav-link" href="<?= base_url('auth/logout'); ?>"><i class="fas fa-fw fa-sign-in-alt"></i><span> Logout</span></a>
        </div>
    </div>
</nav>
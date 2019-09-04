<!--banner-->
<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Register</h3>
        <div class="clearfix"> </div>
    </div>
</div>

<!--Query Register-->

<!--Pembeli-->

<div class="login">
    <div class="main-agileits" style="margin-bottom:20px;">
        <div class="form-w3agile form1">
            <h3><b>Register Pembeli</b></h3>

            <form action="<?= base_url('auth/registration') ?>" method="post">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="name" placeholder="Full Name" name="name" value="<?= set_value('name'); ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="email" placeholder="Email Address" name="email" value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password1" placeholder="Password" name="password1">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password2" placeholder="Repeat Password" name="password2">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Register Account
                </button>
            </form>
            <hr>
            <div class="forg">
                <a class="forg-left" href="<?= base_url('Auth'); ?>">Login</a>
                <a class="forg-right" href="<?= base_url('Auth/registerPenjual'); ?>">Register Penjual</a>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
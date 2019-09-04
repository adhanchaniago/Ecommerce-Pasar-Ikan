<!--banner-->
<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Ganti Password</h3>
        <div class="clearfix"> </div>
    </div>
</div>
<!--login-->

<div class="login">

    <div class="main-agileits">
        <div class="form-w3agile">
            <h3>Ganti Password <br> <?= $this->session->userdata('reset_email'); ?></h3>

            <?= $this->session->flashdata('message'); ?>

            <form class="user" method="post" action="<?= base_url('Auth/changepassword'); ?>">
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password Baru Anda" value="">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Konfirmasi Password" value="">
                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Ganti Password
                </button>
            </form>
        </div>
    </div>
</div>
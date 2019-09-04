<!--banner-->
<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Forgot Password</h3>
        <div class="clearfix"> </div>
    </div>
</div>
<!--login-->

<div class="login">

    <div class="main-agileits">
        <div class="form-w3agile">
            <h3>Forgot Password</h3>

            <?= $this->session->flashdata('message'); ?>

            <form class="user" method="post" action="<?= base_url('Auth/forgotpassword'); ?>">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Reset Password
                </button>
            </form>
        </div>
        <div class="forg">
            <a class="forg-right" href="<?= base_url('Auth'); ?>">Kembali ke Login</a>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
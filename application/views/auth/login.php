<!--banner-->
<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Login</h3>
        <div class="clearfix"> </div>
    </div>
</div>
<!--login-->

<div class="login" style="margin-bottom:30%;">

    <div class="main-agileits">
        <div class="form-w3agile">
            <h3>Login</h3>

            <?= $this->session->flashdata('message'); ?>

            <form class="user" method="post" action="<?= base_url('Auth/index'); ?>">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-password form-control form-control-user" name="password" id="password" placeholder="Password">
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type=button id="show" value="Show Password" onclick="ShowPassword()">
                    <input type=button style="display:none" id="hide" value="Hide Password" onclick="HidePassword()">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                </button>
            </form>
        </div>
        <div class="forg">
            <a class="forg-left" href="<?= base_url('Auth/forgotpassword'); ?>">Forgot Password?</a>
            <a class="forg-right" href="<?= base_url('Auth/registration'); ?>">Register</a>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
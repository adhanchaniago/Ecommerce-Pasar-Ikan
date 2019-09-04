<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Edit Profile</h3>
        <h4><a href="#">Home</a><label>/</label>Edit Profile</h4>
        <div class="clearfix"> </div>
        <div class="row">
            <div class="col-lg-6">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <br>
    <div class=" tab-content tab-content-t ">
        <div class="tab-pane active text-style">
            <div class=" con-w3l">
                <div class="col-md-8">
                    <div class="col-m">
                        <?= $this->session->flashdata('message'); ?>
                        <img src="<?= base_url('assets/img/foto/') . $users['image']; ?>" class="img-responsive" alt="" style="width:100%;">
                        <div class="card-body">
                            <h3 class="card-title"><?= $users['name']; ?></h3>
                            <p class="card-text">email : <?= $users['email']; ?></p>
                            <p class="card-text">Alamat : <?= $users['address']; ?></p>
                            <p class="card-text">No Telp : <?= $users['no_telp'] ?></p>
                            <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $users['date_created']); ?></small></p>
                        </div>
                        <a href="<?= base_url('user/edit_profile_pembeli'); ?>" class="btn btn-success" style="margin-bottom:5px;">Edit Profile</a>
                        <a href="<?= base_url('user/changePassword'); ?>" class="btn btn-success" style="margin-bottom:5px;">Ganti Password</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <br>
    <br>
</div>
<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Edit Profile</h3>
        <div class="clearfix"> </div>
        <div class="row">
            <div class="col-lg-6">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <br>
    <div class=" con-w3l">
        <div class="col-md">
            <div class="col-m">
                <?= $this->session->flashdata('message'); ?>
                <img src="<?= base_url('assets/img/foto/') . $users['image']; ?>" class="img-responsive" style="width:100%;" alt="">
                <div class="card-body">
                    <h3 class="card-title"><?= $users['name']; ?></h3>
                    <p class="card-text">email : <?= $users['email']; ?></p>
                    <p class="card-text">Alamat : <?= $users['address']; ?></p>
                    <p class="card-text">Nama Pasar : <?= $edit['nama_pasar']; ?></p>
                    <p class="card-text">No Lapak : <?= $users['no_lapak']; ?></p>
                    <p class="card-text">No Telp : <?= $users['no_telp']; ?></p>
                    <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $users['date_created']); ?></small></p>
                </div>
                <a href="<?= base_url('penjual/edit_profile_penjual'); ?>" class="btn btn-success" style="margin-bottom:5px;">Edit Profile</a>
                <a href="<?= base_url('penjual/changePassword'); ?>" class="btn btn-success">Ganti Password</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <br>
    <br>
</div>
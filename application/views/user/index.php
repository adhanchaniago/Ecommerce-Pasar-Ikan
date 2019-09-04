<!-- Carousel Buka-->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= base_url('assets/img/gambar/'); ?>ba.jpg" class="d-block w-100" alt="first-slide">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('assets/img/gambar/'); ?>ba1.jpg" class="d-block w-100" alt="second-slide">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('assets/img/gambar/'); ?>ba2.jpeg" class="d-block w-100" alt="third-slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- /.carousel tutup -->

<!--content-->
<div class="content-top">
    <div class="container">
        <div class="spec">
            <h3>Produk Ikan</h3>
            <div class="ser-t">
                <b></b>
                <span><i></i></span>
                <b class="line"></b>
            </div>
        </div>
        <div class="row" style="margin:auto;">
            <?php foreach ($barang as $b) : ?>
                <div class="col-md-4 m-wthree">
                    <div class="col-m">
                        <img src="<?= base_url('assets/img/barang/') . $b['image_barang'] ?>" class="img-fluid" alt="" style="height:150px;width:250px;">
                        <div class="mid-1">
                            <div class="women">
                                <p style="font-size:16px;"><b><?= $b['nama_barang'] ?></b></p>
                                <h6>Stock : <?php $stock = json_decode($b['stock_barang'], true);
                                            if ($stock['satuan'] == 'kilo') {
                                                echo $stock['stok'] . ' Kg';
                                            } else {
                                                echo $stock['stok'] / 10 . ' Kg';
                                            }
                                            ?></h6>
                            </div>
                            <div class="mid-2">
                                <p><em class="item_price">Rp. <?= number_format($b['harga_barang'], 0, ',', '.'); ?></em> / Kg</p>
                                <div class="clearfix"></div>
                            </div>
                            <a href="<?= base_url('user/detail_barang_home/') . enkrip_url($b['id']); ?>" class="btn btn-warning">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
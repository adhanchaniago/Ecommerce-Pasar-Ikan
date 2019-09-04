<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Pencairan Dana</h3>
    </div>
</div>

<!--Isi -->
<div class="container-fluid">
    <br>
    <?= $this->session->flashdata('message'); ?>
    <div class=" con-w3l">
        <div class="col-md-8">
            <div class="col-m">
                <form action="<?= base_url('user/updateStatusPencairan') ?>" method="post">
                    <input type="hidden" name="idPesanan" value="<?= $users['idPesanan']; ?>">
                    <input type="hidden" name="jumlahPencairan" value="<?= $users['total']; ?>">
                    <div class="col-m" style="margin-bottom:10px;">
                        <div class="card-body" style="padding:5px;">
                            <h5><b>Total Biaya : Rp. <?= number_format($users['total'], 0, ',', '.') ?></b></h5>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="penerima"><b>Nama Penerima</b></label>
                        <input type="text" class="form-control" id="penerima" name="penerima" value="">
                        <?= form_error('penerima', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="rekening"><b>Nomor Rekening</b></label>
                        <input type="number" class="form-control" id="rekening" name="rekening" value="">
                        <?= form_error('rekening', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="bank"><b>Nama Bank</b></label>
                        <input type="text" class="form-control" id="bank" name="bank" value="">
                        <?= form_error('bank', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col text-center mt-2 mb-2">
                        <button type="submit" class="btn btn-primary">Cairkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <div class="table">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th style="font-size:12px;">ID Pencairan</th>
                    <th style="font-size:12px;">Nama User</th>
                    <th style="font-size:12px;">Nama Penerima</th>
                    <th style="font-size:12px;">Nomor Rekening</th>
                    <th style="font-size:12px;">Total Biaya</th>
                    <th style="font-size:12px;">Status</th>
                    <th style="font-size:12px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pesanan as $p) : ?>
                    <tr>
                        <th style="font-size:12px;"><?= $p['id']; ?></th>
                        <td style="font-size:12px;"><?= $p['id_user']; ?></td>
                        <td style="font-size:12px;"><?= $p['nama_penerima']; ?></td>
                        <td style="font-size:12px;"><?= $p['nomor_rekening']; ?></td>
                        <td style="font-size:12px;"><?= $p['jumlah_dana']; ?></td>
                        <td style="font-size:12px;"><?= $p['status']; ?></td>
                        <td>
                            <form action="<?= base_url('admin/dicairkan'); ?>" method="post">
                                <input type="hidden" id="id" name="id" value="<?= $p['id']; ?>">
                                <?php if ($p['status'] == 1) : ?>
                                    <button type="submit" class="btn btn-success">Cairkan</button>
                                <?php endif ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="col"><?= $pagination ?></div>
    </div>
</div>
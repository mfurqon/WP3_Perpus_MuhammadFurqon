<!-- Begin Page Content -->

<div class="container-fluid">

    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-message alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('pesan'); ?>
            <a href="<?= base_url('laporan/cetak_laporan_anggota'); ?>" class="btn btn-dark mb-3">
                <i class="fas fa-print"></i> Print
            </a>
            <a href="<?= base_url('laporan/laporan_anggota_pdf'); ?>" class="btn btn-warning mb-3">
                <i class="far fa-file-pdf"></i> Download PDF
            </a>
            <a href="<?= base_url('laporan/export_excel_anggota'); ?>" class="btn btn-success mb-3">
                <i class="far fa-file-excel"></i> Export ke Excel
            </a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Anggota</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tanggal Input</th>
                        <th scope="col">Role</th>
                        <th scope="col">Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $a = 1; foreach ($laporan as $l) : ?>
                        <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <td><?= $l['nama']; ?></td>
                            <td><?= $l['alamat']; ?></td>
                            <td><?= $l['email']; ?></td>
                            <td><?= date('d-m-Y', $l['tanggal_input']); ?></td>
                            <td><?= $l['role']; ?></td>
                            <td>
                                <img src="<?= base_url('assets/img/profile/' . $l['image']); ?>" alt="profile-image" style="width: 100px; height: 100px;">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- /.container-fluid -->
</div>

<!-- End of Main Content -->
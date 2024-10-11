<div class="container-fluid">

    <div class="row">
        <div class="col-lg-7">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('pesan'); ?>

            <a href="" class="btn btn-info mb-3" data-toggle="modal" data-target="#kategoriBaruModal">
                <i class="fas fa-file-alt"></i>
                Tambah Kategori
            </a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $a = 1;
                    foreach ($kategori as $k) : ?>

                        <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <td><?= $k['kategori']; ?></td>
                            <td>
                                <a href="<?= base_url('buku/ubahKategori/') . $k['id']; ?>" class="badge badge-success">
                                    <i class="fas fa-edit"></i>
                                    Ubah
                                </a>
                                <a href="<?= base_url('buku/hapusKategori/') . $k['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus kategori <?= $k['kategori']; ?> ?');" class="badge badge-danger">
                                    <i class="fas fa-trash"></i>
                                    Hapus
                                </a>
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

<!-- Modal Tambah Kategori Baru -->
<div class="modal fade" id="kategoriBaruModal" tabindex="-1" role="dialog" aria-labelledby="kategoriBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kategoriBaruModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="<?= base_url('buku/kategori'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="kategori" name="kategori" placeholder="Masukkan Kategori Baru" value="<?= set_value('kategori'); ?>">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-ban"></i>
                        Close
                    </button>
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-plus-circle"></i>
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Tambah -->
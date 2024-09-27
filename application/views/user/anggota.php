<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('pesan'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#anggotaBaruModal">
                <i class="fas fa-file-alt"></i>
                Anggota Baru
            </a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Tanggal Gabung</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $n = 1;
                    foreach ($anggota as $a) : ?>
                        <tr>
                            <th scope="row"><?= $n++; ?></th>
                            <td><?= $a['nama']; ?></td>
                            <td><?= $a['email']; ?></td>
                            <td><?= $a['role_id']; ?></td>
                            <td><?= date('Y-m-d', $a['tanggal_input']); ?></td>
                            <td>
                                <picture>
                                    <source srcset="" type="image/svg+xml">
                                    <img src="<?= base_url('assets/img/profile/') . $a['image']; ?>" class="img-fluid img-thumbnail" alt="profile image" style="max-width: 100px;">
                                </picture>
                            </td>
                            <td>
                                <a href="<?= base_url('user/ubahAnggota/') . $a['id']; ?>" class="badge badge-info">
                                    <i class="fas fa-edit"></i>
                                    Ubah
                                </a>
                                <a href="<?= base_url('user/hapusAnggota/') . $a['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus <?= 'anggota' . ' ' . $a['nama']; ?> ?');" class="badge badge-danger">
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

<!-- Modal Tambah Anggota Baru -->
<div class="modal fade" id="anggotaBaruModal" tabindex="-1" role="dialog" aria-labelledby="anggotaBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="anggotaBaruModalLabel">Tambah Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('user/anggota'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Masukkan Nama Anggota" value="<?= set_value('nama'); ?>">
                        <?= form_error('nama', '<small class="text-danger pl-3>', '</small>') ?>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukkan Email" value="<?= set_value('email'); ?>">
                        <?= form_error('email', '<small class="text-danger pl-3>', '</small>') ?>
                    </div>

                    <div class="form-group">
                        <select name="role" class="form-control form-control-user">
                            <option value="">Pilih Role</option>
                            <?php
                            foreach ($role as $r) : ?>
                                <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('role', '<small class="text-danger pl-3>', '</small>') ?>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukkan Password" value="<?= set_value('password'); ?>">
                        <?= form_error('password', '<small class="text-danger pl-3>', '</small>') ?>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-ban"></i>
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i>
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Tambah -->
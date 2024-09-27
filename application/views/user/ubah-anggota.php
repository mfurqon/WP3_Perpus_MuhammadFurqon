<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-9">
            <?= form_open_multipart('user/ubahAnggota/' . $anggota['id']); ?>
            <input type="hidden" name="id" value="<?= $anggota['id']; ?>">

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $anggota['email']; ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $anggota['nama']; ?>">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="role_id" class="col-sm-2 col-form-label">Ubah Role ID</label>
                <div class="col-sm-10">
                    <select name="role_id" class="form-control form-control-user">
                        <?php
                        foreach ($role as $r) : ?>
                            <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('role_id', '<small class="text-danger pl-3>', '</small>') ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2">Gambar</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile/') . $anggota['image']; ?>" alt="profile image" class="img-thumbnail">
                        </div>

                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label for="image" class="custom-file-label">Pilih File</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <button class="btn btn-dark" onclick="window.history.go(-1)">Kembali</button>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
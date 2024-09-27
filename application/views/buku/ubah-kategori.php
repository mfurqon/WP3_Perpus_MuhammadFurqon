<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-9">
            <?= form_open_multipart('buku/ubahKategori/' . $kategori['id']); ?>
            <input type="hidden" name="id" value="<?= $kategori['id']; ?>">

            <div class="form-group row">
                <label for="kategori" class="col-sm-2 col-form-label">Kategori Buku</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $kategori['kategori']; ?>">
                    <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <button class="btn btn-dark" onclick="window.history.go(-1)">Kembali</button>
                    <!-- <a href="<?= base_url('buku/kategori'); ?>" class="btn btn-dark">Kembali</a> -->
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
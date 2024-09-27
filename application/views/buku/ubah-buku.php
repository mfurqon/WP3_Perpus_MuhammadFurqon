<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-9">
            <?= form_open_multipart('buku/ubahBuku/' . $buku['id']); ?>
            <input type="hidden" name="id" value="<?= $buku['id']; ?>">

            <div class="form-group row">
                <label for="judul_buku" class="col-sm-2 col-form-label">Judul Buku</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="<?= $buku['judul_buku']; ?>">
                    <?= form_error('judul_buku', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="id_kategori" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <select name="id_kategori" id="id_kategori" class="form-control">
                        <?php foreach ($kategori as $k) : ?>
                            <option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- <input type="text" class="form-control" id="id_kategori" name="id_kategori" value="<?= $buku['id_kategori']; ?>"> -->
                    <?= form_error('id_kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?= $buku['pengarang']; ?>">
                    <?= form_error('pengarang', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $buku['penerbit']; ?>">
                    <?= form_error('penerbit', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?= $buku['tahun_terbit']; ?>">
                    <?= form_error('tahun_terbit', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="isbn" class="col-sm-2 col-form-label">ISBN</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="isbn" name="isbn" value="<?= $buku['isbn']; ?>">
                    <?= form_error('isbn', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="stok" name="stok" value="<?= $buku['stok']; ?>">
                    <?= form_error('stok', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="dipinjam" class="col-sm-2 col-form-label">Dipinjam</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="dipinjam" name="dipinjam" value="<?= $buku['dipinjam']; ?>">
                    <?= form_error('dipinjam', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="dibooking" class="col-sm-2 col-form-label">Dibooking</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="dibooking" name="dibooking" value="<?= $buku['dibooking']; ?>">
                    <?= form_error('dibooking', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2">Gambar</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/upload/') . $buku['image']; ?>" alt="book image" class="img-thumbnail">
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
                    <!-- <a href="<?= base_url('buku'); ?>" class="btn btn-dark">Kembali</a> -->
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
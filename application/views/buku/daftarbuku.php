<?= $this->session->flashdata('pesan'); ?>

<?php if ($this->session->flashdata('errors')) : ?>
    <div class="alert alert-message alert-danger" role="alert">
        <?= $this->session->flashdata('errors'); ?>
    </div>
<?php endif; ?>

<div style="padding: 25px;">
    <div class="x_panel">
        <div class="x_content">
            <!-- Tampilkan semua produk -->
            <div class="row">
                <!-- Looping Products -->
                <?php foreach ($buku as $buku) : ?>
                    <div class="col-md-2 col-md-3">
                        <div class="thumbnail" style="height: 500px;">
                            <img src="<?= base_url('assets/img/upload/'); ?><?= $buku->image; ?>" style="max-width: 100%; max-height: 100%; height: 300px; width: 200px;" alt="book-image">

                            <div class="caption">
                                <h5 style="min-height: 30px;"><?= $buku->pengarang; ?></h5>
                                <h5><?= $buku->penerbit; ?></h5>
                                <h5><?= substr($buku->tahun_terbit, 0, 4); ?></h5>
                                <p>
                                    <?php if ($buku->stok < 1) {
                                        echo "<i class='btn btn-outline-primary fas fw fa-shopping-cart'> Booking&nbsp;&nbsp 0</i>";
                                    } else {
                                        echo "<a class='btn btn-outline-primary fas fw fa-shopping-cart' href='" . base_url('booking/tambahBooking/' . $buku->id) . "'> Booking</a>";
                                    }
                                    ?>

                                    <a href="<?= base_url('home/detailBuku/' . $buku->id); ?>" class="btn btn-outline-warning fas fw fa-search"> Detail</a>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- End Looping -->
            </div>
        </div>
    </div>
</div>
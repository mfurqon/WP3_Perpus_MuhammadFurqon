<div class="container min-vh-100">

    <center>
        <table>
            <tr>
                <td>
                    <div class="table-responsive full-width">
                        <table class="table table-bordered table-striped table-hover" id="table-datatable">
                            <tr>
                                <th>No.</th>
                                <th>ID Booking</th>
                                <th>Tanggal Booking</th>
                                <th>ID User</th>
                                <th>Aksi</th>
                                <th>Denda / Buku / Hari</th>
                                <th>Lama Pinjam</th>
                            </tr>
                            <?php $no = 1; foreach ($pinjam as $p) : ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td>
                                        <a href="<?= base_url('pinjam/bookingDetail/' . $p['id_booking']); ?>" class="btn btn-link">
                                            <?= $p['id_booking']; ?>
                                        </a>
                                    </td>
                                    <td><?= $p['tgl_booking']; ?></td>
                                    <td><?= $p['id_user']; ?></td>
                                    <form action="<?= base_url('pinjam/pinjamAksi/' . $p['id_booking']); ?>" method="post">
                                        <td nowrap>
                                            <button class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-fw fa-cart-plus"></i> Pinjam
                                            </button>
                                        </td>
                                        <td>
                                            <input type="text" class="form-check-user rounded-sm" name="denda" id="denda" value="5000" style="width: 100px;">
                                            <?= form_error(); ?>
                                        </td>
                                        <td>
                                            <input type="text" class="form-check-user rounded-sm" name="lama" id="lama" value="3" style="width: 100px;">
                                            <?= form_error(); ?>
                                        </td>
                                    </form>
                                </tr>
                            <?php $no++; endforeach; ?>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <a href="<?= base_url('pinjam/daftarBooking'); ?>" class="btn btn-link">
                        <i class="fas fa-fw fa-refresh"></i> Refresh
                    </a>
                </td>
            </tr>
        </table>
    </center>

</div>
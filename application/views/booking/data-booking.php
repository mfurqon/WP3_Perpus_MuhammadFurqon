<div class="container">
    <center>
        <table>
            <tr>
                <td>
                    <div class="table-responsive full-width">
                        <table class="table table-bordered table-striped table-hover" id="table-datatable">
                            <tr>
                                <th>No.</th>
                                <th>Buku</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                                <th>Pilihan</th>
                            </tr>
                            <?php 
                            $no = 1;
                            foreach ($temp as $t) :
                            ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td>
                                    <img src="<?= base_url('assets/img/upload/' . $t['image']); ?>" alt="No Picture" class="rounded" width="10%">
                                </td>
                                <td nowrap><?= $t['penulis']; ?></td>
                                <td nowrap><?= $t['penerbit']; ?></td>
                                <td nowrap><?= substr($t['tahun_terbit'], 0, 4); ?></td>
                                <td nowrap>
                                    <a href="<?= base_url('booking/hapusBooking/' . $t['id_buku']); ?>" onclick="return_konfirm('Yakin tidak jadi booking' . $t['judul_buku'])">
                                        <i class="btn btn-sm btn-outline-danger fas fw fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $no++; endforeach; ?>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <a href="<?= base_url(); ?>" class="btn btn-sm btn-outline-primary">
                        <span class="fas fw fa-play"></span> Lanjutkan booking buku
                    </a>
                    <a href="<?= base_url('booking/bookingSelesai/' . $this->session->userdata('id_user')); ?>" class="btn btn-sm btn-outline-success">
                        <span class="fas fw fa-stop"></span> Selesaikan booking
                    </a>
                </td>
            </tr>
        </table>
    </center>
</div>
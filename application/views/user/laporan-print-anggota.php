<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Cetak Anggota</title>
</head>

<body>
    <style type="text/css">
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data tr th,
        .table-data tr td {
            border: 1px solid black;
            font-size: 11pt;
            font-family: Verdana;
            padding: 10px;
        }

        .table-data th {
            background-color: grey;
        }

        h3 {
            font-family: Verdana;
        }
    </style>

    <h3>
        <center>LAPORAN DATA ANGGOTA</center>
    </h3>
    <br />
    <table class="table-data">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Tanggal Input</th>
                <th>Role</th>
                <th>Gambar</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($laporan as $l) : ?>
                <tr>
                    <td scope="row"><?= $no++; ?></td>
                    <td><?= $l['nama']; ?></td>
                    <td><?= $l['alamat']; ?></td>
                    <td><?= $l['email']; ?></td>
                    <td><?= $l['tanggal_input']; ?></td>
                    <td><?= $l['role']; ?></td>
                    <td>
                        <img src="<?= base_url('assets/img/profile/' . $l['image']); ?>" alt="profile-image" style="width: 100px; height: 100px;">
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
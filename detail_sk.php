<?php
session_start();
include "./database.php";
include '_header.php';
    if (isset($_POST['nomor']) && !empty($_POST['nomor'])) {
        // Ambil ID dari POST
        $id = $_POST['nomor'];
    
        // Query untuk mengambil data berdasarkan ID
        $query = "SELECT * FROM data_sk WHERE id = $id";
        $result = mysqli_query($db_conn, $query);
    
        if ($result) {
            // Ambil satu baris data
            $data = mysqli_fetch_assoc($result);
        } else {
            echo "Gagal mengambil data.";
            exit; // Keluar dari script jika terjadi kesalahan
        }
    } else {
        echo "ID tidak valid.";
        exit; // Keluar dari script jika ID tidak valid
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail SK</title>
</head>
<body>
    <style>
.button-group {
    display: flex;
    gap: 10px;
}

.inline-form {
    display: inline; 
}
</style>

    <div class="container mt-4">
    <h2>Detail Data SK</h2>
    <table class="table">
        <tbody>
            <tr>
                <th>Nama</th>
                <td><?php echo $data['nama']; ?></td>
            </tr>
            <tr>
                <th>NIP</th>
                <td><?php echo $data['NIP']; ?></td>
            </tr>
            <tr>
                <th>Pekerjaan</th>
                <td><?php echo $data['pangkat']; ?></td>
            </tr>
            <tr>
                <th>Instansi</th>
                <td><?php echo $data['kantor']; ?></td>
            </tr>
            <tr>
                <th>Gaji Saat ini</th>
                <td><?php echo 'Rp. ' . number_format($data['gaji'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Gaji Yang di ajukan</th>
                <td><?php echo 'Rp. ' . number_format($data['gaji_baru'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Tanggal Pengajuan</th>
                <td><?php echo $data['tanggal']; ?></td>
            </tr>
            <tr>
                <th>Tanggal Mulai berlaku gaji lama</th>
                <td><?php echo $data['tanggal_mulai']; ?></td>
            </tr>
            <tr>
                <th>Tanggal Mulai berlaku gaji baru</th>
                <td><?php echo $data['mulai_tanggal_baru']; ?></td>
            </tr>
            <tr>
                <th>Masa Kerja untuk gaji baru</th>
                <td><?php echo $data['berdasarkan_masa_kerja']; ?></td>
            </tr>
        </tbody>
    </table>
    <div class="button-group">
    <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#lihatModal">
        Lihat Tanda terima gaji lama
    </button>

    <form method="post" action="./print/" class="inline-form" onsubmit="return confirm('Apakah anda yakin ingin mencetak SK?');">
        <input type="hidden" name="nomor" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-primary">Cetak Surat SK</button>
    </form>

    <button type="button" class="btn btn-warning">Cetak Tanda proses</button>

    <form method="post" action="./hapus_sk.php" class="inline-form" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data?');">
    <input type="hidden" name="hapus" value="<?php echo $id; ?>">
    <button type="submit" class="btn btn-danger">HAPUS DATA</button>
</form>

</div>

    <!-- Modal -->
    <div class="modal fade" id="lihatModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 800px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lihatFotoModalLabel">Lihat Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="<?php echo $data['tanda_terima_gaji']; ?>" style="max-width: 750px;" class="img-fluid" alt="Foto Bukti Pembayaran">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<?php
session_start();
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
  include "./database.php";
  include '_header.php';
?>

  <div class="container">
    <h2>Konfigurasi</h2>
    <hr>
    <?php

    if (isset($_REQUEST['submit'])) {
      $cfgID = $_REQUEST['cfgID'];
      $cfgsekolah = $_REQUEST['cfgSekolah'];
      $cfgTgl = $_REQUEST['cfgTanggal'] . ' ' . $_REQUEST['cfgJam'];
      $cfgabout = $_REQUEST['cfgabout'];
      $cfgcontact = $_REQUEST['cfgcontact'];
      $cfgnopesformat1 = trim($_REQUEST['cfgnopesformat']);
      $cfglogo = $_FILES['cfglogo']['name'];
      $cfgkepsek = $_REQUEST['cfgkepsek'];
      $cfgnip = $_REQUEST['cfgnip'];
      $cfgno_surat = $_REQUEST['cfgno_surat'];
      $cfgttd = $_FILES['cfgttd']['name'];
      $cfgkop = $_FILES['cfgkop']['name'];
      $cfgcap = $_FILES['cfgcap']['name'];

      $nopes_ke1 = substr($cfgnopesformat1, 0, 5);

      $nopes_ke6 = substr($cfgnopesformat1, 5);

      $angkanopes = array('0', '1', '2', '3', '4', '5', '6', '7', '8');
      $cfgnopesformat2 = str_replace($angkanopes, "9", $nopes_ke6);
  
      $cfgnopesformat = trim($nopes_ke1 . $cfgnopesformat2);

      

        if($cfgttd != "") {
          $x = explode('.', $cfgttd); 
          $ekstensi = strtolower(end($x));
          $file_tmp = $_FILES['cfgttd']['tmp_name'];   
          $nama_png    = "ttd.png";
          $nama_jpg    = "ttd.jpg";
            if($ekstensi == 'png') {
              move_uploaded_file($file_tmp, './img/'.$nama_png ); //memindah file gambar ke folder gambar
                $ttd = "$nama_png";
                  
            } else if($ekstensi == 'jpg') {
              move_uploaded_file($file_tmp, './img/'.$nama_jpg); //memindah file gambar ke folder gambar
                $ttd = "$nama_jpg";
            }else{
              {     
                //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                $ttd = $hsl['ttd'];
                    echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='konfigurasi.php';</script>";
                }
            }
        }else{
          $ttd = $hsl['ttd'];
        }
      //------------------- akhir cek TTD

              //cek dulu jika merubah gambar cap jalankan coding ini
              if($cfgcap != "") {
                $x = explode('.', $cfgcap); //memisahkan nama file dengan ekstensi yang diupload
                $ekstensi = strtolower(end($x));
                $file_tmp = $_FILES['cfgcap']['tmp_name'];   
                $nama_png    = "cap1.png";
                  if($ekstensi == 'png') {
                    move_uploaded_file($file_tmp, '../img/'.$nama_png ); //memindah file gambar ke folder gambar
                      $cap = "$nama_png";
                  }else{
                    {     
                     
                      $cap = $hsl['cap'];
                          echo "<script>alert('Ekstensi gambar yang boleh hanya PNG dan transparan');window.location='konfigurasi.php';</script>";
                      }
                  }
              }else{
                $cap = $hsl['cap'];
              }
            //------------------- akhir cek CAP

            //cek dulu jika merubah gambar KOP Surat jalankan coding ini
            if($cfgkop != "") {
              $x = explode('.', $cfgkop); //memisahkan nama file dengan ekstensi yang diupload
              $ekstensi = strtolower(end($x));
              $file_tmp = $_FILES['cfgkop']['tmp_name'];   
              $nama_png    = "kopsurat1.png";
              $nama_jpg    = "kopsurat1.jpg";
                if($ekstensi == 'png') {
                  move_uploaded_file($file_tmp, './img/'.$nama_png ); //memindah file gambar ke folder gambar
                    $kop = "$nama_png";

                  } else if($ekstensi == 'jpg') {
                    move_uploaded_file($file_tmp, './img/'.$nama_jpg); //memindah file gambar ke folder gambar
                      $ttd = "$nama_jpg";
                }else{
                  {     
                    //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                    $kop = $hsl['kop'];
                        echo "<script>alert('Ekstensi gambar yang boleh untuk Kop Suarat hanya PNG dan JPG');window.location='konfigurasi.php';</script>";
                    }
                }
            }else{
              $kop = $hsl['kop'];
            }
          //------------------- akhir cek CAP
      


      //------------------------------------------

        //cek dulu jika merubah gambar logo jalankan coding ini
        if($cfglogo != "") {
          $ekstensi_diperbolehkan = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
          $x = explode('.', $cfglogo); //memisahkan nama file dengan ekstensi yang diupload
          $ekstensi = strtolower(end($x));
          $file_tmp = $_FILES['cfglogo']['tmp_name'];   
          $nama_gambar_baru = 'logo sekolah-'.$cfglogo; //menggabungkan angka acak dengan nama file sebenarnya
          if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
            //menghapus gambar lama
              unlink('../img/'.$hsl['logo']);
              move_uploaded_file($file_tmp, './img/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
              $logo ="$nama_gambar_baru";  
                sleep(2);
          } else {     
            //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
              echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='konfigurasi.php';</script>";
          }
        }else{
          $logo= $hsl['logo'];
        }
      //--------------------
      
      //Menjalankan Queri Edit tanpa update logo
      $qCfg = "UPDATE un_konfigurasi SET sekolah='$cfgsekolah', kepsek='$cfgkepsek', nip='$cfgnip', no_surat='$cfgno_surat',ttd='$ttd',cap='$cap',kop='$kop',about='$cfgabout',tgl_pengumuman='$cfgTgl',contact='$cfgcontact',nopesformat='$cfgnopesformat', logo='$logo' WHERE id='$cfgID'";
      $upCfg = mysqli_query($db_conn, $qCfg);
      sleep(2);
                                // periska query apakah ada error
                                if(!$upCfg){
                                  die ("Query gagal dijalankan: ".mysqli_errno($db_conn).
                                      " - ".mysqli_error($db_conn));
                              } else {
                                //tampil alert dan akan redirect ke halaman index.php
                                //silahkan ganti index.php sesuai halaman yang akan dituju
                                echo "<script>alert('Data berhasil diperbarui...');window.location='konfigurasi.php';</script>";
                              }
    }

    $qconfig = mysqli_query($db_conn, "SELECT * FROM un_konfigurasi");
    $hsl = mysqli_fetch_array($qconfig);
    ?>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
      <input type="hidden" name="cfgID" value="<?= $hsl['id'] ?>">

      <div class="form-group">
      <label class="col-sm-3 control-label"></label>
      </div>

      <fieldset>
        <legend>Konfigurasi Surat</legend>     
        <div class="form-group">
              <label class="col-sm-3 control-label">Nama Bupati</label>
              <div class="col-sm-4">
                <input type="text" name="cfgkepsek" class="form-control" value="<?= $hsl['kepsek'] ?>" readonly>
                <i style="float: left;font-size: 11px;"></i>
              </div>
        </div>
        <div class="form-group">
              <label class="col-sm-3 control-label">Nomor Surat</label>
              <div class="col-sm-4">
                <input type="text" name="cfgno_surat" class="form-control" value="<?= $hsl['no_surat'] ?>" readonly>
                <i style="float: left;font-size: 11px;">Nomor surat keterangan</i>
              </div>
        </div>
        <div class="form-group">
              <label class="col-sm-3 control-label">Tanda Tangan</label>
              <div class="col-sm-4">
                <img src="./img/<?= $hsl['ttd'] ?>" style="width: 100px;float: left;margin-bottom: 5px;">
                <input type="file" name="cfgttd" class="form-control" disabled />
                <i style="float: left;font-size: 11px;"></i>
              </div>
        </div>
        <div class="form-group">
              <label for="cap" class="col-sm-3 control-label">Cap/stempel  </label>
              <div class="col-sm-4">
                <img src="./img/<?= $hsl['cap'] ?>" style="width: 100px;float: left;margin-bottom: 5px;">
                <input type="file" name="cfgcap" id="cap" class="form-control" disabled />
                <i style="float: left;font-size: 11px;">Cap/stempel format gambar PNG </i>
              </div>
        </div>
      </fieldset> 
      
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="submit" name="submit" class="btn btn-primary" disabled="disabled">Simpan</button>
          <button type="button" id="btEnable" class="btn btn-primary">Edit</button>
        </div>
      </div>
    </form>
    
  </div>
  <script>
    $('button[name="submit"]').prop('disabled', true);
    $('#btEnable').click(function() {
      $('input[name="cfglogo"]').removeAttr('disabled');
      $('input[name="cfgttd"]').removeAttr('disabled');
      $('input[name="cfgkop"]').removeAttr('disabled');
      $('input[name="cfgcap"]').removeAttr('disabled');
      $("input").removeAttr('readonly','disable');
      $("textarea").removeAttr('readonly');
      $('button[name="submit"]').removeAttr('disabled');
    });
  </script>
<?php
  include '_footer.php';
} else {
  header('Location: ./login.php');
}
?>
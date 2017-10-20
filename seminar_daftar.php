<?php
  require_once "core/init.php";
  require_once "view/header_daftar.php";
  error_reporting(0);

  if(!$_SESSION['user']){
    header("Location: seminar_jadwal.php");
  }else{

  $super_user = $admin = $login = false;
  if($_SESSION['user']){
    $login = true;
    if(cek_status($_SESSION['user']) == 2){
      $super_user = true;
    }

    if(cek_status($_SESSION['user']) == 1){
      $admin = true;
    }
  }

  $error = '';
  $user = $_SESSION['user'];
  $id = $_GET['id'];

  if (isset($_GET['id'])) {
    $view_edit_seminar = tampilkan_per_id($id);
    while ($row = mysqli_fetch_assoc($view_edit_seminar)) {
      $judul_daftar  = $row['seminar'];
      $id_seminar    = $row['id_seminar'];
      $fakultas      = $row['fakultas'];
      $prodis        = $row['prodi'];
    }
  }

  $tbl_peserta    = tampilkan_data_peserta_id($id);
  while ($row = mysqli_fetch_assoc($tbl_peserta)) {
    $nims = $row['nim'];
  }

  if(isset($_POST['submit'])){
    $nim        = $_POST['nim'];
    $nama       = $_POST['nama'];
    $kelas      = $_POST['kelas'];
    $semester   = $_POST['smtr'];
    $telpon     = $_POST['telp'];
    ($super_user === true || $admin === true) ? $status = $_POST['status'] : $status = 'Belum Lunas';
    $keterangan = $_POST['ket'];
    $fakultas   = $fakultas;
    $prodis     = $prodis;
    $prodi      = $_POST['prodi'];

    if($super_user === true || $admin === true){
      if($nim != ''){
        $tbl_mahasiswa = tampilkan_mahasiswa_admin($nim);
        while ($row = mysqli_fetch_assoc($tbl_mahasiswa)) {
          $id_mahasiswa = $row['id_mahasiswa'];
        }
      }
    }else{
      $tbl_mahasiswa = tampilkan_mahasiswa($user);
      while ($row = mysqli_fetch_assoc($tbl_mahasiswa)) {
        $id_mahasiswa = $row['id_mahasiswa'];
      }
    }
    $id_mahasis = $id_mahasiswa;

    if(!empty(trim($nim)) && !empty(trim($nama)) && !empty(trim($kelas)) && !empty(trim($semester)) && !empty(trim($telpon)) && !empty(trim($keterangan)) && !empty(trim($status)) && !empty(trim($prodi)) && !empty(trim($id_mahasis))){

      if($nim === $_SESSION['user'] || $super_user === true || $admin === true){
        //if($nim === $nim_peserta){

          if ($nims != $nim) {
            if(tambah_data_peserta_seminar($nim,$nama,$kelas,$semester,$telpon,$status,$keterangan,$fakultas,$prodi,$id,$id_mahasis)){
              echo '<div id="tampil_modal">
                      <div id="modal">
                        <h5>BERHASIL !!</h5>
                        <h6>Anda Berhasil Mendaftar Seminar Dengan Tema " "'.$judul_daftar.'" "</h6>
                        <a href="seminar_peserta.php?id='.$id.'" class="btn btn-success center-block">OKE</a>
                      </div>
                    </div>';
            }else{
              $error = 'Ada Masalah Saat Menambah Data Peserta Seminar';
            }

          }else{
            $error = 'Nim Sudah Terdaftar';
          }

        //}else{
        //  $error = 'Nim Tidak Terdaftar Sebagai Mahasiswa';
        //}

      }else{
        $error = 'Nim Tidak Terdaftar Sebagai Mahasiswa';
      }

    }else{
      $error = 'Semua data Wajib Di Isi...';
    }
  }
?>

<div class="menu">

  <nav class="navbar navbar-default">
    <div class="container">

      <div class="navbar-header" style="height:80px","padding:10px">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-hide" style="margin-top:22px">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="index.php" class="navbar-brand btn-home" style="padding:10px">
          <img src="image/image-login/logo.png" class="img-rounded img-responsive" alt="Brand" width="60px"/>
        </a>
      </div>

      <div class="collapse navbar-collapse" id="menu-hide">
        <ul class="nav navbar-right navbar-nav list-menu" style="margin-top:10px">
          <?php if($super_user == true) : ?>
            <li><a href="seminar_admin.php" class="active">Dashboard</a></li>
          <?php endif; ?>
          <li><a href="seminar_jadwal.php" class="active">Jadwal Seminar</a></li>
          <li><a href="#" class="">Tentang</a></li>
          <?php if($login == true) : ?>
          <li><a href="seminar_logout.php" class="#">Logout</a></li>
          <?php else: ?>
          <li><a href="seminar_login.php" class="#">Login</a></li>
          <?php endif; ?>
        </ul>
      </div>

    </div>
  </nav>

  <div class="fluid-header">
    <div class="container">
      <div class="row rows">
        <div class="col-sm-12 col-md-12">
          <h1 class="text-center">Pendaftaran Peserta Seminar</h1>
          <p class="text-center lead">
            Tema : <?= $judul_daftar; ?>
          </p>
        </div>
        <div class="text-center">
          <a href="seminar_jadwal.php" class="btn btn-default">Kembali</a>
        </div>
      </div>

    </div>
  </div>

  <div class="fluid-center" id="form_tambah">
    <div class="container">
      <form class="col-md-offset-2 col-md-8" action="" method="post">
        <?php if($error): ?>
          <div class="alert alert-danger">
            <?= $error; ?>
          </div>
        <?php endif; ?>

        <div class="form-group form-group-lg">
          <label for="nim">Nim</label>
            <input type="text" class="form-control input-lg" name="nim" placeholder="Nomor Induk Mahasiswa" value="">
        </div>

        <div class="form-group form-group-lg">
          <label for="nama">Nama Lengkap</label>
          <input type="text" class="form-control input-lg" name="nama" placeholder="Masukan Nama Anda" value="">
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group form-group-lg">
              <label for="kelas">Kelas</label>
              <input type="text" class="form-control input-lg" name="kelas" placeholder="contoh : '08TPLPI'" value="">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group form-group-lg">
              <label for="smtr">Semester</label>
              <select class="form-control input-lg" name="smtr">
                <option value="">== Pilih Semester ==</option>
                <option value="1">Semester 1</option>
                <option value="2">Semester 2</option>
                <option value="3">Semester 3</option>
                <option value="4">Semester 4</option>
                <option value="5">Semester 5</option>
                <option value="6">Semester 6</option>
                <option value="7">Semester 7</option>
                <option value="8">Semester 8</option>
                <option value="9">Semester 9</option>
                <option value="10">Semester 10</option>
                <option value="11">Semester 11</option>
                <option value="12">Semester 12</option>
                <option value="13">Semester 13</option>
                <option value="14">Semester 14</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group form-group-lg">
              <label for="telp">No. Telephone/Handphone</label>
              <input type="tel" class="form-control input-lg" name="telp" placeholder="Masukan Nomor Telephone/Hp Anda" value="">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group form-group-lg">
              <label for="" class="control-label">Keterangan</label>
              <div class="radio has-success">
                <label class="radio-inline input-lg">
                  <input type="radio" name="ket" value="Hadir" checked="checked"> <strong>Hadir</strong>
                </label>

                <label class="radio-inline input-lg">
                  <input type="radio" name="ket" value="Tidak Hadir"> <strong>Tidak Hadir</strong>
                </label>
              </div>
            </div>
          </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="fakultas">Fakultas</label>
                <select name="fakultas" class="form-control input-lg">
                  <option value="<?= $fakultas; ?>"><?= $fakultas; ?></option>
                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="prodi">Prodi</label>
                <select name="prodi" class="form-control input-lg">
                  <?php if($prodis === 'T. Elektro [S1]'): ?>
                    <option value="T. Elektro [S1]">T. Elektro [S1]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'T. Mesin [S1]'): ?>
                    <option value="T. Mesin [S1]">T. Mesin [S1]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'T. Kimia [S1]'): ?>
                    <option value="T. Kimia [S1]">T. Kimia [S1]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'T. Industri [S1]'): ?>
                    <option value="T. Industri [S1]">T. Industri [S1]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'T. Informatika [S1]'): ?>
                    <option value="T. Informatika [S1]">T. Informatika [S1]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'Ilmu Hukum [S1]'): ?>
                    <option value="Ilmu Hukum [S1]">Ilmu Hukum [S1]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'Magister Hukum [S2]'): ?>
                    <option value="Magister Hukum [S2]">Magister Hukum [S2]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'Sastra Indonesia [S1]'): ?>
                    <option value="Sastra Indonesia [S1]">Sastra Indonesia [S1]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'Sastra Inggris [S1]'): ?>
                    <option value="Sastra Inggris [S1]">Sastra Inggris [S1]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'Akutansi [D3]'): ?>
                    <option value="Akutansi [D3]">Akutansi [D3]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'Akutansi [S1]'): ?>
                    <option value="Akutansi [S1]">Akutansi [S1]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'Sekretaris [D3]'): ?>
                    <option value="Sekretaris [D3]">Sekretaris [D3]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'Manajemen [S1]'): ?>
                    <option value="Manajemen [S1]">Manajemen [S1]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'Magister Manajemen [S2]'): ?>
                    <option value="Magister Manajemen [S2]">Magister Manajemen [S2]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'Matematika [S1]'): ?>
                    <option value="Matematika [S1]">Matematika [S1]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'Pendidikan Ekonomi [S1]'): ?>
                    <option value="Pendidikan Ekonomi [S1]">Pendidikan Ekonomi [S1]</option>
                  <?php endif; ?>
                  <?php if($prodis === 'Pendidikan Pancasila dan Kewarganegaraan [S1]'): ?>
                    <option value="Pendidikan Pancasila dan Kewarganegaraan [S1]">Pendidikan Pancasila dan Kewarganegaraan [S1]</option>
                  <?php endif; ?>
                </select>
              </div>
            </div>

            <?php if($super_user === true || $admin === true): ?>
              <div class="col-md-12">
                <div class="form-group form-group-lg">
                  <label for="Status Pembayaran">Status Pembayaran</label>
                  <select name="status" class="form-control input-lg">
                    <option value="">== Pilih Status Pembayaran ==</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas">Belum Lunas</option>
                  </select>
                </div>
              </div>
            <?php endif; ?>

            <div class="col-sm-12">
              <input type="submit" class="btn btn-block btn-lg btn-primary" name="submit" value="DAFTAR">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="wrap-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-6">
          <p>
            &copy aldi gunawan 2017
          </p>
        </div>

        <div class="col-sm-6 col-md-6">
          <p class="text-right">
            [ ] dengan <span>❤</span> di tangerang selatan
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  require_once "view/footer.php"
?>

<?php } ?>

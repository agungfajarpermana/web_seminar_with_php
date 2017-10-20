<?php
  require_once "core/init.php";
  require_once "view/header_edit.php";

  if(!$_SESSION['user']){
    header("Location: seminar_jadwal.php");
  }else{

    $super_user = $super_admin = $admin = $login = false;
    if($_SESSION['user']){
      $login = true;
      if(cek_status($_SESSION['user']) == 2){
        $super_user = true;
        $super_admin = true;
      }

      if(cek_status($_SESSION['user']) == 1){
        $admin = true;
      }
    }

  $error = '';

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $view_edit_seminar = tampilkan_per_id($id);
    while ($row = mysqli_fetch_assoc($view_edit_seminar)) {
      $judul_edit     = $row['seminar'];
      $tanggal_edit   = $row['tanggal'];
      $desk_edit      = $row['deskripsi'];
      $tiket_edit     = $row['kuota'];
      $htm_edit       = $row['harga'];
      $bicara_edit    = $row['pembicara'];
      $fakul_edit     = $row['fakultas'];
      $prodi_edit     = $row['prodi'];
      $lokasi_edit    = $row['lokasi'];
    }
  }

  if (isset($_POST['submit'])) {
    $judul      = $_POST['tema'];
    $pembicara  = $_POST['bicara'];
    $deskripsi  = $_POST['deskripsi'];
    $tanggal    = $_POST['tgl'];
    $tiket      = $_POST['kuota'];
    $htm        = $_POST['harga'];
    $fakultas   = ($super_admin == true) ? $_POST['fakultas'] : $fakul_edit;
    $prodi      = $_POST['prodi'];
    $lokasi     = $_POST['lokasi'];
    $file 		  = $_FILES['file']['name'];
		$ukuran 	  = $_FILES['file']['size'];
		$error  	  = $_FILES['file']['error'];
		$asal 		  = $_FILES['file']['tmp_name'];

    $format = pathinfo($file, PATHINFO_EXTENSION);

    if (empty(trim($file))) {

      if (!empty(trim($judul)) && !empty(trim($pembicara)) && !empty(trim($tanggal)) && !empty(trim($tiket)) && !empty(trim($htm)) && !empty(trim($fakultas)) && !empty(trim($prodi)) && !empty($lokasi)) {

        if (edit_data_seminar($judul, $tanggal, $deskripsi, $tiket, $htm, $pembicara, $fakultas, $prodi, $lokasi, $id)) {

          echo '<div id="tampil_modal">
                  <div id="modal">
                    <h5>BERHASIL !!</h5>
                    <h6>Anda Berhasil Merubah Data Seminar</h6>
                    <a href="seminar_jadwal.php" class="btn btn-success center-block">OKE</a>
                  </div>
                </div>';

        }else{
          $error = "Ada Masalah Saat Mengedit Data Seminar";
        }

      }else{
        $error = "Semua Data Harus Di Isi..";
      }

    }else{

		if (!empty(trim($judul)) && !empty(trim($pembicara)) && !empty(trim($tanggal)) && !empty(trim($tiket)) && !empty(trim($htm)) && !empty(trim($file)) && !empty(trim($fakultas)) && !empty(trim($prodi)) && !empty($lokasi)) {

      if ($error === 0) {

        if ($ukuran <= 5000000) {

          if ($format === 'jpg' || $format === 'png') {

            if (edit_gambar_data_seminar($judul, $pembicara, $tanggal, $tiket, $htm, $file, $fakultas, $prodi, $lokasi, $id)) {

              move_uploaded_file($asal, "image/image/" .$file);
              echo '<div id="tampil_modal">
                      <div id="modal">
                        <h5>BERHASIL !!</h5>
                        <h6>Anda Berhasil Merubah Data Seminar</h6>
                        <a href="seminar_jadwal.php" class="btn btn-success center-block">OKE</a>
                      </div>
                    </div>';

        			}else{
        				$error = "Ada Masalah Saat Merubah Data Seminar";
        			}

            }else{
              $error = "File Yang Dimasukan Harus JPG atau PNG";
            }

        }else{
          $error = "Ukuran File Terlalu Besar";
        }

      }else{
        $error = "Ada Masalah Saat Upload Gambar Seminar";
      }

		}else{
			$error = "Semua Data Harus Di isi";
		}
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
          <?php if($super_user === true): ?>
            <li><a href="seminar_admin.php" class="active">Dashboard</a></li>
          <?php endif; ?>
          <li><a href="seminar_jadwal.php" class="active">Jadwal Seminar</a></li>
          <li><a href="index.php #wrap-about" class="">Tentang</a></li>
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
          <h1 class="text-center">Ubah Jadwal Seminar</h1>
          <p class="text-center lead">
            <?= $judul_edit; ?>
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
      <form class="col-md-offset-2 col-md-8" action="" method="post" enctype="multipart/form-data">
        <?php if($error != ''): ?>
        <div class="alert alert-danger" style="margin-top: -20px;">
          <?= $error; ?>
        </div>
        <?php endif; ?>

        <div class="form-group">
          <label for="tema">Tema/Judul Seminar</label>
          <input type="text" class="form-control input-lg" name="tema" placeholder="Tema/Judul" value="<?= $judul_edit; ?>">
          <!--<span class="help-block">username tidak boleh kosong</span>-->
        </div>

        <div class="form-group">
          <label for="bicara">Pembicara</label>
          <input type="text" class="form-control input-lg" name="bicara" placeholder="Tema/Judul" value="<?= $bicara_edit; ?>">
          <!--<span class="help-block">username tidak boleh kosong</span>-->
        </div>

        <div class="form-group">
          <label for="deskripsi">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="5" placeholder="Deskripsi Seminar"><?= $desk_edit; ?></textarea>
        </div>

        <div class="form-group">
          <label for="tgl">Tanggal Pelaksanaan</label>
          <input type="date" class="form-control input-lg" name="tgl" placeholder="Tanggal" value="<?= $tanggal_edit; ?>">
          <!--<span class="help-block">password tidak boleh kosong</span>-->
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="kuota">Jumlah Tiket</label>
              <input type="text" class="form-control input-lg" name="kuota" placeholder="jumlah Tiket" value="<?= $tiket_edit; ?>">
              <!--<span class="help-block">password tidak boleh kosong</span>-->
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="harga">Harga Tiket Masuk</label>
              <input type="text" class="form-control input-lg" name="harga" placeholder="HTM" value="<?= $htm_edit; ?>">
              <!--<span class="help-block">password tidak boleh kosong</span>-->
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="file">File input</label>
          <input type="file" name="file" value="">
        </div>

        <?php if($super_admin == true): ?>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="fakultas">Fakultas</label>
                <select name="fakultas" class="form-control input-lg">
                  <option value="<?= $fakul_edit; ?>"><?= $fakul_edit; ?></option>
                </select>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group form-group-lg">
              <label for="prodi">Prodi</label>
              <select name="prodi" class="form-control input-lg">
                <option value="<?= $prodi_edit; ?>"><?= $prodi_edit; ?></option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="lokasi">Lokasi</label>
          <textarea name="lokasi" class="form-control input-lg" rows="8"><?= $lokasi_edit; ?></textarea>
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-block btn-lg btn-primary" name="submit" value="PUBLISH">
        </div>
      </form>
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

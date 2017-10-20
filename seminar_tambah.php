<?php
  require_once "core/init.php";
  require_once "view/header_tambah.php";

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
  $users = $_SESSION['user'];
  $id_admin = tampilkan_id_admin($users);
  while ($row = mysqli_fetch_assoc($id_admin)) {
    $id       = $row['id_admin'];
    $fakultas = $row['fakultas'];
    $prodis   = $row['prodi'];
  }

  if (isset($_POST['submit'])) {
    $id;
    $judul      = $_POST['tema'];
    $pembicara  = $_POST['bicara'];
    $deskripsi  = $_POST['deskripsi'];
    $tanggal    = $_POST['tgl'];
    $tiket      = $_POST['tiket'];
    $htm        = $_POST['htm'];
    $fakultas   = ($super_admin == true) ? $_POST['fakultas'] : $fakultas;
    $prodis     = $prodis;
    $prodi      = $_POST['prodi'];
    $lokasi     = $_POST['lokasi'];
    $file 		  = $_FILES['file']['name'];
		$ukuran 	  = $_FILES['file']['size'];
		$error  	  = $_FILES['file']['error'];
		$asal 		  = $_FILES['file']['tmp_name'];

    $format = pathinfo($file, PATHINFO_EXTENSION);

		if (!empty(trim($judul)) && !empty(trim($pembicara)) && !empty(trim($tanggal)) && !empty(trim($tiket)) && !empty(trim($htm)) && !empty(trim($file)) && !empty(trim($fakultas)) && !empty(trim($prodi)) && !empty(trim($lokasi))) {

      if ($error === 0) {

        if ($ukuran <= 5000000) {

          if ($format === 'jpg' || $format === 'png') {

            if (tambah_data_seminar($judul,$pembicara,$deskripsi,$tanggal,$tiket,$htm,$file,$fakultas,$prodi,$lokasi,$id)) {

              move_uploaded_file($asal, "image/image/" .$file);
              echo '<div id="tampil_modal">
                      <div id="modal">
                        <h5>BERHASIL !!</h5>
                        <h6>Anda Berhasil Menambahkan Daftar Seminar"</h6>
                        <a href="seminar_jadwal.php" class="btn btn-success center-block">OKE</a>
                      </div>
                    </div>';

      			}else{
      				$error = "Ada Masalah Saat Menambah Data Seminar";
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
          <?php if($super_user === true) :?>
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
          <h1 class="text-center">Tambah Jadwal Seminar</h1>
          <p class="text-center lead">
            silahkan anda mengisi form data jadwal seminar
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
      <form class="col-md-offset-2 col-md-8" action="#" method="post" enctype="multipart/form-data">
        <?php if($error) : ?>
          <div class="alert alert-danger">
            <?= $error; ?>
          </div>
        <?php endif; ?>

        <div class="form-group">
          <label for="tema">Tema/Judul Seminar</label>
          <input type="text" class="form-control input-lg" name="tema" placeholder="Tema/Judul" value="">
        </div>

        <div class="form-group">
          <label for="bicara">Pembicara</label>
          <input type="text" class="form-control input-lg" name="bicara" placeholder="Pembicara Seminar" value="">
        </div>

        <div class="form-group">
          <label for="deskripsi">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="5" placeholder="Deskripsi Seminar"></textarea>
        </div>

        <div class="form-group">
          <label for="tgl">Tanggal Pelaksanaan</label>
          <input type="date" class="form-control input-lg" name="tgl" placeholder="Tanggal" value="">
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="tiket">Jumlah Tiket</label>
              <input type="text" class="form-control input-lg" name="tiket" placeholder="jumlah Tiket" value="">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="htm">Harga Tiket Masuk</label>
              <input type="text" class="form-control input-lg" name="htm" placeholder="HTM" value="">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="file">File input</label>
          <input type="file" name="file" value="">
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group form-group-lg">
              <label for="fakultas">Fakultas</label>
              <select name="fakultas" class="form-control input-lg">
                <option value="<?= $fakultas; ?>"><?= $fakultas; ?></option>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group form-group-lg">
              <label for="prodi">Prodi</label>
              <select name="prodi" class="form-control input-lg">
                <?php if($super_admin != true): ?>
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
                  <?php if($prodis === 'Pendidikan Pancasila [S1]'): ?>
                    <option value="Pendidikan Pancasila dan Kewarganegaraan [S1]">Pendidikan Pancasila dan Kewarganegaraan [S1]</option>
                  <?php endif; ?>
                <?php else: ?>
                  <option value="T. Elektro [S1]">T. Elektro [S1]</option>
                  <option value="T. Mesin [S1]">T. Mesin [S1]</option>
                  <option value="T. Kimia [S1]">T. Kimia [S1]</option>
                  <option value="T. Industri [S1]">T. Industri [S1]</option>
                  <option value="T. Informatika [S1]">T. Informatika [S1]</option>
                  <option value="Ilmu Hukum [S1]">Ilmu Hukum [S1]</option>
                  <option value="Magister Hukum [S2]">Magister Hukum [S2]</option>
                  <option value="Sastra Indonesia [S1]">Sastra Indonesia [S1]</option>
                  <option value="Sastra Inggris [S1]">Sastra Inggris [S1]</option>
                  <option value="Akutansi [D3]">Akutansi [D3]</option>
                  <option value="Akutansi [S1]">Akutansi [S1]</option>
                  <option value="Sekretaris [D3]">Sekretaris [D3]</option>
                  <option value="Manajemen [S1]">Manajemen [S1]</option>
                  <option value="Magister Manajemen [S2]">Magister Manajemen [S2]</option>
                  <option value="Matematika [S1]">Matematika [S1]</option>
                  <option value="Pendidikan Ekonomi [S1]">Pendidikan Ekonomi [S1]</option>
                  <option value="Pendidikan Pancasila dan Kewarganegaraan [S1]">Pendidikan Pancasila dan Kewarganegaraan [S1]</option>
                <?php endif; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="lokasi">Lokasi</label>
          <textarea name="lokasi" class="form-control" rows="10" placeholder="Lokasi Seminar"></textarea>
        </div>

        <input type="submit" class="btn btn-block btn-lg btn-primary" name="submit" value="PUBLISH">
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

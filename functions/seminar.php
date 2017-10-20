<?php
  function tampilkan(){
    global $link;

    $query  = "SELECT * FROM tb_seminar ORDER BY id_seminar DESC LIMIT 2";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data");

    return $result;
  }

  function tampilkan_mahasiswa($user){
    global $link;

    $query  = "SELECT * FROM tb_mahasiswa WHERE nim=$user";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Peserta");

    return $result;
  }

  function tampilkan_mahasiswa_admin($nim){
    global $link;

    $query  = "SELECT * FROM tb_mahasiswa WHERE nim=$nim";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Pesertas");

    return $result;
  }

  function tampilkan_jumlah_peserta(){
    global $link;

    $query  = "SELECT * FROM tb_peserta";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Jumlah Peserta");
    $total  = mysqli_num_rows($result);

    return $total;
  }

  function tampilkan_total_seminars(){
    global $link;

    $query  = "SELECT * FROM tb_seminar";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Jumlah Seminar");
    $total  = mysqli_num_rows($result);

    return $total;
  }

  function tampilkan_data_nim($user){
    global $link;

    $query  = "SELECT * FROM tb_mahasiswa WHERE username='$user'";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Mahasiswa '".$user."'");

    return $result;
  }

  function tampilkan_per_id($id){
    global $link;

    $query  = "SELECT * FROM tb_seminar WHERE id_seminar=$id";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Edit Seminar");

    return $result;
  }

  function tampilkan_data_peserta_id($id){
    global $link;

    $query  = "SELECT * FROM tb_peserta WHERE id_seminar=$id";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Edit Seminar");

    return $result;
  }

  function tampilkan_per_fakultas($prodi){
    global $link;

    $query  = "SELECT * FROM tb_seminar WHERE prodi='$prodi' ORDER BY id_seminar DESC LIMIT 2";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Seminar Berdasarkan Fakultas '".$fakultas."'");

    return $result;
  }

  function tampilkan_data_seminar($start,$perPage,$prodi){
    global $link;

    $query  = "SELECT * FROM tb_seminar WHERE prodi='$prodi' ORDER BY id_seminar DESC LIMIT $start,$perPage";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data");

    return $result;
  }

  function tampilkan_data_seminar_admin($start,$perPage){
    global $link;

    $query  = "SELECT * FROM tb_seminar ORDER BY id_seminar DESC LIMIT $start,$perPage";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data");

    return $result;
  }

  function tampilkan_jumlah_seminar($fakultas){
    global $link;

    $query  = "SELECT * FROM tb_seminar WHERE fakultas='$fakultas' ORDER BY id_seminar DESC";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data");
    $total  = mysqli_num_rows($result);

    return $total;
  }

  function tampilkan_jumlah_seminars(){
    global $link;

    $query  = "SELECT * FROM tb_seminar ORDER BY id_seminar DESC";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data");
    $total  = mysqli_num_rows($result);

    return $total;
  }

  function tampilkan_peserta($start,$perPage){
    global $link;

    $query = "SELECT * FROM tb_peserta LIMIT $start, $perPage";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Seluruh Peserta Seminar");

    return $result;
  }

  function tampilkan_peserta_seminar(){
    global $link;

    $query = "SELECT * FROM tb_peserta";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Peserta Seminar");
    $total = mysqli_num_rows($result);

    return $total;
  }

  function tampilkan_data_peserta($id,$start,$perPage){
    global $link;

    $query  = "SELECT tb_peserta.id_peserta,tb_peserta.nim,tb_peserta.nama,tb_peserta.semester,tb_peserta.kelas,tb_peserta.telpon,tb_peserta.status,tb_peserta.keterangan,tb_peserta.fakultas,tb_peserta.prodi,tb_seminar.seminar FROM tb_peserta
               INNER JOIN tb_seminar ON tb_peserta.id_seminar = tb_seminar.id_seminar WHERE tb_peserta.id_seminar=$id ORDER BY tb_peserta.id_peserta DESC LIMIT $start,$perPage";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Peserta Seminar");

    return $result;
  }

  function tampilkan_data_peserta_daftar($id){
    global $link;

    $query  = "SELECT tb_peserta.nim,tb_peserta.nama,tb_peserta.semester,tb_peserta.kelas,tb_peserta.telpon,tb_peserta.status,tb_peserta.keterangan,tb_peserta.fakultas,tb_peserta.prodi,tb_peserta.id_seminar,tb_seminar.seminar FROM tb_peserta
              INNER JOIN tb_seminar ON tb_peserta.id_seminar = tb_seminar.id_seminar WHERE tb_peserta.id_peserta=$id";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Peserta Daftar Seminar");

    return $result;
  }

  function tampilkan_semua_data_peserta($id){
    global $link;

    $query  = "SELECT tb_peserta.nim,tb_peserta.nama,tb_peserta.semester,tb_peserta.kelas,tb_peserta.telpon,tb_peserta.keterangan,tb_peserta.fakultas,tb_peserta.prodi,tb_peserta.id_seminar,tb_seminar.seminar FROM tb_peserta
               INNER JOIN tb_seminar ON tb_peserta.id_seminar = tb_seminar.id_seminar WHERE tb_peserta.id_seminar=$id";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Semua Peserta Seminar");
    $total  = mysqli_num_rows($result);

    return $total;
  }

  function tampilkan_admin($start,$perPage){
    global $link;

    $query  = "SELECT * FROM tb_admin WHERE level=1 LIMIT $start,$perPage";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Daftar Admin");

    return $result;
  }

  function tampilkan_id_admin($users){
    global $link;

    $query  = "SELECT * FROM tb_admin WHERE username='$users'";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data id admin");

    return $result;
  }

  function tampilkan_data_admin(){
    global $link;

    $query  = "SELECT * FROM tb_admin WHERE level=1";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Daftar Admin");
    $total  = mysqli_num_rows($result);

    return $total;
  }

  function tampilkan_data_edit_admin($id){
    global $link;

    $query = "SELECT * FROM tb_admin WHERE id_admin = $id";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Edit Admin");

    return $result;
  }

  function tampilkan_edit_peserta($id){
    global $link;

    $query = "SELECT * FROM tb_peserta WHERE id_peserta=$id";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Edit Peserta");

    return $result;
  }

  function tampilkan_hasil_cari($cari,$start,$perPage){
    global $link;

    $query = "SELECT * FROM tb_admin WHERE nama LIKE '%$cari%' LIMIT $start,$perPage";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Hasil Cari Nama Admin");

    return $result;
  }

  function tampilkan_hasil_cari_peserta($cari,$start,$perPage){
    global $link;

    $query = "SELECT * FROM tb_peserta WHERE nim LIKE '%$cari%' LIMIT $start,$perPage";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Hasil Cari Peserta Seminar");

    return $result;
  }

  function tampilkan_total_admin($cari){
    global $link;

    $query = "SELECT * FROM tb_admin WHERE nama LIKE '%$cari%'";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Total Admin");
    $total = mysqli_num_rows($result);

    return $total;
  }

  function tampilkan_total_peserta($cari){
    global $link;

    $query = "SELECT * FROM tb_peserta WHERE nim LIKE '%$cari%'";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Total Peserta");
    $total = mysqli_num_rows($result);

    return $total;
  }

  function tampilkan_data_by($tag,$start,$perPage){
    global $link;

    $query = "SELECT * FROM tb_admin WHERE prodi='$tag' LIMIT $start,$perPage";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan data '".$tag."'");

    return $result;
  }

  function tampilkan_data_peserta_by($tag,$start,$perPage){
    global $link;

    $query = "SELECT * FROM tb_peserta WHERE prodi='$tag' LIMIT $start,$perPage";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Peserta Tag '".$tag."'");

    return $result;
  }

  function tampilkan_data_admin_by($tag){
    global $link;

    $query = "SELECT * FROM tb_admin WHERE prodi='$tag'";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan data '".$tag."'");
    $total = mysqli_num_rows($result);

    return $total;
  }

  function tampilkan_data_peserta_seminar_by($tag){
    global $link;

    $query = "SELECT * FROM tb_peserta WHERE prodi='$tag'";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Total Data Peserta Tag '".$tag."'");
    $total = mysqli_num_rows($result);

    return $total;
  }

  function tampilkan_seminar_peserta($users){
    global $link;

    $query  = "SELECT * FROM tb_mahasiswa WHERE nim='$users'";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Mahasiswa '".$users."'");

    return $result;
  }

  function tampilkan_seminar($users){
    global $link;

    $query  = "SELECT * FROM tb_mahasiswa WHERE username='$users'";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Mahasiswa '".$users."'");

    return $result;
  }

  function tampilkan_seminar_admin($users){
    global $link;

    $query  = "SELECT * FROM tb_admin WHERE username='$users'";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Mahasiswa '".$users."'");

    return $result;
  }

  function tampilkan_seminar_admins($users){
    global $link;

    $query  = "SELECT * FROM tb_admin WHERE username='$users'";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Data Admin '".$users."'");

    return $result;
  }

  function hasil_cari($id,$cari){
    global $link;

    $query  = "SELECT tb_peserta.id_peserta,tb_peserta.nim,tb_peserta.nama,tb_peserta.semester,tb_peserta.kelas,tb_peserta.telpon,tb_peserta.keterangan,tb_peserta.fakultas,tb_peserta.prodi,tb_peserta.status,tb_seminar.seminar FROM tb_peserta
               INNER JOIN tb_seminar ON tb_peserta.id_seminar = tb_seminar.id_seminar WHERE tb_peserta.id_seminar=$id AND tb_peserta.nim LIKE '%$cari%'";
    $result = mysqli_query($link, $query) or die("Gagal Menampilkan Hasil Cari");

    return $result;
  }

  function tambah_data_seminar($judul,$pembicara,$deskripsi,$tanggal,$tiket,$htm,$file,$fakultas,$prodi,$lokasi,$id){
    $query = "INSERT INTO tb_seminar (seminar, tanggal, deskripsi, kuota, harga, gambar, pembicara, fakultas, prodi, lokasi, id_admin) VALUES ('$judul', '$tanggal', '$deskripsi', '$tiket', '$htm', '$file', '$pembicara', '$fakultas', '$prodi', '$lokasi', '$id')";
    return run($query);
  }

  function tambah_data_peserta_seminar($nim,$nama,$kelas,$semester,$telpon,$status,$keterangan,$fakultas,$prodi,$id,$id_mahasis){
    $query = "INSERT INTO tb_peserta (nim, nama, semester, kelas, telpon, status, keterangan, fakultas, prodi, id_seminar, id_mahasiswa) VALUES ('$nim', '$nama', '$semester', '$kelas', '$telpon', '$status', '$keterangan', '$fakultas', '$prodi', '$id', '$id_mahasis')";
    return run($query);
  }

  function tambah_data_admin($user,$pass,$nama,$email,$telpon,$level,$fakultas,$prodi){
    $query = "INSERT INTO tb_admin (username, password, nama, email, telpon, level, fakultas, prodi) VALUES ('$user', '$pass', '$nama', '$email', '$telpon', '$level', '$fakultas', '$prodi')";
    return run($query);
  }

  function tambah_data_peserta($nim, $nama, $semester, $kelas, $telpon, $status, $ket, $fakultas, $prodi, $id_seminar){
    $query = "INSERT INTO tb_peserta (nim, nama, semester, kelas, telpon, status, keterangan, fakultas, prodi, id_seminar) VALUES ('$nim', '$nama', '$kelas', '$semester', '$telpon', '$status', '$ket', '$fakultas', '$prodi', '$id_seminar')";
    return run($query);
  }

  function edit_data_seminar($judul, $tanggal, $deskripsi, $tiket, $htm, $pembicara, $fakultas, $prodi, $lokasi, $id){
    $query = "UPDATE tb_seminar SET seminar='$judul', tanggal='$tanggal', deskripsi='$deskripsi', kuota='$tiket', harga='$htm', pembicara='$pembicara', fakultas='$fakultas', prodi='$prodi', lokasi='$lokasi' WHERE id_seminar='$id'";
    //die($query);
    return run($query);
  }

  function edit_gambar_data_seminar($judul, $pembicara, $tanggal, $tiket, $htm, $file, $fakultas, $prodi, $lokasi, $id){
    $query = "UPDATE tb_seminar SET seminar='$judul', pembicara='$pembicara', tanggal='$tanggal', kuota='$tiket', harga='$htm', gambar='$file', fakultas='$fakultas', prodi='$prodi', lokasi='$lokasi' WHERE id_seminar='$id'";
    return run($query);
  }

  function edit_data_admin($user, $pass, $nama, $email, $telpon, $level, $fakultas, $prodi, $id){
    $query = "UPDATE tb_admin SET username='$user', password='$pass', nama='$nama', email='$email', telpon='$telpon', fakultas='$fakultas', prodi='$prodi' WHERE id_admin='$id'";
    return run($query);
  }

  function edit_data_peserta($nim, $nama, $semester, $kelas, $telpon, $status, $ket, $fakultas, $prodi, $id_seminar, $id){
    $query = "UPDATE tb_peserta SET nim='$nim', nama='$nama', semester='$semester', kelas='$kelas', telpon='$telpon', status='$status', keterangan='$ket', fakultas='$fakultas', prodi='$prodi', id_seminar='$id_seminar' WHERE id_peserta='$id'";
    return run($query);
  }

  function edit_data_peserta_daftar($nim,$nama,$kelas,$semester,$telpon,$keterangan,$fakultas,$prodi,$status,$id){
    $query = "UPDATE tb_peserta SET nim='$nim', nama='$nama', semester='$semester', kelas='$kelas', telpon='$telpon', keterangan='$keterangan', fakultas='$fakultas', prodi='$prodi', status='$status' WHERE id_peserta='$id'";
    return run($query);
  }

  function hapus_data_seminar_dan_peserta($id){
    //$query = "DELETE FROM tb_seminar WHERE id_seminar=$id";
    $query  = "DELETE tb_seminar,tb_peserta FROM tb_seminar INNER JOIN tb_peserta ON tb_peserta.id_seminar = tb_seminar.id_seminar WHERE tb_seminar.id_seminar=$id AND tb_peserta.id_seminar=$id";
    return run($query);
  }

  function hapus_data_seminar($id){
    $query = "DELETE FROM tb_seminar WHERE id_seminar=$id";
    return run($query);
  }

  function hapus_data_peserta($del){
    $query = "DELETE FROM tb_peserta WHERE id_peserta=$del";
    return run($query);
  }

  function hapus_data_admin($del){
    $query = "DELETE FROM tb_admin WHERE id_admin=$del";
    return run($query);
  }

  function hapus_data_daftar_peserta($del){
    $query = "DELETE FROM tb_peserta WHERE id_peserta=$del";
    return run($query);
  }

  function run($query){
    global $link;

    if (mysqli_query($link, $query)) return true;
    else return false;
  }
?>

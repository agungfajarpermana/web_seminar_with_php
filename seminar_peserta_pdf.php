<?php
require_once "core/init.php";
require_once "DOMPDF/dompdf/autoload.inc.php";

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$id = $_GET['id'];
global $link;
$query_  = "SELECT seminar FROM tb_seminar WHERE id_seminar='$id'";
$result_ = mysqli_query($link, $query_);
while ($row = mysqli_fetch_assoc($result_)) {
  $seminar = $row['seminar'];
}

$query  = "SELECT * FROM tb_peserta WHERE id_seminar='$id'";
$result = mysqli_query($link, $query);

$no = 1;
$output = '<style>
table{
  text-align: center;
}
thead{
  border: 1px solid black;
}
tbody:nth-child(odd){
  background-color: #dddddd;
}
h3,h1,h2,.tag{
  text-align: center;
}
.info{
  padding: 10px;
  float:right;
  font-weight: normal;
}
.infos{
  padding: 10px;
  float:right;
  margin-left: -17%;
  font-weight: normal;
}
</style>
<h3>YAYASAN SASMITA JAYA</h3>
<h2>UNIVERSITAS PAMULANG</h2>
<h3>Jalan Surya Kencana No. 1 Pamulang-Tangerang Selatan Telp: 021.7412566 Fax: 74709855 <br><br> TANGERANG SELATAN-BANTEN</h3>
<h4 class="tag">Daftar Peserta Seminar Tema: '.$seminar.'</h4>
<table border="1" width="100%">
  <thead>
    <tr>
    <th>NO</th>
    <th>NIM</th>
    <th>NAMA MHS</th>
    <th>SEMESTER</th>
    <th>KELAS</th>
    <th>NO. TELP</th>
    <th>FAKULTAS</th>
    <th>PRODI</th>
    <th>KET</th>
    <th>STATUS</th>
    </tr>
  </thead>';

while ($row = mysqli_fetch_assoc($result)) {
  $output .= '<tbody>
              <tr class="rainbow">
              <td>'.$no++.'</td>
              <td>'.$row['nim'].'</td>
              <td>'.$row['nama'].'</td>
              <td>'.$row['semester'].'</td>
              <td>'.$row['kelas'].'</td>
              <td>'.$row['telpon'].'</td>
              <td>'.$row['fakultas'].'</td>
              <td>'.$row['prodi'].'</td>
              <td>'.$row['keterangan'].'</td>
              <td>'.$row['status'].'</td>
              </tr>
              </tbody>';
}

$output .= '</table><br><br>';

$output .= '<h4 class="info">Ketua Program Seminar</h4>
            <br><br><br><br>
            <h4 class="infos">Aldi Zunaldi S.kom</h4>';
$dompdf->loadHtml($output);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Atangpros", array('Attachment' => 0));
// 1. = Download
// 0. = Preview*/
?>

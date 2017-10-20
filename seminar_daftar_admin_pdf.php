<?php
require_once "core/init.php";
require_once "DOMPDF/dompdf/autoload.inc.php";

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

global $link;
$query = "SELECT * FROM tb_admin";
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
h3,h1,h2{
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
<h4>Daftar Admin Seminar Kampus</h4>
<table border="1" width="100%">
  <thead>
    <tr>
      <th>NAMA</th>
      <th>EMAIL</th>
      <th>TELPHONE</th>
      <th>FAKULTAS</th>
      <th>PRODI</th>
    </tr>
  </thead>';

while ($row = mysqli_fetch_assoc($result)) {
  $output .= '<tbody>
              <tr class="rainbow">
                <td>'.$row['nama'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['telpon'].'</td>
                <td>'.$row['fakultas'].'</td>
                <td>'.$row['prodi'].'</td>
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
// 0. = Preview
?>

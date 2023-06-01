<?php
/*ob_start();*/
require "vendor/autoload.php";
require "function.php";
use Dompdf\Dompdf;
use Dompdf\Options;

$data= file_get_contents('img/logo-poltek.jpg');
$type= pathinfo('img/logo-poltek.jpg', PATHINFO_EXTENSION);
$logo = 'data:image/'. $type . ';base64,' . base64_encode($data);
$mahasiswa = ambil_akumulasi_mahasiswa($_GET['id']);

$date = date('d');
$month = date('m');
$year = date('Y');
$kompen = $mahasiswa['akumulasi'];
if ($kompen > 150) {
    $kompen = 10;
}else {
    $kompen = round(($mahasiswa['akumulasi'] * 4) / 50, 1);
}

$bulan = [
    '01'=> 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
];

$style = '<style>
        .container-header {
            width: 100vw;
            border-bottom: 2px double black;
        }
        .container-body{
            width: 100vw;
        }
        .container-body::after{
            content: "";
            clear: both;
            display: table;
        }
        .container-header::after {
            content: "";
            clear: both;
            display: table;
        }
        .f-left {
            float: left;
        }
        .f-right {
            float: right;
        }
        .text-center {
            text-align: center;
        }
        .fw-bold {
            font-weight: bolder;
        }
        .mb-0 {
            margin-bottom: 0;
        }
        .mt-0 {
            margin-top: 0;
        }
        .text-uppercase{
            text-transform: uppercase;
        }
    </style>';

$html = $style;
$html .= '<div class="container-header">
        <img src="'.$logo.'" alt="logo poltek" width="128" class="f-left">
        <p class="text-center mt-0 mb-0">KEMENTRIAN PENDIDIKAN, KEBUDAYAAN, <br> RISET DAN TEKNOLOGI</p>
        <p class="text-center fw-bold mt-0 mb-0">POLITEKNIK NEGERI SRIWIJAYA</p>
        <p class="text-center mt-0 mb-0">Jalan Srijaya Negara Bukit Besar  - Palembang 30139 Telepon (0711) 353414</p>
        <p class="text-center mt-0 mb-0">Laman: http://polsri.ac.id, Pos El : info@polsri.ac.id</p>
    </div>';

$html .= '<div class="container-body">
        <p class="text-uppercase text-center  mb-0">Surat Peringatan-2</p>
        <p class="text-center mt-0 mb-0">Nomor 0341/PL6.3.1/SP/2023</p>
        <p>Sesuai dengan Peraturan Direktur Politeknik Negeri Sriwijaya Nomor 1 Tahun 2018 tentang Peraturan Akademik dan Tata Tertib Mahasiswa Politeknik Negeri Sriwijaya
            dan Rekapitulasi Ketidak Hadiran Mahasiswa, maka Direktur Politeknik Negeri Sriwijaya Mengeluarkan <i>Surat Peringatan 2 (Kedua)</i> kepada
            <br>Mahasiswa :</p>
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>'. $mahasiswa['nama'].'</td>
            </tr>
            <tr>
                <td>NPM</td>
                <td>:</td>
                <td>'. $mahasiswa['npm'].'</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>'. $mahasiswa['kelas'].'</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>'. $mahasiswa['alamat'].'</td>
            </tr>
        </table>
        <p>Karena Mahasiswa tersebut telah tidak hadir selama '. round($mahasiswa['akumulasi'] / 60, 0) .' (Jam) tanpa pemberitahuan dan akan di berhentikan (Drop Out) jika jumlah kehaidran telah mencapai 29 (dua puluh sembilan) Jam/Semester.</p>
        <p>Kompensasi waktu '.$kompen.' (jam)</p>
        <p>Surat peringatan ini dikeluarkan untuk menjadi perhatian dan diharapkan agar orang tua/wali segera <br> menghubungi Ketua Jurusan terkait untuk mengklarifikasi masalah ini.</p>
        <div class="f-right">
            <p class="mt-0 mb-0">Palembang, '.$date.' '.$bulan[$month].' '. $year.'</p>
            <p class="mt-0 mb-0">a.n. Direktur</p>
            <p class="mt-0 mb-0">Wakil Direktur I,</p>
            <br>
            <br>
            <br>
            <br>
            <p class="mt-0 mb-0">Carlos RS, S.T.,M.T.</p>
            <p class="mt-0 mb-0">NIP 196403011989031003</p>
        </div>
    </div>';

$html .= '<div>
        <p>Tembusan:</p>
        <ol>
            <li> Ketua Jurusan Teknik Komputer</li>
            <li>Orang Tua/Wali Mahasiswa Bersangkutan</li>
            <li>Pembimbing Akademik</li>
            <li>Yang Bersangkutan</li>
        </ol>
    </div>';

$dompdf = new Dompdf();
$dompdfOption = new Options();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('cetak-sp-3.pdf');

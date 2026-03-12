<?php
// Load TCPDF library
require_once('tcpdf/tcpdf.php');

// Terima data dari JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// Buat PDF baru - perhatikan parameter UTF-8 untuk dukungan bahasa Indonesia
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set informasi dokumen
$pdf->SetCreator('Sistem Surat KPU');
$pdf->SetAuthor('KPU Kota Pekalongan');
$pdf->SetTitle('Surat ' . $data['letterType']);

// Hapus header dan footer default
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Set margin (kiri, atas, kanan) dalam mm
$pdf->SetMargins(20, 15, 15);
$pdf->SetAutoPageBreak(true, 25);

// Tambah halaman baru
$pdf->AddPage();

// Set font default (gunakan helvetica atau freesans untuk dukungan UTF-8)
$pdf->SetFont('helvetica', '', 12);

// Mulai konten HTML
$html = '';

// Buat HTML berdasarkan jenis surat (contoh sederhana)
if ($data['letterType'] == 'SURAT DINAS') {
    $html = '
    <h2 style="text-align: center;">KOMISI PEMILIHAN UMUM</h2>
    <h3 style="text-align: center;">KOTA PEKALONGAN</h3>
    <hr>
    <br>
    <table style="width: 100%;">
        <tr>
            <td style="width: 50%;">
                Nomor: ' . $data['nomor'] . '<br>
                Sifat: ' . $data['sifat'] . '<br>
                Lampiran: ' . $data['lampiran'] . '<br>
                Perihal: ' . $data['perihal'] . '
            </td>
            <td style="width: 50%; text-align: right;">
                ' . $data['alamatKantor'] . '<br>
                ' . $data['tanggal'] . '
            </td>
        </tr>
    </table>
    <br><br>
    <p>Yth. ........................................</p>
    <p style="margin-left: 30px;">Tempat</p>
    <br>
    <p style="text-indent: 1.27cm; text-align: justify;">' . nl2br($data['isi']) . '</p>
    <br><br>
    <div style="float: right; width: 45%; text-align: center;">
        ' . $data['inputJabatan'] . '<br>
        <div style="height: 60px;"></div>
        <u>' . $data['inputNamaTtd'] . '</u><br>
        NIP. ' . $data['inputNipTtd'] . '
    </div>
    ';
}

// Tulis HTML ke PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output PDF (D = download, I = inline di browser)
$pdf->Output('Surat_' . $data['letterType'] . '.pdf', 'D');
?>
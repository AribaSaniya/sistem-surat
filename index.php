<?php
// File: index.php
// Sistem Surat KPU 
// Set default timezone
date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Surat KPU (SPPD Final - 1 Lembar Depan & Belakang)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    
    <style>
        /* --- CSS DASAR dengan Font Tahoma untuk Semua --- */
        * { 
            box-sizing: border-box; 
            margin: 0; 
            padding: 0; 
        }
        body { 
            font-family: 'Tahoma', 'Arial', sans-serif;
            background: #c8dcf0; 
            color: #333; 
            padding-bottom: 30px; 
            min-height: 100vh; 
        }
        .container { 
            max-width: 1600px; 
            margin: 0 auto; 
            padding: 15px; 
        }
        
        /* HEADER YANG ELEGAN TANPA ANIMASI */
        header { 
            background: #5b8db8; 
            color: white; 
            padding: 15px 0; 
            border-bottom: 5px solid #f0b429; 
            margin-bottom: 25px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.2); 
        }
        
        .header-content { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            flex-wrap: wrap; 
            gap: 15px; 
        }
        
        /* Logo wrapper dengan desain premium */
        .logo-wrapper {
            background: white;
            padding: 8px 20px 8px 12px;
            border-radius: 50px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            display: inline-flex;
            align-items: center;
            gap: 12px;
            border: 2px solid #1e2a43;
        }
        
        .logo-wrapper img {
            height: 60px;
            width: 60px;
            object-fit: contain;
            border-radius: 50%;
            border: 2px solid #1e2a43;
        }
        
        .logo-wrapper:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        
        .logo-text {
            display: flex;
            flex-direction: column;
        }
        
        .logo-text .title {
            font-weight: 800;
            font-size: 1rem;
            color: #0a1f3a;
            line-height: 1.2;
        }
        
        .logo-text .subtitle {
            font-size: 0.6rem;
            color: #1e3a6f;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .logo-text .subtitle i {
            color: #1e2a43;
            margin-right: 5px;
        }
        
        /* Info header */
        .header-info {
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(0, 0, 0, 0.15); /* Latar belakang sedikit lebih gelap untuk kontras tinggi */
            padding: 6px 15px;
            border-radius: 40px;
            border: 1px solid rgba(255,255,255,0.25);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15); /* Bayangan abu kontainer */
        }
        
        .header-info-item {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #ffc107;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.4); /* Bayangan abu-abu pada teks agar sangat jelas dibaca */
        }
        
        .header-info-item i {
            font-size: 0.9rem;
            color: #ffc107;
        }
        
        .header-info-item span {
            font-size: 0.8rem;
            font-weight: 500;
            color: #ffc107;
        }
        
        .header-info-item .value {
            font-weight: 700;
            color: #ffc107;
            margin-left: 3px;
        }
        
        /* Tombol reset */
        .btn-secondary { 
            background: rgba(255,255,255,0.15); 
            color: white; 
            border: 2px solid #1e2a43; 
            border-radius: 40px;
            padding: 8px 25px;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 0.5px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-secondary:hover { 
            background: rgba(255,255,255,0.25); 
            border-color: #ffd966;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.25);
        }
        
        .btn-secondary i {
            font-size: 14px;
        }
        
        /* Statistik header */
        .header-stats {
            display: flex;
            gap: 10px;
            margin-left: auto;
        }
        
        .stat-item {
            text-align: center;
            background: rgba(255,255,255,0.1);
            padding: 5px 12px;
            border-radius: 10px;
            min-width: 60px;
            border: 1px solid rgba(255,255,255,0.1);
        }
        
        .stat-item .stat-value {
            font-size: 1.1rem;
            font-weight: 800;
            color: #1e2a43;
            line-height: 1;
        }
        
        .stat-item .stat-label {
            font-size: 0.55rem;
            text-transform: uppercase;
            opacity: 0.9;
        }
        
        /* TOMBOL YANG LEBIH MODERN */
        .btn { 
            border: none; 
            padding: 12px 25px; 
            border-radius: 40px; 
            cursor: pointer; 
            font-weight: 600; 
            transition: all 0.3s ease; 
            display: inline-flex; 
            align-items: center; 
            gap: 10px; 
            font-size: 14px; 
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            letter-spacing: 0.5px;
        }
        .btn-primary { 
            background: linear-gradient(135deg, #e74c3c, #c0392b); 
            color: white; 
            width: 100%; 
            justify-content: center; 
            margin-top: 20px; 
            font-size: 16px; 
            padding: 14px; 
            border-radius: 50px;
        }
        .btn-primary:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 10px 25px rgba(231, 76, 60, 0.4); 
        }
        .btn-add { 
            background: linear-gradient(135deg, #3498db, #2980b9); 
            color: white; 
            font-size: 13px; 
            margin-top: 10px; 
            width:100%; 
            justify-content: center; 
            padding: 12px; 
            border-radius: 30px;
        }
        .btn-add:hover { 
            background: linear-gradient(135deg, #2980b9, #1c6ea4); 
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }
        .btn-del { 
            background: #e74c3c; 
            color: white; 
            width: 32px; 
            height: 32px; 
            justify-content: center; 
            border-radius: 50%; 
            padding: 0; 
            font-size: 14px; 
            box-shadow: 0 3px 8px rgba(231, 76, 60, 0.3);
        }
        .btn-del:hover { 
            background: #c0392b; 
            transform: scale(1.1) rotate(90deg); 
        }

        /* GRID UTAMA - FORM DAN PREVIEW DIPERPANJANG */
        .main-grid { 
            display: grid; 
            grid-template-columns: 1.3fr 1.7fr; 
            gap: 25px; 
        }
        
        /* CARD FORM DENGAN DESAIN MODERN - DIPERPANJANG */
        .card { 
            background: white; 
            border-radius: 20px; 
            padding: 30px 10px 30px 30px; /* Kurangi padding kanan agar scrollbar dalam pas */
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.18), 0 5px 15px rgba(0, 0, 0, 0.08); /* Bayangan belakang lebih menonjol */
            border-left: 6px solid #54b4f5; /* Lekukan biru muda indah di ujung kiri luar form */
            border-right: 6px solid #54b4f5; /* Lekukan biru muda indah di ujung kanan luar form */
            max-height: 95vh; 
            min-height: 800px; 
            display: flex;
            flex-direction: column;
            overflow: hidden; /* Hapus overflow dari card luar agar border-right tidak terpotong scrollbar */
        }
        
        .card-scroll-content {
            overflow-y: auto;
            flex: 1;
            padding-right: 15px; /* Jarak scrollbar dari konten & border kanan */
            scrollbar-width: thin;
            scrollbar-color: #3498db #f0f0f0;
        }
        
        /* CUSTOM SCROLLBAR YANG ELEGAN */
        .card-scroll-content::-webkit-scrollbar, .preview-wrapper::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        .card-scroll-content::-webkit-scrollbar-track, .preview-wrapper::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 10px;
        }
        .card-scroll-content::-webkit-scrollbar-thumb, .preview-wrapper::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #3498db, #2980b9);
            border-radius: 10px;
        }
        
        /* FORM GROUP YANG LEBIH RAPI DENGAN SPACING LEBIH BESAR */
        .form-group { 
            margin-bottom: 22px; 
            position: relative; 
        }
        .form-group label { 
            display: block; 
            margin-bottom: 10px; 
            font-weight: 600; 
            font-size: 0.95rem; 
            color: #2c3e50; 
            letter-spacing: 0.3px;
        }
        input, select, textarea { 
            width: 100%; 
            padding: 14px 20px; 
            border: 2px solid #e8ecf2; 
            border-radius: 14px; 
            font-size: 14px; 
            transition: all 0.3s; 
            background: #f9fcff; 
        }
        input:hover, select:hover, textarea:hover {
            border-color: #b0c4de;
            background: white;
        }
        input:focus, select:focus, textarea:focus { 
            outline: none; 
            border-color: #3498db; 
            background: white; 
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.15); 
        }
        textarea { 
            resize: vertical; 
            min-height: 120px; 
        }
        .hidden { 
            display: none !important; 
        }

        /* SECTION DENGAN DESAIN ELEGAN - SPACING DIPERBESAR */
        .form-section { 
            background: linear-gradient(135deg, #f8faff, #f0f5ff); 
            padding: 25px; 
            border-radius: 18px; 
            border-left: 6px solid #54b4f5; 
            border-right: 6px solid #54b4f5; /* Lekukan biru muda simetris di sebelah kanan */
            margin-bottom: 25px; 
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            transition: all 0.3s;
        }
        .form-section:hover {
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.1);
        }
        .form-section-title { 
            color: #2c3e50; 
            font-size: 1.2rem; 
            margin-bottom: 22px; 
            display: flex; 
            align-items: center; 
            gap: 15px; 
            font-weight: 700;
            border-bottom: 2px dashed #cbd5e0;
            padding-bottom: 15px; 
        }
        .form-section-title i { 
            color: #3498db; 
            font-size: 1.4rem; 
            background: white;
            padding: 12px; 
            border-radius: 14px; 
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }

        /* --- Spesifik untuk textarea Isi Surat - DIPERBESAR --- */
        .form-group-isi-surat {
            margin-bottom: 25px; 
            position: relative;
        }
        
        .form-group-isi-surat label {
            display: flex;
            align-items: center;
            gap: 15px; 
            margin-bottom: 15px; 
            font-weight: 600;
            font-size: 1rem; 
            color: #2c3e50;
            background: linear-gradient(135deg, #e3f2fd, #d4e8fc);
            padding: 15px 20px; 
            border-radius: 14px; 
            border-left: 6px solid #2196f3; 
            border-right: 6px solid #2196f3; /* Lekukan biru simetris untuk label isi surat */
        }
        
        .form-group-isi-surat textarea {
            width: 100%;
            padding: 20px; 
            border: 2px solid #d4e8fc;
            border-radius: 14px; 
            font-size: 14px;
            line-height: 1.6;
            transition: all 0.3s;
            background: #ffffff;
            min-height: 250px; 
        }
        
        .form-group-isi-surat textarea:focus {
            border-color: #2196f3;
            box-shadow: 0 0 0 4px rgba(33, 150, 243, 0.15);
        }
        
        /* --- Form Tembusan Khusus - DIPERBESAR --- */
        .form-tembusan-section {
            background: linear-gradient(135deg, #fff7e6, #ffeed9);
            padding: 25px; 
            border-radius: 18px; 
            border-left: 6px solid #ff9800; 
            border-right: 6px solid #ff9800; /* Lekukan oranye simetris untuk tembusan */
            margin-bottom: 25px; 
        }
        
        .form-tembusan-title {
            color: #e65100;
            font-size: 1.2rem; 
            margin-bottom: 22px; 
            display: flex;
            align-items: center;
            gap: 15px; 
            font-weight: 700;
            border-bottom: 2px dashed #ffd5a4;
            padding-bottom: 15px; 
        }
        
        .form-tembusan-title i {
            color: #ff9800;
            background: white;
            padding: 12px; 
            border-radius: 14px; 
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }

        /* FORM HEADER SPPD DI KANAN - DESAIN LEBIH MENARIK DAN DIPERBESAR */
        .sppd-form-header-right {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 25px; 
        }
        
        .sppd-form-header-container {
            background: linear-gradient(135deg, #fef9e7, #fef5e0);
            border: 2px solid #ffc107;
            border-radius: 18px; 
            padding: 25px; 
            width: 100%;
            max-width: 500px; 
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.15);
        }
        
        .sppd-form-header-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px; 
        }
        
        .sppd-form-header-item {
            margin-bottom: 0;
        }
        
        .sppd-form-header-item label {
            font-size: 0.85rem; 
            margin-bottom: 8px; 
            color: #e67700;
            font-weight: 600;
            display: block;
        }
        
        .sppd-form-header-item input {
            background: white;
            border: 2px solid #ffe396;
            padding: 12px 15px; 
            border-radius: 12px; 
        }
        
        .sppd-form-header-item input:focus {
            border-color: #ff9800;
        }

        /* Form Grid untuk input berpasangan - DIPERBESAR */
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px; 
        }
        
        .form-grid-2 .form-group {
            margin-bottom: 0;
        }
        
        /* Form Grid untuk input 3 kolom - DIPERBESAR */
        .form-grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px; 
        }
        
        .form-grid-3 .form-group {
            margin-bottom: 0;
        }
        
        /* Label Number untuk Form - DESAIN LEBIH BAGUS DAN DIPERBESAR */
        .label-num { 
            background: linear-gradient(135deg, #3498db, #2980b9); 
            color: white; 
            padding: 6px 14px; 
            border-radius: 30px; 
            margin-right: 12px; 
            font-size: 0.85rem; 
            font-weight: 700;
            display: inline-block;
            min-width: 32px; 
            text-align: center;
            box-shadow: 0 3px 6px rgba(52, 152, 219, 0.3);
        }

        /* Info kecil untuk placeholder - DESAIN LEBIH ELEGAN DAN DIPERBESAR */
        .input-info {
            font-size: 0.85rem; 
            color: #6c757d;
            margin-top: 10px; 
            font-style: italic;
            display: flex;
            align-items: center;
            gap: 8px; 
            background: #f1f5f9;
            padding: 10px 18px; 
            border-radius: 30px;
        }
        
        .input-info i {
            color: #3498db;
            font-size: 1rem; 
        }

        /* Button container - DIPERPANJANG */
        .button-container {
            display: flex;
            flex-direction: column;
            gap: 15px; 
            margin-top: 30px; 
            position: sticky;
            bottom: 0;
            background: white;
            padding: 20px 0 10px 0; 
            border-top: 3px solid #eef2f6;
        }

        /* CARD PENANDATANGAN - DESAIN LEBIH MENARIK DAN DIPERBESAR */
        #general-sign-selector .form-section > div[style*="background: #e8f4f8"] {
            background: linear-gradient(135deg, #e3f2fd, #d4e8fc) !important;
            border: 2px solid #3498db !important;
            border-radius: 18px !important; 
            padding: 25px !important; 
            margin-top: 20px !important; 
        }
        
        #general-sign-selector .form-section > div[style*="background: #e8f4f8"] > div:first-child {
            background: white;
            padding: 10px 20px; 
            border-radius: 30px;
            color: #2c3e50;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px; 
            margin-bottom: 20px; 
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        /* PENGIKUT CONTAINER - DESAIN LEBIH BAGUS DAN DIPERBESAR */
        #pengikut-container-input > div {
            margin-bottom: 20px; 
            padding: 22px !important; 
            border: 2px solid #e8ecf2 !important;
            border-radius: 18px !important; 
            background: linear-gradient(135deg, #f9fcff, #f0f5ff) !important;
            transition: all 0.3s;
        }
        
        #pengikut-container-input > div:hover {
            border-color: #3498db !important;
            box-shadow: 0 8px 20px rgba(52, 152, 219, 0.1) !important;
        }
        
        #pengikut-container-input > div > div:first-child {
            background: white;
            padding: 10px 18px; 
            border-radius: 30px;
            margin-bottom: 18px; 
            font-size: 1rem; 
        }
        
        #pengikut-container-input input {
            background: white;
            border: 2px solid #e0e7f0;
            border-radius: 12px; 
            padding: 12px 16px; 
            font-size: 14px;
        }

        /* RADIO BUTTON UNTUK SPPD - DESAIN LEBIH MENARIK DAN DIPERBESAR */
        #sppd-page-toggle > div {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; 
            margin-top: 15px; 
        }
        
        #sppd-page-toggle label {
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 15px; 
            padding: 18px; 
            background: white;
            border-radius: 18px; 
            border: 2px solid #ffc107;
            flex: 1;
            min-width: 200px; 
            transition: all 0.3s;
        }
        
        #sppd-page-toggle label:hover {
            background: #fef9e7;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 193, 7, 0.2);
        }
        
        #sppd-page-toggle input[type="radio"] {
            width: 22px; 
            height: 22px; 
            accent-color: #e67700;
            margin: 0;
        }
        
        #sppd-page-toggle label > div > div:first-child {
            font-weight: bold;
            color: #e67700;
            font-size: 1.1rem; 
        }

        /* SELECT DENGAN CUSTOM ARROW */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 18px center; 
            background-size: 16px; 
        }

        /* PREVIEW AREA - TETAP SAMA */
        .preview-wrapper { 
            background: #c8dcf0; 
            padding: 20px; 
            border-radius: 20px; /* Diubah dari 16px agar lekukan sama persis dengan card di sebelah kirinya */
            overflow: auto; 
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.1);
            max-height: 95vh; 
            min-height: 800px; 
            scrollbar-width: thin;
            scrollbar-color: #3498db #c8dcf0;
        }
        
        /* Default A4 untuk semua surat */
        #letter-preview {
            background: white;
            width: 210mm; 
            min-height: 297mm;
            padding: 5mm 10mm 5mm 15mm; 
            margin: 0 auto;
            color: black;
            line-height: 1.4;
            position: relative;
            font-family: 'Tahoma', 'Arial', sans-serif !important; 
            font-size: 11pt;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        /* Ukuran F4 untuk SPPD */
        #letter-preview.sppd-preview {
            width: 215mm !important;
            min-height: 330mm !important;
            max-width: 215mm !important;
        }
        
        /* Halaman belakang SPPD: tidak paksa min-height agar tidak ada lembar kosong */
        #letter-preview.sppd-preview.sppd-belakang-active {
            min-height: auto !important;
            height: auto !important;
        }
        
        /* Margin bawah untuk tabel halaman belakang agar saat di-export PDF tetap ada margin tipis */
        #preview-sppd-belakang {
            padding-bottom: 5mm !important;
        }

        .padding-sppd { 
            padding: 5mm 10mm 5mm 15mm !important; 
        }
        
        /* Style khusus untuk SPPD halaman depan agar lebih rapat */
        .sppd-compact .sppd-header-right {
            margin-bottom: 8px;
        }
        
        .sppd-compact .sppd-title-main {
            margin-bottom: 12px;
            margin-top: 8px;
            font-size: 12pt;
        }
        
        .sppd-compact .sppd-table-front td {
            padding: 3px 5px;
            font-size: 10pt;
            line-height: 1.3;
        }
        
        .sppd-compact .signature-section {
            margin-top: 12px;
            width: 40%;
        }
        
        .sppd-compact .sign-spacer {
            height: 35px;
        }
        
        .sppd-compact .table-nested-8 td {
            padding: 2px 3px;
            font-size: 9.5pt;
        }
        
        .sppd-compact .nip-spacer {
            margin-top: 2px;
        }
        
        /* Style untuk space 2x enter di bawah PPK */
        .ppk-signature-spacer {
            height: 40px !important;
            width: 100%;
            display: block;
        }
        
        /* ===== STYLE KHUSUS UNTUK HALAMAN BELAKANG SPPD ===== */
        /* Container untuk setiap baris data dengan lebar tetap agar : sejajar */
        .sppd-data-row-fixed {
            display: flex;
            align-items: baseline;
            margin-bottom: 4px;
            width: 100%;
            min-height: 20px;
        }
        
        /* Label dengan lebar tetap 140px agar semua : sejajar */
        .sppd-label-fixed {
            min-width: 140px;
            font-weight: normal;
            white-space: normal;
            font-size: 9.5pt;
            line-height: 1.4;
        }
        
        /* Tanda titik dua dengan lebar tetap 15px */
        .sppd-separator-fixed {
            min-width: 15px;
            width: 15px;
            text-align: center;
            font-size: 9.5pt;
            line-height: 1.4;
        }
        
        /* Nilai/data mengisi sisa ruang */
        .sppd-value-fixed {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 9.5pt;
            line-height: 1.4;
            padding-left: 5px;
        }
        
        /* Untuk teks yang mungkin panjang dan perlu wrap */
        .sppd-value-fixed-wrap {
            flex: 1;
            white-space: normal;
            word-wrap: break-word;
            font-size: 9.5pt;
            line-height: 1.4;
            padding-left: 5px;
        }
        
        /* Container untuk area data dengan multiple rows */
        .sppd-data-area-fixed {
            display: flex;
            flex-direction: column;
            width: 100%;
            margin-bottom: 8px;
            flex: 1;
        }
        
        /* Style untuk header romawi */
        .sppd-roman-header-fixed {
            display: flex;
            align-items: flex-start;
            margin-bottom: 8px;
            font-weight: bold;
            width: 100%;
        }
        
        .sppd-roman-number-fixed {
            min-width: 25px;
            font-weight: bold;
            font-size: 10pt;
            line-height: 1.4;
        }
        
        /* Container untuk konten data */
        .sppd-data-content { 
            display: flex; 
            flex-direction: column; 
            height: 100%; 
        }
        
        .sppd-data-content .data-area { 
            flex: 1; 
            text-align: left; 
        }
        
        .sppd-data-content .signature-area { 
            margin-top: auto; 
            text-align: center; 
        }
        
        /* Style untuk teks-only (tanpa header romawi) */
        .sppd-text-only-fixed {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 1px;
            flex: 1;
            margin-left: 0;
            width: 100%;
        }
        
        /* Style untuk signature */
        .sppd-signature { 
            margin-top: 5px; 
            text-align: center !important; 
            padding-top: 3px; 
            display: flex; 
            flex-direction: column; 
            width: 100%; 
        }
        
        .sppd-signature .titik-ttd { 
            font-family: 'Tahoma', monospace !important; 
            letter-spacing: 1px; 
            font-size: 10pt; 
            margin-top: 30px; 
            margin-bottom: 2px !important; 
            text-align: center !important; 
            width: 100%; 
        }
        
        /* Style khusus untuk titik-titik di kolom kanan baris 2-5 */
        .sppd-signature .titik-ttd.kanan-turun {
            margin-top: 40px !important;
            margin-bottom: 2px !important;
        }
        
        /* Style khusus untuk titik-titik di kolom kiri baris 2-5 */
        .sppd-signature .titik-ttd.kiri-turun {
            margin-top: 40px !important;
            margin-bottom: 2px !important;
        }
        
        /* Style khusus untuk kolom SEKRETARIS (baris 1) - LANGSUNG NAMA SEKRETARIS TANPA TITIK-TITIK DENGAN JARAK SANGAT PANJANG */
        .sppd-signature.sekretaris-column {
            margin-top: 0px !important;
        }
        
        .sppd-signature.sekretaris-column .jabatan {
            margin-top: 0px !important; /* Margin atas diperkecil */
            margin-bottom: 75px !important; /* Jarak tanda tangan ditambahkan lebih banyak lagi */
            padding-bottom: 0 !important;
            line-height: 1.2 !important;
            font-size: 10pt !important;
            font-weight: normal !important;
            text-align: center !important;
        }
        
        .sppd-signature.sekretaris-column .nama {
            margin-top: 0px !important;
            margin-bottom: 8px !important;
            padding-bottom: 0 !important;
            line-height: 1.2 !important;
            font-size: 10pt !important;
            font-weight: bold;
            text-decoration: underline;
        }
        
        .sppd-signature.sekretaris-column .nip {
            margin-top: 0px !important;
            margin-bottom: 10px !important;
            padding-bottom: 0 !important;
            line-height: 1.2 !important;
            font-size: 10pt !important;
        }
        
        /* Sembunyikan titik-titik di kolom sekretaris */
        .sppd-signature.sekretaris-column .titik-ttd {
            display: none !important;
        }
        
        .sppd-signature .nama { 
            font-weight: bold; 
            text-decoration: underline; 
            margin-bottom: 1px !important; 
            padding-bottom: 0 !important;
            line-height: 1.2 !important;
            text-align: center !important; 
            width: 100%; 
            font-size: 10pt; 
        }
        
        .sppd-signature .nip { 
            margin-top: 1px !important; 
            margin-bottom: 2px !important;
            padding-bottom: 0 !important;
            line-height: 1.2 !important;
            text-align: center !important; 
            width: 100%; 
            font-size: 10pt; 
        }
        
        .sppd-signature-ppk { 
            margin-top: 0px !important; 
            text-align: center !important; 
            display: flex; 
            flex-direction: column; 
            width: 100%; 
            margin-bottom: 5px !important; 
        }
        
        .sppd-signature-ppk .jabatan-ppk { 
            font-weight: normal !important; 
            margin-bottom: 75px !important; /* Jarak ditambah agar ruang tanda tangan lebih luas */
            text-align: center !important; 
            width: 100%; 
            margin-top: 0px !important; 
            font-size: 10pt; 
            line-height: 1.2 !important; 
            padding-top: 0 !important;
        }
        
        .sppd-signature-ppk .space-ttd { 
            height: 0px !important; 
            width: 100%; 
            display: none !important;
        }
        
        /* Nama PPK tidak tebal dan tidak bergaris bawah, format (Nama) */
        .sppd-signature-ppk .nama-ppk { 
            font-weight: normal !important;
            text-decoration: none !important;
            margin-bottom: 2px !important;
            line-height: 1.2 !important; 
            text-align: center !important; 
            width: 100%; 
            font-size: 10pt; 
        }
        
        .sppd-signature-ppk .nip-ppk { 
            margin-top: 1px !important; 
            margin-bottom: 5px !important;
            line-height: 1.2 !important; 
            text-align: center !important; 
            width: 100%; 
            font-size: 10pt; 
        }
        
        .sppd-signature-ppk-kanan { 
            margin-top: 0px !important; 
            text-align: center !important; 
            display: flex; 
            flex-direction: column; 
            width: 100%; 
            margin-bottom: 5px !important; 
        }
        
        .sppd-signature-ppk-kanan .jabatan-ppk-kanan { 
            font-weight: normal !important; 
            margin-bottom: 75px !important; /* Jarak dikurangi agar muat 1 halaman */
            text-align: center !important; 
            width: 100%; 
            font-size: 10pt; 
            line-height: 1.2 !important; 
        }
        
        .sppd-signature-ppk-kanan .space-ttd-kanan { 
            display: none !important;
            height: 0px !important; 
            width: 100%; 
        }
        
        /* Nama PPK kanan tidak tebal dan tidak bergaris bawah, format (Nama) */
        .sppd-signature-ppk-kanan .nama-ppk-kanan { 
            font-weight: normal !important;
            text-decoration: none !important;
            margin-bottom: 2px !important;
            line-height: 1.2 !important;
            text-align: center !important; 
            width: 100%; 
            font-size: 10pt;
        }
        
        .sppd-signature-ppk-kanan .nip-ppk-kanan { 
            margin-top: 1px !important; 
            margin-bottom: 5px !important;
            line-height: 1.2 !important; 
            text-align: center !important; 
            width: 100%; 
            font-size: 10pt; 
        }
        
        .sppd-keterangan-teks { 
            font-size: 9.5pt; 
            line-height: 1.3; 
            text-align: justify; 
            margin-bottom: 8px; 
            padding: 6px; 
            border: 1px dashed #999; 
            background-color: #f9f9f9; 
        }
        
        .sppd-catatan { 
            padding: 6px; 
            border-bottom: none; 
            font-size: 10pt; 
            text-align: left; 
        }
        
        .sppd-perhatian { 
            border-top: 1px double black; 
            border-bottom: 1px solid black; 
            padding: 6px; 
            font-size: 9pt; 
            text-align: left; 
        }
        
        .sppd-back-grid { 
            width: 100%; 
            border-collapse: collapse; 
            font-size: 10pt; 
            border: 1px solid black; 
            table-layout: fixed; 
            background: white; 
        }
        
        .sppd-back-grid td { 
            border: 1px solid black; 
            padding: 4px 6px; 
            vertical-align: top; 
            width: 50%; 
            min-height: 100px; 
            font-size: 9.5pt; 
            background: white; 
        }
        
        /* Baris 6 (kolom VI) - Mengurangi jarak bawah setelah NIP */
        .sppd-back-grid tr:nth-child(6) td:first-child .sppd-signature-ppk {
            margin-bottom: 0 !important;
        }
        
        .sppd-back-grid tr:nth-child(7) td { 
            height: 40px !important; 
            padding: 4px 6px !important; 
            vertical-align: middle; 
            text-align: left; 
        }
        
        .sppd-back-grid tr:nth-child(8) td { 
            height: auto; 
            padding: 6px 8px; 
            text-align: left; 
        }

        /* --- SEMUA STYLE PREVIEW SURAT LAIN TETAP SAMA PERSIS --- */
        .kop-container { width: 100%; margin-bottom: 15px; position: relative; margin-top: 0; }
        .kop-center { display: flex; flex-direction: column; align-items: center; text-align: center; width: 100%; }
        .kop-center .kop-top { display: flex; flex-direction: column; align-items: center; text-align: center; width: 100%; }
        .kop-center .kop-logo-img { display: block; margin: 0 auto 10px auto; width: 75px; height: 75px; object-fit: contain; }
        .kop-center .kop-text { text-align: center; width: 100%; }
        
        /* PERUBAHAN UKURAN FONT KOP SURAT - 14PT UNTUK JUDUL, 12PT UNTUK ALAMAT */
        .kop-center .kop-text h1, 
        .kop-center .kop-text h2 {
            font-size: 14pt !important;
            font-weight: bold !important;
            margin: 0;
            text-transform: uppercase;
            line-height: 1.2;
            color: black;
        }
        
        /* Untuk Kop Surat model Sekretaris (logo di kiri) */
        .kop-sekretaris-text h1, 
        .kop-sekretaris-text h2 {
            font-size: 14pt !important;
            font-weight: bold !important;
            margin: 0;
            text-transform: uppercase;
            line-height: 1.2;
            color: black;
        }

        /* Untuk alamat di Kop Surat model Sekretaris */
        .kop-sekretaris-text .alamat {
            font-size: 12pt !important;
            margin-top: 3px;
            font-weight: normal;
            color: black;
            text-align: center;
        }

        /* Untuk Kop Surat Tugas model Sekretaris */
        .kop-surat-tugas-sekretaris .kop-judul h1, 
        .kop-surat-tugas-sekretaris .kop-judul h2 {
            font-size: 14pt !important;
        }

        .kop-surat-tugas-sekretaris .alamat {
            font-size: 12pt !important;
        }

        /* Tambahan untuk Kop Surat Dinas/Nota biasa */
        .kop-text h1, .kop-text h2 {
            font-size: 14pt !important;
        }

        /* Alamat untuk Kop biasa jika ada */
        .kop-alamat-detail {
            font-size: 12pt !important;
        }
        
        .kontak-row { display: flex; justify-content: space-between; width: 100%; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 8px; margin-bottom: 10px; font-size: 10pt; }
        
        /* STYLE BARU UNTUK KOP SEKRETARIS DENGAN LOGO DI KIRI LEBIH KE KIRI */
        .kop-surat-sekretaris {
            display: flex;
            flex-direction: column;
            width: 100%;
            margin-bottom: 15px;
        }
        .kop-sekretaris-header {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            gap: 15px;
            width: 100%;
        }
        .kop-sekretaris-logo {
            flex-shrink: 0;
            margin-left: 0;
            padding-left: 0;
        }
        .kop-sekretaris-logo img {
            width: 75px;
            height: 75px;
            object-fit: contain;
        }
        .kop-sekretaris-text {
            flex: 1;
            text-align: center;
            padding-right: 75px; /* Memberi ruang di kanan agar teks tetap center secara visual */
        }
        .kop-sekretaris-kontak {
            display: flex;
            justify-content: space-between;
            font-size: 10pt;
            margin-top: 8px;
            border-bottom: 2px solid black;
            padding-bottom: 4px;
            width: 100%;
        }
        
        .kop-surat-tugas-sekretaris { display: flex; flex-direction: column; align-items: center; text-align: center; width: 100%; margin-bottom: 15px; }
        .kop-surat-tugas-sekretaris .kop-header { display: flex; flex-direction: column; align-items: center; text-align: center; width: 100%; }
        .kop-surat-tugas-sekretaris .logo { width: 75px; height: 75px; margin: 0 auto 8px auto; display: block; object-fit: contain; }
        .kop-surat-tugas-sekretaris .kop-judul { width: 100%; text-align: center; }
        .kop-surat-tugas-sekretaris .kop-judul h1, .kop-surat-tugas-sekretaris .kop-judul h2 { font-size: 14pt !important; font-weight: bold !important; margin: 0; text-transform: uppercase; line-height: 1.2; color: black; text-align: center; }
        .kop-surat-tugas-sekretaris .alamat { font-size: 12pt !important; margin-top: 3px; font-weight: normal; color: black; text-align: center; }
        .kop-surat-tugas-sekretaris .kontak { display: flex; justify-content: space-between; font-size: 10pt; margin-top: 3px; border-bottom: 2px solid black; padding-bottom: 4px; width: 100%; }
        
        .judul-surat, .judul-nota, .judul-tugas, .nomor-surat-center { font-family: 'Tahoma', sans-serif !important; }
        .judul-surat { text-align: center; font-weight: bold !important; font-size: 13pt; margin-bottom: 12px; text-transform: uppercase; margin-top: 20px; }
        .judul-nota { text-align: center; font-weight: normal !important; font-size: 13pt; margin-bottom: 12px; text-transform: uppercase; text-decoration: underline; margin-top: 20px; }
        .judul-tugas { text-align: center; font-weight: bold !important; font-size: 13pt; margin-bottom: 12px; text-transform: uppercase; margin-top: 20px; text-decoration: underline; }
        .nomor-surat-center { text-align: center; font-size: 12pt; margin-bottom: 20px; font-weight: normal; }
        .signature-section { margin-top: 30px; float: right; width: 45%; display: flex; flex-direction: column; align-items: center; text-align: center; margin-right: 20px; }
        .sign-spacer { height: 60px; width: 100%; }
        
        /* Nama penandatangan umum tidak tebal dan tidak bergaris bawah, format (Nama) */
        .sign-name { 
            font-weight: normal !important;
            text-decoration: none !important;
            font-size: 12pt; 
            text-transform: uppercase; 
            width: 100%; 
            margin-bottom: 8px; 
            text-align: center; 
        }
        
        .sign-nip { margin-top: 8px; width: 100%; font-size: 12pt; text-align: center; }
        .sign-jabatan { font-size: 12pt; margin-bottom: 12px; text-align: center; width: 100%; }
        .meta-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .meta-table td { vertical-align: top; padding-bottom: 4px; font-size: 12pt; }
        .surat-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; width: 100%; margin-top: 15px; }
        .surat-header-left { width: 70%; }
        .surat-header-left table td { padding-bottom: 4px; font-size: 12pt; }
        .surat-header-alamat { width: 30%; text-align: right; font-size: 12pt; line-height: 1.4; font-weight: normal; }
        
        /* Agar tanggal surat tidak terpecah menjadi dua baris (tahun, bulan, tanggal dalam satu baris) */
        #sd-tanggal, #nota-tanggal, #prev-sppd-tgl-surat {
            white-space: nowrap;
        }
        
        /* Yth. tidak bold */
        .yth-text {
            font-weight: normal !important;
        }
        
        /* Penerima tidak bold */
        #sd-penerima {
            font-weight: normal !important;
        }
        
        /* Tempat menjorok lebih dari "-" */
        .tempat-indent {
            margin-left: 20px !important;
        }
        
        .kontak-telepon-email { font-size: 10pt !important; }
        .content-body { font-size: 12pt; line-height: 1.5; text-align: justify; margin-top: 20px; }
        .content-body p { text-indent: 1.27cm; margin-bottom: 8px; margin-top: 0; margin-left: 0; margin-right: 0; font-size: 12pt; text-align: justify; line-height: 1.5; }
        .content-body br { display: block; content: ""; margin-top: 8px; }
        
        /* ===== PERBAIKAN UNTUK SURAT TUGAS: TANDA : SEJAJAR, MEMBERI TUGAS CENTER ===== */
        .tugas-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 12px; 
        }
        .tugas-table td { 
            vertical-align: top; 
            font-size: 12pt; 
            padding-bottom: 6px; 
            text-align: left; 
        }
        .tugas-table .col-label { 
            width: 100px; 
            vertical-align: top;
            text-align: right;
            padding-right: 8px;
            font-weight: normal !important;
        }
        .tugas-table .sep-col {
            width: 20px;
            text-align: center;
            vertical-align: top;
        }
        .tugas-table .col-content { 
            padding-left: 8px; 
            text-align: left;
        }
        .memberi-tugas { 
            text-align: center; 
            margin: 15px 0 8px 0; 
            font-size: 12pt; 
            font-weight: normal !important;
            text-transform: none !important;
        }
        
        .tembusan-section { clear: both; margin-top: 60px; font-size: 12pt; width: 100%; }
        .tembusan-title { margin-bottom: 6px; font-weight: bold; }
        .tembusan-list-content { font-size: 12pt; }
        .tembusan-item { margin-left: 20px; margin-bottom: 2px; }
        .sppd-header-right { text-align: right; margin-bottom: 12px; font-size: 11pt; }
        .sppd-header-table { border-collapse: collapse; margin-left: auto; margin-right: 0; }
        .sppd-header-table td { padding: 2px 5px; text-align: left; vertical-align: top; font-size: 10.5pt; }
        .sppd-header-table .label { white-space: nowrap; }
        .sppd-title-main { text-align: center; font-weight: bold; font-size: 12pt; text-decoration: underline; margin-bottom: 15px; margin-top: 12px; }
        .sppd-table-front { width: 100%; border-collapse: collapse; font-size: 10.5pt; margin-bottom: 15px; border: 1px solid #000; table-layout: fixed; }
        .col-no { width: 30px; text-align: center; vertical-align: top; }
        .col-label { width: 200px; vertical-align: top; } 
        .col-content { width: auto; vertical-align: top; } 
        .sppd-table-front td { border: 1px solid #000; padding: 4px 6px; vertical-align: top; line-height: 1.3; word-wrap: break-word; font-size: 10.5pt; }
        .sppd-table-front tr:first-child td { border-bottom: 0.5px solid #000 !important; }
        .sppd-table-front tr:last-child td { border-bottom: none !important; }
        .nip-spacer { margin-top: 3px; display: block; }
        .td-nested-wrapper { padding: 0 !important; border: 1px solid #000; height: 100%; vertical-align: top; position: relative; }
        .table-nested-8 { width: 100%; border-collapse: collapse; border: none; margin: 0; table-layout: fixed; }
        .table-nested-8 td { border: none; border-bottom: 1px solid #000; border-right: 1px solid #000; padding: 3px 4px; vertical-align: top; word-wrap: break-word; font-size: 10pt; }
        .table-nested-8 td:last-child { border-right: none; }
        .table-nested-8 tr:last-child td { border-bottom: none; }
        .sppd-table-front tr:last-child td:first-child { position: relative; }
        .sppd-table-front tr:last-child td:first-child::after { content: ''; position: absolute; bottom: -1px; left: 0; width: 100%; height: 1px; background-color: #000; z-index: 1; }
        .sppd-table-front tr:last-child td { position: relative; }
        .sppd-table-front tr:last-child td::before { content: ''; position: absolute; bottom: -1px; left: 0; width: 100%; height: 1px; background-color: #000; z-index: 1; }
        .n8-header {
            font-weight: normal !important; 
            text-align: center;
            background: #fff;
            height: 22px;
            vertical-align: middle !important;
            border-bottom: 1px solid #000 !important;
            border-right: 1px solid #000 !important;
            font-size: 10pt;
            font-family: 'Tahoma', sans-serif !important;
        }
        
        .n8-header:last-child {
            border-right: none !important;
        }
        
        .text-left { 
            text-align: left !important; 
        }
        .n8-col-nama { width: 200px; } 
        .n8-col-tgl { width: 110px; }
        .n8-col-ket { width: auto; }

        /* Responsive Design - DIPERBAIKI */
        @media (max-width: 1400px) { 
            .main-grid { 
                grid-template-columns: 1.2fr 1.8fr; 
                gap: 20px; 
            }
        }
        
        @media (max-width: 1200px) { 
            .main-grid { 
                grid-template-columns: 1fr; 
                gap: 20px; 
            } 
            .preview-wrapper { 
                order: -1; 
            }
            .sppd-form-header-right {
                justify-content: flex-start;
            }
            .header-stats {
                display: none;
            }
            .card, .preview-wrapper {
                max-height: none;
                min-height: auto;
            }
        }
        
        @media (max-width: 768px) {
            .container { 
                padding: 15px; 
            }
            .card { 
                padding: 20px; 
            }
            .form-section { 
                padding: 15px; 
            }
            .header-content { 
                flex-direction: column; 
                text-align: center; 
            }
            .btn { 
                width: 100%; 
                justify-content: center; 
            }
            .sppd-form-header-grid,
            .form-grid-2,
            .form-grid-3 {
                grid-template-columns: 1fr;
            }
            .logo-wrapper {
                min-width: auto;
                padding: 8px 15px;
            }
            .logo-text .title {
                font-size: 1rem;
            }
            .header-info {
                flex-wrap: wrap;
                justify-content: center;
            }
            .kop-sekretaris-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .kop-sekretaris-text {
                text-align: center;
                padding-right: 0;
            }
        }
        
        @media (max-width: 480px) {
            #letter-preview { 
                padding: 10mm 10mm 15mm 15mm; 
            }
            .form-section-title { 
                font-size: 1rem; 
            }
            input, select, textarea { 
                padding: 10px 12px; 
            }
            .logo-text .title {
                font-size: 1rem;
            }
        }

        /* --- Animasi hanya untuk fade-in konten --- */
        @keyframes fadeIn {
            from { 
                opacity: 0; 
                transform: translateY(10px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        .fade-in { 
            animation: fadeIn 0.5s ease forwards; 
        }
        
        /* --- FIX UNTUK PDF - MEMASTIKAN TAMPILAN SEMPURNA --- */
        @media print {
            body {
                background: white;
            }
            .preview-wrapper {
                background: white;
                padding: 0;
                box-shadow: none;
                max-height: none;
            }
            #letter-preview {
                box-shadow: none;
                margin: 0;
                padding: 5mm 10mm 5mm 15mm;
                width: 210mm;
                min-height: 297mm;
            }
            #letter-preview.sppd-preview {
                width: 215mm !important;
                min-height: 330mm !important;
            }
            #letter-preview.sppd-preview.sppd-belakang-active {
                min-height: auto !important;
                height: auto !important;
            }
            .main-grid {
                display: block;
            }
            .card {
                display: none;
            }
            .btn-primary {
                display: none;
            }
            header {
                display: none;
            }
        }
        
        /* ===== TAMBAHAN: UKURAN FONT ISI SURAT 12PT UNTUK SEMUA SURAT SELAIN SPPD ===== */
        /* Memastikan semua teks isi surat (non-SPPD) menggunakan font 12pt Tahoma */
        #preview-surat-dinas,
        #preview-nota,
        #preview-tugas {
            font-size: 12pt;
        }
        
        #preview-surat-dinas .content-body p,
        #preview-nota .content-body p,
        #preview-tugas .content-body p,
        #preview-surat-dinas .content-body div,
        #preview-nota .content-body div,
        #preview-tugas .content-body div {
            font-size: 12pt;
            line-height: 1.5;
        }
        
        /* Tabel pada surat dinas, nota, tugas */
        #preview-surat-dinas .meta-table td,
        #preview-nota table td,
        #preview-tugas .tugas-table td {
            font-size: 12pt;
        }
        
        /* Elemen lain seperti "Yth.", "Tempat", dll */
        #preview-surat-dinas > div:first-child + div,
        #preview-surat-dinas > div:first-child + div div,
        #preview-surat-dinas .surat-header-alamat,
        #preview-nota .judul-nota,
        #preview-tugas .judul-tugas {
            font-size: 12pt;
        }
        
        /* Judul surat tetap 13pt */
        .judul-nota, .judul-tugas, .judul-surat {
            font-size: 13pt;
        }
        
        /* Nomor surat center */
        .nomor-surat-center {
            font-size: 12pt;
        }
        
        /* Nama penandatangan di SPPD depan (PPK) */
        .signature-section .sign-name {
            font-weight: normal !important;
            text-decoration: none !important;
        }

        /* === TAMBAHAN: HILANGKAN BOLD PADA SEMUA TEKS HASIL ISI DI HALAMAN BELAKANG SPPD === */
        #preview-sppd-belakang .sppd-value-fixed,
        #preview-sppd-belakang .sppd-value-fixed-wrap,
        #preview-sppd-belakang .sppd-label-fixed,
        #preview-sppd-belakang .sppd-separator-fixed,
        #preview-sppd-belakang .sppd-data-row-fixed span,
        #preview-sppd-belakang .sppd-data-area-fixed div,
        #preview-sppd-belakang .sppd-signature .nama,
        #preview-sppd-belakang .sppd-signature .nip,
        #preview-sppd-belakang .sppd-signature .jabatan,
        #preview-sppd-belakang .sppd-signature-ppk .nama-ppk,
        #preview-sppd-belakang .sppd-signature-ppk .nip-ppk,
        #preview-sppd-belakang .sppd-signature-ppk .jabatan-ppk,
        #preview-sppd-belakang .sppd-signature-ppk-kanan .nama-ppk-kanan,
        #preview-sppd-belakang .sppd-signature-ppk-kanan .nip-ppk-kanan,
        #preview-sppd-belakang .sppd-signature-ppk-kanan .jabatan-ppk-kanan,
        #preview-sppd-belakang .sppd-keterangan-teks,
        #preview-sppd-belakang #v-vi-keterangan,
        #preview-sppd-belakang #v-catatan {
            font-weight: normal !important;
        }

        /* --- STYLING PREMIUM UNTUK DROPDOWN JENIS SURAT --- */
        .jenis-surat-select {
            font-family: 'Tahoma', 'Arial', sans-serif;
            font-weight: 800 !important;
            font-size: 1.1rem !important;
            color: #1e3a6f !important;
            background: linear-gradient(135deg, #ffffff, #f0f5ff) !important;
            border: 2.5px solid #3498db !important;
            border-radius: 16px !important;
            padding: 16px 24px !important;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.1) !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            letter-spacing: 0.5px !important;
            width: 100%;
            margin-top: 5px;
        }
        .jenis-surat-select:hover {
            border-color: #2196f3 !important;
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.18) !important;
            transform: translateY(-1px) !important;
            background: #ffffff !important;
        }
        .jenis-surat-select:focus {
            outline: none !important;
            box-shadow: 0 0 0 4px rgba(33, 150, 243, 0.25) !important;
            border-color: #2196f3 !important;
        }
    </style>
</head>
<body>

    <header>
        <div class="container header-content">
            <div class="logo-wrapper">
                <img src="logo-kpu.png" alt="Logo KPU">
                <div class="logo-text">
                    <span class="title">Sistem Surat KPU</span>
                    <span class="subtitle"><i class="fas fa-check-circle"></i> Komisi Pemilihan Umum</span>
                </div>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 6px; align-items: flex-start;">
                <div class="header-info" style="margin-bottom: 0;">
                    <div class="header-info-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span><span class="value" id="current-date"></span></span>
                    </div>
                    <div class="header-info-item">
                        <i class="fas fa-clock"></i>
                        <span><span class="value" id="current-time"></span></span>
                    </div>
                </div>
                <!-- Tombol Arsip -->
                <div style="display: flex; align-items: center; width: 100%; margin-top: 8px;">
                    <button class="btn" onclick="openArchiveModal()" style="padding: 10px 22px; font-size: 14px; background: #ffffff; color: #1e2a43; border: 2.5px solid #ffc107; border-radius: 40px; font-weight: 700; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.12); gap: 8px; display: inline-flex; align-items: center; width: auto; box-sizing: border-box; letter-spacing: 0.5px; transition: all 0.2s;" onmouseover="this.style.background='#f8fafc'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 15px rgba(0,0,0,0.18)';" onmouseout="this.style.background='#ffffff'; this.style.transform='none'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.12)';">
                        <i class="fas fa-archive" style="font-size: 15px;"></i> Arsip Unduhan Surat
                    </button>
                </div>
            </div>
            
            <div class="header-stats">
                <div class="stat-item">
                    <div class="stat-value">24/7</div>
                    <div class="stat-label">Layanan</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">SPPD</div>
                    <div class="stat-label">Online</div>
                </div>
            </div>
            
            <button class="btn btn-secondary" onclick="resetForm()">
                <i class="fas fa-undo-alt"></i> Reset
            </button>
        </div>
    </header>

    <div class="container">
        <div class="main-grid">
            
            <!-- FORM INPUT - DIPERPANJANG -->
            <div class="card fade-in">
                <div class="card-scroll-content">
                    <!-- Jenis Surat -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-file-alt"></i> 1. JENIS SURAT
                    </div>
                    <select id="letter-type" onchange="checkLetterType()" class="jenis-surat-select">
                        <option value="SURAT DINAS">📄 SURAT DINAS</option>
                        <option value="NOTA DINAS">📝 NOTA DINAS</option>
                        <option value="SURAT TUGAS">✅ SURAT TUGAS</option>
                        <option value="SPPD">✈️ SURAT PERJALANAN DINAS (SPD)</option>
                    </select>
                </div>

                <!-- Penandatangan -->
                <div id="general-sign-selector">
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-user-edit"></i> 2. PENANDATANGAN
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-briefcase" style="margin-right: 8px; color: #3498db;"></i>Jabatan Penandatangan</label>
                            <select id="jabatan-penandatangan" onchange="updateJabatanFromSelect()">
                                <option value="KETUA,">Ketua</option>
                                <option value="SEKRETARIS,">Sekretaris</option>
                                <option value="Plt. SEKRETARIS,">Plt. Sekretaris</option>
                            </select>
                        </div>
                        
                        <div style="background: linear-gradient(135deg, #e3f2fd, #d4e8fc); padding: 20px; border-radius: 16px; border: 2px solid #3498db; margin-top: 15px;">
                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:15px;">
                                <i class="fas fa-pencil-alt" style="color: #2c3e50;"></i>
                                <span style="font-weight:bold;">Data Penandatangan</span>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap Penandatangan *</label>
                                <input type="text" id="input-nama-ttd" placeholder="Masukkan Nama Lengkap Penandatangan" oninput="updatePreview()" value="">
                            </div>
                            <div class="form-group">
                                <label>NIP Penandatangan</label>
                                <input type="text" id="input-nip-ttd" placeholder="Contoh: 19730528 200501 1 007" oninput="updatePreview()" value="">
                            </div>
                            <div class="input-info">
                                <i class="fas fa-info-circle"></i> Data ini akan muncul di tanda tangan surat.
                            </div>
                        </div>
                        
                        <input type="hidden" id="input-jabatan" value="KETUA,">
                    </div>
                </div>

                <!-- Opsi Halaman SPPD -->
                <div id="sppd-page-toggle" class="form-section hidden" style="background:linear-gradient(135deg, #fef5e7, #fef0d9); border-left-color:#ff9800;">
                    <div class="form-section-title" style="color: #e65100;">
                        <i class="fas fa-cogs" style="color: #ff9800;"></i> Opsi Halaman Template SPPD
                    </div>
                    <div>
                        <label>
                            <input type="radio" name="sppd_page" value="depan" checked onchange="toggleSppdInputMode()"> 
                            <div>
                                <div><i class="fas fa-file-alt"></i> Halaman Depan</div>
                                <div style="font-size:0.8rem; color:#666;">Data utama perjalanan dinas</div>
                            </div>
                        </label>
                        <label>
                            <input type="radio" name="sppd_page" value="belakang" onchange="toggleSppdInputMode()"> 
                            <div>
                                <div><i class="fas fa-file-signature"></i> Halaman Belakang</div>
                                <div style="font-size:0.8rem; color:#666;">Jadwal & penandatanganan</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Input Umum -->
                <div id="general-inputs">
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-heading"></i> INFORMASI SURAT
                        </div>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label>Nomor Surat</label>
                                <input type="text" id="nomor" placeholder="Contoh: XXX/RT.XX.X-ST/XXXX/XXXX" oninput="updatePreview()" value="">
                            </div>
                            <div class="form-group" id="group-tanggal-umum">
                                <label>Tanggal Surat</label>
                                <input type="text" id="tanggal" placeholder="Contoh: Pekalongan, 1 Jan 2024" oninput="updatePreview()" value="">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Surat Dinas & Nota -->
                <div id="form-general">
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-edit"></i> DETAIL SURAT
                        </div>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label>Sifat Surat</label>
                                <select id="sifat" onchange="updatePreview()">
                                    <option value="Biasa" selected>Biasa</option>
                                    <option value="Penting">Penting</option>
                                    <option value="Segera">Segera</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Lampiran</label>
                                <input type="text" id="lampiran" placeholder="Jumlah berkas lampiran" oninput="updatePreview()" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Perihal</label>
                            <textarea rows="3" id="perihal" oninput="updatePreview()" placeholder="Pokok persoalan surat"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Kepada Yth. (Penerima)</label>
                            <input type="text" id="penerima" placeholder="Contoh: Kepala Dinas Pendidikan" oninput="updatePreview()" value="">
                        </div>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label>Tujuan Tempat</label>
                                <input type="text" id="tujuan-tempat" placeholder="Lokasi tujuan" oninput="updatePreview()" value="Tempat">
                            </div>
                        </div>
                        
                        <!-- KOLOM ISI SURAT DENGAN TEMPLATE -->
                        <div class="form-group-isi-surat">
                            <label><i class="fas fa-file-signature"></i> Isi Surat</label>
                            <textarea id="isi" rows="10" oninput="updatePreview()" placeholder="Tulis isi surat di sini..."></textarea>
                        </div>
                    </div>
                    
                    <!-- FORM TEMBUSAN -->
                    <div class="form-tembusan-section">
                        <div class="form-tembusan-title">
                            <i class="fas fa-share-alt"></i> TEMBUSAN
                        </div>
                        <div class="form-group">
                            <label style="color: #e65100;">Tembusan (Kosongkan jika tidak ada)</label>
                            <textarea id="tembusan" rows="4" oninput="updatePreview()" placeholder="Contoh:&#10;1. Ketua KPU RI&#10;2. Anggota KPU RI&#10;3. Arsip" style="border-color: #ff9800;"></textarea>
                            <div class="input-info" style="background: #fff2e0;">
                                <i class="fas fa-info-circle" style="color: #e65100;"></i> Tembusan hanya akan muncul di surat jika diisi.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Surat Tugas -->
                <div id="form-tugas" class="hidden">
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-tasks"></i> DETAIL SURAT TUGAS
                        </div>
                        <div class="form-group">
                            <label>Menimbang</label>
                            <textarea id="menimbang" rows="4" oninput="updatePreview()" placeholder="a. ...&#10;b. ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Dasar</label>
                            <textarea id="dasar" rows="6" oninput="updatePreview()" placeholder="1. ...&#10;2. ...&#10;3. ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Kepada</label>
                            <textarea id="kepada" rows="3" oninput="updatePreview()" placeholder="1. Nama Pegawai 1&#10;2. Nama Pegawai 2"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Untuk</label>
                            <textarea id="untuk" rows="4" oninput="updatePreview()" placeholder="Melaksanakan Kegiatan ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Anggaran</label>
                            <textarea id="anggaran" rows="3" oninput="updatePreview()" placeholder="Sumber dan pos anggaran"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Form SPPD -->
                <div id="form-sppd" class="hidden">
                    
                    <!-- Input Depan -->
                    <div id="inputs-depan">
                        <!-- HEADER SPPD DI KANAN -->
                        <div class="sppd-form-header-right">
                            <div class="sppd-form-header-container">
                                <div class="form-section-title" style="margin-bottom: 15px; color: #e67700;">
                                    <i class="fas fa-file-medical"></i> HEADER SPPD
                                </div>
                                <div class="sppd-form-header-grid">
                                    <div class="sppd-form-header-item">
                                        <label>Lembar Ke</label>
                                        <input type="text" id="sppd-lembar-manual" placeholder="Nomor lembar" oninput="updatePreview()">
                                    </div>
                                    <div class="sppd-form-header-item">
                                        <label>Kode No. </label>
                                        <input type="text" id="sppd-kode-no" placeholder="Kode nomor SPPD" oninput="updatePreview()">
                                    </div>
                                    <div class="sppd-form-header-item" style="grid-column: span 2;">
                                        <label>Nomor Surat SPPD</label>
                                        <input type="text" id="sppd-nomor" placeholder="Nomor resmi SPPD" oninput="updatePreview()">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="fas fa-user-tie"></i> PEJABAT & PEGAWAI
                            </div>
                            <div class="form-group">
                                <label><span class="label-num"><i class="fas fa-user-tie" style="margin-right:5px;"></i> 1</span>Nama Pejabat Pembuat Komitmen (PPK)</label>
                                <input type="text" id="sppd-ppk-nama" placeholder="Nama PPK" oninput="updatePreview()">
                            </div>
                            
                            <div class="form-group">
                                <label><span class="label-num"><i class="fas fa-id-card" style="margin-right:5px;"></i> 2</span>NIP Pejabat Pembuat Komitmen (PPK)</label>
                                <input type="text" id="sppd-ppk-nip" placeholder="NIP PPK" oninput="updatePreview()">
                            </div>

                            <div class="form-group">
                                <label><span class="label-num"><i class="fas fa-user" style="margin-right:5px;"></i> 3</span>Nama Pegawai yang Melaksanakan</label>
                                <input type="text" id="sppd-nama" placeholder="Nama pegawai pelaksana" oninput="updatePreview()">
                            </div>

                            <div class="form-group">
                                <label><span class="label-num"><i class="fas fa-id-badge" style="margin-right:5px;"></i> 4</span>NIP Pegawai yang Melaksanakan</label>
                                <input type="text" id="sppd-nip" placeholder="NIP pegawai pelaksana" oninput="updatePreview()">
                            </div>

                            <div class="form-group">
                                <label><span class="label-num"><i class="fas fa-layer-group" style="margin-right:5px;"></i> 5</span>Info Pangkat & Jabatan</label>
                                <input type="text" id="sppd-pangkat" placeholder="Pangkat/Golongan" oninput="updatePreview()">
                                <input type="text" id="sppd-jabatan" placeholder="Jabatan/Instansi" oninput="updatePreview()" style="margin-top:10px;">
                                <input type="text" id="sppd-biaya" placeholder="Tingkat biaya perjalanan dinas" oninput="updatePreview()" style="margin-top:10px;">
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="fas fa-route"></i> DETAIL PERJALANAN
                            </div>
                            <div class="form-group">
                                <label><span class="label-num"><i class="fas fa-bullseye" style="margin-right:5px;"></i> 6</span>Maksud Perjalanan Dinas</label>
                                <textarea id="sppd-maksud" rows="2" placeholder="Tujuan perjalanan dinas" oninput="updatePreview()"></textarea>
                            </div>

                            <div class="form-group">
                                <label><span class="label-num"><i class="fas fa-plane-departure" style="margin-right:5px;"></i> 7</span>Alat Angkut</label>
                                <input type="text" id="sppd-transport" placeholder="Moda transportasi yang digunakan" oninput="updatePreview()">
                            </div>

                            <div class="form-group">
                                <label><span class="label-num"><i class="fas fa-map-marked-alt" style="margin-right:5px;"></i> 8</span>Tempat Berangkat & Tujuan</label>
                                <input type="text" id="sppd-berangkat" placeholder="Lokasi keberangkatan" oninput="updatePreview()">
                                <input type="text" id="sppd-tujuan" placeholder="Lokasi tujuan" oninput="updatePreview()" style="margin-top:10px;">
                            </div>

                            <div class="form-group">
                                <label><span class="label-num"><i class="fas fa-calendar-alt" style="margin-right:5px;"></i> 9</span>Waktu Perjalanan</label>
                                <input type="text" id="sppd-lama" placeholder="Durasi perjalanan" oninput="updatePreview()">
                                <input type="text" id="sppd-tgl-berangkat" placeholder="Tanggal berangkat" oninput="updatePreview()" style="margin-top:10px;">
                                <input type="text" id="sppd-tgl-kembali" placeholder="Tanggal kembali" oninput="updatePreview()" style="margin-top:10px;">
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="fas fa-users"></i> PENGIKUT
                            </div>
                            <div class="form-group">
                                <label><span class="label-num"><i class="fas fa-users" style="margin-right:5px;"></i> 10</span>Pengikut (Tambah Manual)</label>
                                <div id="pengikut-container-input" style="margin-bottom:15px;"></div>
                                <button type="button" class="btn btn-add" onclick="addPengikutRow()">
                                    <i class="fas fa-plus"></i> Tambah Pengikut
                                </button>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="fas fa-money-bill-wave"></i> ANGGARAN
                            </div>
                            <div class="form-group">
                                <label><span class="label-num"><i class="fas fa-money-bill-wave" style="margin-right:5px;"></i> 11</span>Anggaran</label>
                                <input type="text" id="sppd-instansi" placeholder="Instansi pembebanan anggaran" oninput="updatePreview()">
                                <input type="text" id="sppd-akun" placeholder="Kode akun anggaran" oninput="updatePreview()" style="margin-top:10px;">
                            </div>

                            <div class="form-group">
                                <label><span class="label-num"><i class="fas fa-sticky-note" style="margin-right:5px;"></i> 12</span>Keterangan Lain-Lain</label>
                                <textarea id="sppd-lain" rows="2" placeholder="Informasi tambahan jika diperlukan" oninput="updatePreview()"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-section" style="background:#e7f5ff; border-left-color:#339af0;">
                            <div class="form-section-title">
                                <i class="fas fa-stamp"></i> VALIDASI SPPD
                            </div>
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label>Dikeluarkan di</label>
                                    <input type="text" id="sppd-dikeluarkan" placeholder="Tempat dikeluarkan SPPD" oninput="updatePreview()">
                                </div>
                                <div class="form-group">
                                    <label>Pada Tanggal</label>
                                    <input type="text" id="sppd-tgl-validasi" placeholder="Tanggal pembuatan SPPD" oninput="updatePreview()">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Input Belakang - HALAMAN BELAKANG SPPD -->
                    <div id="inputs-belakang" class="hidden">
                        <div class="form-section" style="background:#e7f5ff; border-left-color:#339af0;">
                            <div class="form-section-title">
                                <i class="fas fa-calendar-alt"></i> JADWAL PERJALANAN (HALAMAN BELAKANG)
                            </div>
                            <div class="input-info" style="margin-bottom:20px;">
                                <i class="fas fa-info-circle"></i> Isi sesuai dengan format halaman belakang SPPD.
                            </div>
                            
                            <!-- KOLOM I - BERANGKAT (KANAN) - PPK -->
                            <div style="background:white; padding:20px; border-radius:16px; margin-bottom:20px; border:2px solid #e8ecf2;">
                                <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
                                    <span style="background:#6c757d; color:white; width:35px; height:35px; display:flex; align-items:center; justify-content:center; border-radius:50%; font-weight:bold;">I</span>
                                    <span style="font-weight:bold; color:#2c3e50;">KOLOM I - BERANGKAT (PPK)</span>
                                </div>
                                <div class="form-grid-2">
                                    <div class="form-group">
                                        <label>Berangkat dari</label>
                                        <input type="text" id="back-berangkat-dari-kanan" placeholder="Isi tempat keberangkatan" oninput="updatePreview()">
                                    </div>
                                    <div class="form-group">
                                        <label>Ke</label>
                                        <input type="text" id="back-berangkat-ke-kanan" placeholder="Isi tujuan" oninput="updatePreview()">
                                    </div>
                                </div>
                                <div class="form-grid-2">
                                    <div class="form-group">
                                        <label>Pada Tanggal</label>
                                        <input type="text" id="back-berangkat-tgl-kanan" placeholder="Isi tanggal keberangkatan" oninput="updatePreview()">
                                    </div>
                                    <div class="form-group">
                                        <label>Kepala (Jabatan)</label>
                                        <input type="text" id="back-berangkat-kepala-kanan" placeholder="Isi jabatan yang dituju" oninput="updatePreview()">
                                    </div>
                                </div>
                                <div class="form-grid-2">
                                    <div class="form-group">
                                        <label>Nama PPK</label>
                                        <input type="text" id="back-berangkat-nama-kanan" placeholder="Isi nama PPK" oninput="updatePreview()">
                                    </div>
                                    <div class="form-group">
                                        <label>NIP PPK</label>
                                        <input type="text" id="back-berangkat-nip-kanan" placeholder="Isi NIP PPK" oninput="updatePreview()">
                                    </div>
                                </div>
                                <div class="input-info">* Bagian ini untuk tanda tangan PPK di kolom kanan</div>
                            </div>
                            
                            <!-- KOLOM II - TIBA (KIRI) dan BERANGKAT (KANAN) -->
                            <div style="background:white; padding:20px; border-radius:16px; margin-bottom:20px; border:2px solid #e8ecf2;">
                                <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
                                    <span style="background:#6c757d; color:white; width:35px; height:35px; display:flex; align-items:center; justify-content:center; border-radius:50%; font-weight:bold;">II</span>
                                    <span style="font-weight:bold; color:#2c3e50;">KOLOM II - PERJALANAN</span>
                                </div>
                                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                                    <div>
                                        <label style="font-weight:bold; margin-bottom:10px; display:block; color:#2c3e50;">KIRI (Tiba)</label>
                                        <div class="form-group">
                                            <input type="text" id="back-ii-tiba" placeholder="Tempat tiba" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-ii-tiba-tgl" placeholder="Tanggal tiba" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-ii-tiba-kepala" placeholder="Jabatan yang dituju" oninput="updatePreview()">
                                        </div>
                                    </div>
                                    <div>
                                        <label style="font-weight:bold; margin-bottom:10px; display:block; color:#2c3e50;">KANAN (Berangkat)</label>
                                        <div class="form-group">
                                            <input type="text" id="back-ii-berangkat" placeholder="Tempat berangkat" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-ii-berangkat-ke" placeholder="Ke (tujuan)" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-ii-berangkat-tgl" placeholder="Tanggal berangkat" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-ii-berangkat-kepala" placeholder="Jabatan yang dituju" oninput="updatePreview()">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-info">* Kolom kiri untuk Tiba, kolom kanan untuk Berangkat</div>
                            </div>
                            
                            <!-- KOLOM III - TIBA (KIRI) dan BERANGKAT (KANAN) -->
                            <div style="background:white; padding:20px; border-radius:16px; margin-bottom:20px; border:2px solid #e8ecf2;">
                                <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
                                    <span style="background:#6c757d; color:white; width:35px; height:35px; display:flex; align-items:center; justify-content:center; border-radius:50%; font-weight:bold;">III</span>
                                    <span style="font-weight:bold; color:#2c3e50;">KOLOM III - PERJALANAN</span>
                                </div>
                                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                                    <div>
                                        <label style="font-weight:bold; margin-bottom:10px; display:block; color:#2c3e50;">KIRI (Tiba)</label>
                                        <div class="form-group">
                                            <input type="text" id="back-iii-tiba" placeholder="Tempat tiba" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-iii-tiba-tgl" placeholder="Tanggal tiba" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-iii-tiba-kepala" placeholder="Jabatan yang dituju" oninput="updatePreview()">
                                        </div>
                                    </div>
                                    <div>
                                        <label style="font-weight:bold; margin-bottom:10px; display:block; color:#2c3e50;">KANAN (Berangkat)</label>
                                        <div class="form-group">
                                            <input type="text" id="back-iii-berangkat" placeholder="Tempat berangkat" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-iii-berangkat-ke" placeholder="Ke (tujuan)" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-iii-berangkat-tgl" placeholder="Tanggal berangkat" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-iii-berangkat-kepala" placeholder="Jabatan yang dituju" oninput="updatePreview()">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-info">* Kolom kiri untuk Tiba, kolom kanan untuk Berangkat</div>
                            </div>
                            
                            <!-- KOLOM IV - TIBA (KIRI) dan BERANGKAT (KANAN) -->
                            <div style="background:white; padding:20px; border-radius:16px; margin-bottom:20px; border:2px solid #e8ecf2;">
                                <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
                                    <span style="background:#6c757d; color:white; width:35px; height:35px; display:flex; align-items:center; justify-content:center; border-radius:50%; font-weight:bold;">IV</span>
                                    <span style="font-weight:bold; color:#2c3e50;">KOLOM IV - PERJALANAN</span>
                                </div>
                                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                                    <div>
                                        <label style="font-weight:bold; margin-bottom:10px; display:block; color:#2c3e50;">KIRI (Tiba)</label>
                                        <div class="form-group">
                                            <input type="text" id="back-iv-tiba" placeholder="Tempat tiba" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-iv-tiba-tgl" placeholder="Tanggal tiba" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-iv-tiba-kepala" placeholder="Jabatan yang dituju" oninput="updatePreview()">
                                        </div>
                                    </div>
                                    <div>
                                        <label style="font-weight:bold; margin-bottom:10px; display:block; color:#2c3e50;">KANAN (Berangkat)</label>
                                        <div class="form-group">
                                            <input type="text" id="back-iv-berangkat" placeholder="Tempat berangkat" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-iv-berangkat-ke" placeholder="Ke (tujuan)" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-iv-berangkat-tgl" placeholder="Tanggal berangkat" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-iv-berangkat-kepala" placeholder="Jabatan yang dituju" oninput="updatePreview()">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-info">* Kolom kiri untuk Tiba, kolom kanan untuk Berangkat</div>
                            </div>
                            
                            <!-- KOLOM V - TIBA (KIRI) dan BERANGKAT (KANAN) -->
                            <div style="background:white; padding:20px; border-radius:16px; margin-bottom:20px; border:2px solid #e8ecf2;">
                                <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
                                    <span style="background:#6c757d; color:white; width:35px; height:35px; display:flex; align-items:center; justify-content:center; border-radius:50%; font-weight:bold;">V</span>
                                    <span style="font-weight:bold; color:#2c3e50;">KOLOM V - PERJALANAN</span>
                                </div>
                                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                                    <div>
                                        <label style="font-weight:bold; margin-bottom:10px; display:block; color:#2c3e50;">KIRI (Tiba)</label>
                                        <div class="form-group">
                                            <input type="text" id="back-v-tiba" placeholder="Tempat tiba" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-v-tiba-tgl" placeholder="Tanggal tiba" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-v-tiba-kepala" placeholder="Jabatan yang dituju" oninput="updatePreview()">
                                        </div>
                                    </div>
                                    <div>
                                        <label style="font-weight:bold; margin-bottom:10px; display:block; color:#2c3e50;">KANAN (Berangkat)</label>
                                        <div class="form-group">
                                            <input type="text" id="back-v-berangkat" placeholder="Tempat berangkat" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-v-berangkat-ke" placeholder="Ke (tujuan)" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-v-berangkat-tgl" placeholder="Tanggal berangkat" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="back-v-berangkat-kepala" placeholder="Jabatan yang dituju" oninput="updatePreview()">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-info">* Kolom kiri untuk Tiba, kolom kanan untuk Berangkat</div>
                            </div>
                            
                            <!-- KOLOM VI - TIBA AKHIR (KIRI) & PPK dan KETERANGAN (KANAN) - TANPA BINTANG DAN TANPA TEKS DEFAULT -->
                            <div style="background:white; padding:20px; border-radius:16px; margin-bottom:20px; border:2px solid #e8ecf2;">
                                <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
                                    <span style="background:#6c757d; color:white; width:35px; height:35px; display:flex; align-items:center; justify-content:center; border-radius:50%; font-weight:bold;">VI</span>
                                    <span style="font-weight:bold; color:#2c3e50;">KOLOM VI - TIBA AKHIR & PPK</span>
                                </div>
                                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                                    <div>
                                        <label style="font-weight:bold; margin-bottom:10px; display:block; color:#2c3e50;">KIRI (Tiba Akhir)</label>
                                        <div class="form-group">
                                            <label>Tiba di</label>
                                            <input type="text" id="back-vi-tiba" placeholder="Tempat tiba" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Kedudukan</label>
                                            <input type="text" id="back-vi-tempat-kedudukan" placeholder="Isi tempat kedudukan (misal: Kantor KPU)" oninput="updatePreview()" style="border-color: #ff9800;">
                                        </div>
                                        <div class="form-group">
                                            <label>Pada tanggal</label>
                                            <input type="text" id="back-vi-tiba-tgl" placeholder="Tanggal tiba" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama PPK</label>
                                            <input type="text" id="back-vi-nama" placeholder="Nama PPK" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <label>NIP PPK</label>
                                            <input type="text" id="back-vi-nip" placeholder="NIP PPK" oninput="updatePreview()">
                                        </div>
                                    </div>
                                    <div>
                                        <label style="font-weight:bold; margin-bottom:10px; display:block; color:#2c3e50;">KANAN (Keterangan & TTD)</label>
                                        <div class="form-group">
                                            <textarea rows="4" id="back-vi-keterangan" placeholder="Keterangan perjalanan..." oninput="updatePreview()" style="width:100%;">Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Penandatangan</label>
                                            <input type="text" id="back-vi-nama-kanan" placeholder="Nama" oninput="updatePreview()">
                                        </div>
                                        <div class="form-group">
                                            <label>NIP Penandatangan</label>
                                            <input type="text" id="back-vi-nip-kanan" placeholder="NIP" oninput="updatePreview()">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-info" style="background: #fff2e0;">
                                    <i class="fas fa-info-circle" style="color: #e65100;"></i> Kolom "Tempat Kedudukan" akan selalu ditampilkan di preview. Jika tidak diisi, akan muncul tanda "-".
                                </div>
                            </div>
                            
                            <!-- CATATAN LAIN -->
                            <div class="form-section" style="background:#fff9db; margin-bottom:10px;">
                                <div class="form-section-title" style="color:#e65100;">
                                    <i class="fas fa-edit"></i> VII. CATATAN LAIN
                                </div>
                                <div class="form-group">
                                    <textarea id="back-catatan" rows="2" placeholder="Isi catatan lain-lain..." oninput="updatePreview()" style="height:60px;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button Container - DIPERPANJANG, HANYA ADA 1 TOMBOL PDF -->
                <div id="button-container" class="button-container">
                    <!-- Tombol akan ditampilkan sesuai jenis surat oleh JavaScript, tapi untuk SPPD hanya tombol PDF -->
                </div>
                </div> <!-- CLOSE card-scroll-content -->
            </div> <!-- CLOSE card -->

            <!-- PREVIEW AREA - TETAP SAMA -->
            <div class="preview-wrapper fade-in">
                <div id="letter-preview">
                    
                    <!-- Kop Surat -->
                    <div class="kop-container" id="main-kop" style="margin-top: 0; padding-top: 0;">
                        <!-- Kop akan diisi oleh JavaScript -->
                    </div>

                    <!-- Konten Surat -->
                    <div id="surat-content-wrapper">
                        <!-- Preview Surat Dinas -->
                        <div id="preview-surat-dinas" class="hidden">
                            <div class="surat-header">
                                <div class="surat-header-left">
                                    <table class="meta-table" style="margin:0;">
                                        <tr><td style="width:100px;">Nomor</td><td class="sep-col" style="width:20px;">:</td><td id="sd-nomor">...</td></tr>
                                        <tr><td style="width:100px;">Sifat</td><td class="sep-col" style="width:20px;">:</td><td id="sd-sifat">...</td></tr>
                                        <tr><td style="width:100px;">Lampiran</td><td class="sep-col" style="width:20px;">:</td><td id="sd-lampiran">...</td></tr>
                                        <tr><td style="width:100px;">Perihal</td><td class="sep-col" style="width:20px;">:</td><td id="sd-perihal" style="vertical-align: top;">...</td></tr>
                                    </table>
                                </div>
                                <div class="surat-header-alamat" id="sd-alamat-kanan">
                                    <span id="sd-tanggal" style="font-weight: normal; font-size: 12pt;"></span>
                                </div>
                            </div>
                            <div style="margin-bottom: 25px; line-height: 1.5; font-size: 12pt;">
                                <div class="yth-text">Yth.</div>
                                <div id="sd-penerima" style="margin-left: 0;">...</div>
                                <div>di -</div>
                                <div id="sd-tempat" style="margin-left: 1.27cm;">Tempat</div>
                            </div>
                            <div class="content-body" id="sd-isi">...</div>
                        </div>

                        <!-- Preview Nota Dinas -->
                        <div id="preview-nota" class="hidden">
                            <div class="judul-nota">NOTA DINAS</div>
                            <table style="width: 100%; border-collapse: collapse; font-size: 12pt; margin-bottom: 20px;">
                                <tr><td style="width: 120px; padding: 5px 0; vertical-align: top;">Kepada</td><td style="width: 20px; text-align: center; padding: 5px 0; vertical-align: top;">:</td><td style="padding: 5px 0; vertical-align: top;">Yth. <span id="nota-kepada" style="font-weight:bold;">...</span></td></tr>
                                <tr><td style="padding: 5px 0; vertical-align: top;">Dari</td><td style="text-align: center; padding: 5px 0; vertical-align: top;">:</td><td style="padding: 5px 0; vertical-align: top;" id="nota-dari">Sekretaris KPU Kota Pekalongan</td></tr>
                                <tr><td style="padding: 5px 0; vertical-align: top;">Tembusan</td><td style="text-align: center; padding: 5px 0; vertical-align: top;">:</td><td style="padding: 5px 0; vertical-align: top;" id="nota-tembusan">...</td></tr>
                                <tr><td style="padding: 5px 0; vertical-align: top;">Nomor</td><td style="text-align: center; padding: 5px 0; vertical-align: top;">:</td><td style="padding: 5px 0; vertical-align: top;" id="nota-nomor">...</td></tr>
                                <tr><td style="padding: 5px 0; vertical-align: top;">Tanggal</td><td style="text-align: center; padding: 5px 0; vertical-align: top;">:</td><td style="padding: 5px 0; vertical-align: top;" id="nota-tanggal">...</td></tr>
                                <tr><td style="padding: 5px 0; vertical-align: top;">Sifat</td><td style="text-align: center; padding: 5px 0; vertical-align: top;">:</td><td style="padding: 5px 0; vertical-align: top;" id="nota-sifat">...</td></tr>
                                <tr><td style="padding: 5px 0; vertical-align: top;">Lampiran</td><td style="text-align: center; padding: 5px 0; vertical-align: top;">:</td><td style="padding: 5px 0; vertical-align: top;" id="nota-lampiran">-</td></tr>
                                <tr><td style="padding: 5px 0; vertical-align: top;">Perihal</td><td style="text-align: center; padding: 5px 0; vertical-align: top;">:</td><td style="padding: 5px 0; vertical-align: top; font-weight: bold;" id="nota-perihal">...</td></tr>
                            </table>
                            <div style="border-bottom: 2px solid black; margin-bottom: 30px;"></div>
                            <div class="content-body" id="nota-isi">...</div>
                        </div>

                        <!-- Preview Surat Tugas -->
                        <div id="preview-tugas" class="hidden">
                            <div class="judul-tugas">SURAT TUGAS</div>
                            <div class="nomor-surat-center">Nomor: <span id="prev-nomor-tugas">...</span></div>
                            
                            <table class="tugas-table">
                                <tr><td class="col-label">Menimbang</td><td class="sep-col">:</td><td id="prev-menimbang" class="col-content"></td></tr>
                                <tr><td class="col-label">Dasar</td><td class="sep-col">:</td><td id="prev-dasar" class="col-content"></td></tr>
                            </table>
                            
                            <div class="memberi-tugas">Memberi Tugas :</div>
                            
                            <table class="tugas-table">
                                <tr><td class="col-label">Kepada</td><td class="sep-col">:</td><td id="prev-kepada-tugas" class="col-content"></td></tr>
                                <tr><td class="col-label">Untuk</td><td class="sep-col">:</td><td id="prev-untuk" class="col-content"></td></tr>
                                <tr><td class="col-label">Anggaran</td><td class="sep-col">:</td><td id="prev-anggaran" class="col-content"></td></tr>
                            </table>
                        </div>

                        <!-- Preview SPPD Depan -->
                        <div id="preview-sppd-depan" class="hidden">
                            <div class="sppd-header-right">
                                <table class="sppd-header-table">
                                    <tr><td class="label">Lembar Ke</td><td>:</td><td id="prev-sppd-lembar">...</td></tr>
                                    <tr><td class="label">Kode No. </td><td>:</td><td id="prev-sppd-kode-no">...</td></tr>
                                    <tr><td class="label">Nomor</td><td>:</td><td id="prev-sppd-nomor">...</td></tr>
                                </table>
                            </div>
                            
                            <div class="sppd-title-main">SURAT PERJALANAN DINAS (SPD)</div>

                            <table class="sppd-table-front">
                                <colgroup>
                                    <col class="col-no">
                                    <col class="col-label">
                                    <col class="col-content">
                                </colgroup>

                                <tr><td class="col-no">1</td><td class="col-label">Pejabat Pembuat Komitmen</td><td><span id="prev-sppd-ppk-nama">...</span></td></tr>
                                <tr><td class="col-no">2</td><td class="col-label">Nama Pegawai yang melaksanakan Perjalanan Dinas</td><td><div id="prev-sppd-nama" style="font-weight:bold;">...</div></td></tr>
                                <tr><td class="col-no">3</td><td class="col-label">NIP Pegawai yang melaksanakan Perjalanan Dinas</td><td><div id="prev-sppd-nip" class="nip-spacer">NIP. ...</div></td></tr>
                                <tr><td class="col-no">4</td><td class="col-label">a. Pangkat / golongan<br>b. Jabatan/Instansi<br>c. Tingkat Biaya Perjalanan Dinas</td><td>a. <span id="prev-sppd-pangkat">...</span><br>b. <span id="prev-sppd-jabatan">...</span><br>c. <span id="prev-sppd-biaya">...</span></td></tr>
                                <tr><td class="col-no">5</td><td class="col-label">Maksud Perjalanan Dinas</td><td><span id="prev-sppd-maksud">...</span></td></tr>
                                <tr><td class="col-no">6</td><td class="col-label">Alat angkut yang dipergunakan</td><td><span id="prev-sppd-transport">...</span></td></tr>
                                <tr><td class="col-no">7</td><td class="col-label">a. Tempat berangkat<br>b. Tempat tujuan</td><td>a. <span id="prev-sppd-berangkat">...</span><br>b. <span id="prev-sppd-tujuan">...</span></td></tr>
                                <tr><td class="col-no">8</td><td class="col-label">a. Lamanya Perjalanan Dinas<br>b. Tanggal Berangkat<br>c. Tanggal harus kembali/tiba di tempat baru *)</td><td>a. <span id="prev-sppd-lama">...</span><br>b. <span id="prev-sppd-tgl-berangkat">...</span><br>c. <span id="prev-sppd-tgl-kembali">...</span></td></tr>
                                
                                <tr>
                                    <td class="col-no" style="vertical-align: top;">9</td>
                                    <td colspan="2" class="td-nested-wrapper">
                                        <table class="table-nested-8">
                                            <colgroup>
                                                <col class="n8-col-nama"> <col class="n8-col-tgl">
                                                <col class="n8-col-ket">
                                            </colgroup>
                                            <tr>
                                                <td class="n8-header text-left">Pengikut : Nama</td>
                                                <td class="n8-header">Tanggal Lahir</td>
                                                <td class="n8-header">Keterangan</td>
                                            </tr>
                                            <tbody id="prev-list-pengikut-body"></tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr><td class="col-no">10</td><td class="col-label">Pembebanan anggaran :<br>a. Instansi<br>b. Kegiatan/Output/Akun</td><td><br>a. <span id="prev-sppd-instansi">...</span><br>b. <span id="prev-sppd-akun">...</span></td></tr>
                                <tr><td class="col-no">11</td><td class="col-label">Keterangan lain - lain</td><td><span id="prev-sppd-lain"></span></td></tr>
                            </table>

                            <div class="signature-section" style="margin-top:20px;">
                                <div style="text-align:left; width:100%; font-size: 10.5pt;">
                                    Dikeluarkan di : <span id="prev-sppd-dikeluarkan">...</span><br>
                                    Pada Tanggal &nbsp;&nbsp;: <span id="prev-sppd-tgl-surat">...</span>
                                </div>
                                <div class="sign-jabatan" style="margin-top:10px; margin-bottom:5px;">Pejabat Pembuat Komitmen</div>
                                <!-- Space 2x enter di bawah tulisan PPK -->
                                <div class="ppk-signature-spacer"></div>
                                <div class="ppk-signature-spacer"></div>
                                <div class="sign-name" id="ppk-sign-name">...</div>
                                <div class="sign-nip" id="ppk-sign-nip">NIP. ...</div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>

                        <!-- PREVIEW SPPD BELAKANG - DENGAN TEMPAT KEDUDUKAN SELALU TAMPIL DAN TITIK DUA SEJAJAR -->
                        <div id="preview-sppd-belakang" class="hidden">
                            <table class="sppd-back-grid">
                                <!-- BARIS 1: KOLOM I - KIRI (KOTAK KOSONG) dan KANAN (SEKRETARIS) - TANPA TITIK-TITIK -->
                                <tr>
                                    <td style="vertical-align:top; width:50%; border:1px solid black; background:white; padding:5px 6px;">
                                        <div style="height:100%;"></div>
                                    </td>
                                    <td style="vertical-align:top; width:50%; border:1px solid black; background:white; padding:5px 6px;">
                                        <div class="sppd-data-content">
                                            <div class="data-area">
                                                <div class="sppd-roman-header-fixed">
                                                    <span class="sppd-roman-number-fixed">I.</span>
                                                    <div class="sppd-data-area-fixed">
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed" style="line-height: 1.1;">Berangkat dari<br>(Tempat Kedudukan)</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b1-asal2"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Ke</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b1-ke2"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Pada Tanggal</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b1-tgl2"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Kepala</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b1-kepala2"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="signature-area">
                                                <div class="sppd-signature sekretaris-column">
                                                    <div class="jabatan">Pejabat Pembuat Komitmen</div>
                                                    <div class="nama" id="v-b1-nama2"></div>
                                                    <div class="nip" id="v-b1-nip2"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- BARIS 2: KOLOM II - KIRI (TIBA) dan KANAN (BERANGKAT) -->
                                <tr>
                                    <td style="vertical-align:top; width:50%; border:1px solid black; background:white; padding:5px 6px;">
                                        <div class="sppd-data-content">
                                            <div class="data-area">
                                                <div class="sppd-roman-header-fixed">
                                                    <span class="sppd-roman-number-fixed">II.</span>
                                                    <div class="sppd-data-area-fixed">
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Tiba di</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b2-tiba"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Pada Tanggal</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b2-tiba-tgl"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Kepala</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b2-tiba-kepala"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="signature-area">
                                                <div class="sppd-signature">
                                                    <div class="titik-ttd kiri-turun">(.....................................)</div>
                                                    <div class="nama"></div>
                                                    <div class="nip"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align:top; width:50%; border:1px solid black; background:white; padding:5px 6px;">
                                        <div class="sppd-data-content">
                                            <div class="data-area">
                                                <div class="sppd-data-area-fixed" style="margin-left:0;">
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Berangkat dari</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b2-berangkat"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Ke</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b2-berangkat-ke"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Pada Tanggal</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b2-berangkat-tgl"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Kepala</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b2-berangkat-kepala"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="signature-area">
                                                <div class="sppd-signature">
                                                    <div class="titik-ttd kanan-turun">(.....................................)</div>
                                                    <div class="nama"></div>
                                                    <div class="nip"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- BARIS 3: KOLOM III - KIRI (TIBA) dan KANAN (BERANGKAT) -->
                                <tr>
                                    <td style="vertical-align:top; width:50%; border:1px solid black; background:white; padding:5px 6px;">
                                        <div class="sppd-data-content">
                                            <div class="data-area">
                                                <div class="sppd-roman-header-fixed">
                                                    <span class="sppd-roman-number-fixed">III.</span>
                                                    <div class="sppd-data-area-fixed">
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Tiba di</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b3-tiba"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Pada Tanggal</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b3-tiba-tgl"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Kepala</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b3-tiba-kepala"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="signature-area">
                                                <div class="sppd-signature">
                                                    <div class="titik-ttd kiri-turun">(.....................................)</div>
                                                    <div class="nama"></div>
                                                    <div class="nip"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align:top; width:50%; border:1px solid black; background:white; padding:5px 6px;">
                                        <div class="sppd-data-content">
                                            <div class="data-area">
                                                <div class="sppd-data-area-fixed" style="margin-left:0;">
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Berangkat dari</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b3-berangkat"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Ke</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b3-berangkat-ke"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Pada Tanggal</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b3-berangkat-tgl"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Kepala</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b3-berangkat-kepala"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="signature-area">
                                                <div class="sppd-signature">
                                                    <div class="titik-ttd kanan-turun">(.....................................)</div>
                                                    <div class="nama"></div>
                                                    <div class="nip"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- BARIS 4: KOLOM IV - KIRI (TIBA) dan KANAN (BERANGKAT) -->
                                <tr>
                                    <td style="vertical-align:top; width:50%; border:1px solid black; background:white; padding:5px 6px;">
                                        <div class="sppd-data-content">
                                            <div class="data-area">
                                                <div class="sppd-roman-header-fixed">
                                                    <span class="sppd-roman-number-fixed">IV.</span>
                                                    <div class="sppd-data-area-fixed">
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Tiba di</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b4-tiba"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Pada Tanggal</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b4-tiba-tgl"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Kepala</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b4-tiba-kepala"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="signature-area">
                                                <div class="sppd-signature">
                                                    <div class="titik-ttd kiri-turun">(.....................................)</div>
                                                    <div class="nama"></div>
                                                    <div class="nip"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align:top; width:50%; border:1px solid black; background:white; padding:5px 6px;">
                                        <div class="sppd-data-content">
                                            <div class="data-area">
                                                <div class="sppd-data-area-fixed" style="margin-left:0;">
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Berangkat dari</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b4-berangkat"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Ke</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b4-berangkat-ke"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Pada Tanggal</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b4-berangkat-tgl"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Kepala</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b4-berangkat-kepala"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="signature-area">
                                                <div class="sppd-signature">
                                                    <div class="titik-ttd kanan-turun">(.....................................)</div>
                                                    <div class="nama"></div>
                                                    <div class="nip"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- BARIS 5: KOLOM V - KIRI (TIBA) dan KANAN (BERANGKAT) -->
                                <tr>
                                    <td style="vertical-align:top; width:50%; border:1px solid black; background:white; padding:5px 6px;">
                                        <div class="sppd-data-content">
                                            <div class="data-area">
                                                <div class="sppd-roman-header-fixed">
                                                    <span class="sppd-roman-number-fixed">V.</span>
                                                    <div class="sppd-data-area-fixed">
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Tiba di</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b5-tiba"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Pada Tanggal</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b5-tiba-tgl"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Kepala</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b5-tiba-kepala"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="signature-area">
                                                <div class="sppd-signature">
                                                    <div class="titik-ttd kiri-turun">(.....................................)</div>
                                                    <div class="nama"></div>
                                                    <div class="nip"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align:top; width:50%; border:1px solid black; background:white; padding:5px 6px;">
                                        <div class="sppd-data-content">
                                            <div class="data-area">
                                                <div class="sppd-data-area-fixed" style="margin-left:0;">
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Berangkat dari</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b5-berangkat"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Ke</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b5-berangkat-ke"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Pada Tanggal</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b5-berangkat-tgl"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">Kepala</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b5-berangkat-kepala"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="signature-area">
                                                <div class="sppd-signature">
                                                    <div class="titik-ttd kanan-turun">(.....................................)</div>
                                                    <div class="nama"></div>
                                                    <div class="nip"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- BARIS 6: KOLOM VI - KIRI (TIBA AKHIR & PPK) - TEMPAT KEDUDUKAN SELALU TAMPIL DENGAN TITIK DUA SEJAJAR -->
                                <!-- BARIS 6A: KOLOM VI - TEKS (TIBA AKHIR & KETERANGAN) -->
                                <tr>
                                    <td style="vertical-align:top; width:50%; border:1px solid black; border-bottom:none; background:white; padding:5px 6px;">
                                        <div class="sppd-data-content" style="height:auto;">
                                            <div class="data-area">
                                                <div class="sppd-roman-header-fixed">
                                                    <span class="sppd-roman-number-fixed">VI.</span>
                                                    <div class="sppd-data-area-fixed">
                                                        <!-- Tiba di dengan : sejajar -->
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed" style="line-height: 1.1;">Tiba di<br>(Tempat Kedudukan)</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b6-tiba"></span>
                                                        </div>
                                                        
                                                        <!-- Pada tanggal dengan : sejajar -->
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Pada Tanggal</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b6-tiba-tgl"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align:top; width:50%; border:1px solid black; border-bottom:none; background:white; padding:5px 6px;">
                                        <div class="sppd-data-content" style="height:auto;">
                                            <div class="data-area">
                                                <div style="text-align:justify; font-size:9pt; line-height:1.3; margin-bottom:5px; text-align:left; padding-left:0;">
                                                    <span id="v-vi-keterangan">Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- BARIS 6B: KOLOM VI - TANDA TANGAN -->
                                <tr>
                                    <td style="vertical-align:bottom; width:50%; border:1px solid black; border-top:none; background:white; padding:5px 6px;">
                                        <div class="sppd-data-content" style="height:auto;">
                                            <div class="signature-area" style="margin-top:0;">
                                                <div class="sppd-signature-ppk">
                                                    <div class="jabatan-ppk">Pejabat Pembuat Komitmen</div>
                                                    <div class="space-ttd" style="display:none;"></div>
                                                    <div class="nama-ppk" id="v-ppk-nama"></div>
                                                    <div class="nip-ppk" id="v-ppk-nip"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align:bottom; width:50%; border:1px solid black; border-top:none; background:white; padding:5px 6px;">
                                        <div class="sppd-data-content" style="height:auto;">
                                            <div class="signature-area" style="margin-top:0;">
                                                <div class="sppd-signature-ppk-kanan">
                                                    <div class="jabatan-ppk-kanan">Pejabat Pembuat Komitmen</div>
                                                    <div class="space-ttd-kanan"></div>
                                                    <div class="nama-ppk-kanan" id="v-vi-nama-kanan"></div>
                                                    <div class="nip-ppk-kanan" id="v-vi-nip-kanan"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- BARIS 7 & 8: CATATAN LAIN & PERHATIAN (Digabung agar tidak terpisah halaman) -->
                                <tr style="page-break-inside: avoid; break-inside: avoid;">
                                    <td colspan="2" style="border:1px solid black; padding:0; background:white; text-align:left;">
                                        <div style="padding:4px 6px; border-bottom:1px solid black; min-height:35px;">
                                            <span style="font-weight:bold;">VII. Catatan Lain :</span>
                                            <span id="v-catatan" style="margin-left:5px;"></span>
                                        </div>
                                        <div style="padding:5px 6px;">
                                            <b>VIII. PERHATIAN</b><br>
                                            <span style="font-size: 8.5pt;">PPK yang menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan peraturan-peraturan Keuangan Negara apabila negara menderita kerugian akibat kesalahan, kelalaian, dan kealpaannya.</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- Tanda Tangan Umum -->
                        <div class="signature-section" id="general-signature">
                            <div class="sign-jabatan" id="sign-jabatan"></div>
                            <div class="sign-spacer" style="height:60px;"></div>
                            <div class="sign-name" id="sign-name"></div>
                            <div class="sign-nip" id="sign-nip"></div>
                        </div>

                        <!-- TEMBUSAN -->
                        <div class="tembusan-section" id="tembusan-section" style="display:none;">
                            <div class="tembusan-title">Tembusan :</div>
                            <div id="tembusan-list-content" class="tembusan-list-content"></div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // PHP variables passed to JavaScript
        const PHP_CONFIG = {
            appName: "<?php echo 'Sistem Surat KPU'; ?>",
            version: "<?php echo '1.0.0'; ?>",
            baseUrl: "<?php echo $_SERVER['PHP_SELF']; ?>"
        };

        const NAMA_KETUA = "FAJAR RANDI YOGANANDA";
        const NAMA_SEKRETARIS = "ISTADI";
        const NIP_SEKRETARIS = "19730528 200501 1 007";
        const TEMPLATE_ISI_SURAT = "Tempat\n\nSehubungan dengan.....(alinea pembuka).....\n\nIsi surat.....(alinea isi).....\n\nDemikian disampaikan.....(alinea penutup).....";

        // Default constants for SURAT DINAS to match user image
        const DEFAULT_DINAS_NOMOR = "";
        const DEFAULT_DINAS_TANGGAL = "";
        const DEFAULT_DINAS_SIFAT = "Biasa";
        const DEFAULT_DINAS_LAMPIRAN = "";
        const DEFAULT_DINAS_PERIHAL = "";
        const DEFAULT_DINAS_PENERIMA = "";
        const DEFAULT_DINAS_TEMPAT = "Tempat";
        const DEFAULT_DINAS_ISI = "";
        const DEFAULT_DINAS_TEMBUSAN = "";
        const DEFAULT_DINAS_NAMA_TTD = "";
        const DEFAULT_DINAS_NIP_TTD = "";
        const DEFAULT_DINAS_JABATAN_TTD = "KETUA,";

        // Global variables
        let pengikutList = [];

        // Initialize form
        function initForm() {
            // Set default values for signatory
            document.getElementById('input-nama-ttd').value = DEFAULT_DINAS_NAMA_TTD;
            document.getElementById('input-nip-ttd').value = DEFAULT_DINAS_NIP_TTD;
            document.getElementById('jabatan-penandatangan').value = DEFAULT_DINAS_JABATAN_TTD;
            
            // Update hidden jabatan
            document.getElementById('input-jabatan').value = DEFAULT_DINAS_JABATAN_TTD;
            
            // Set default isi surat dengan template
            document.getElementById('isi').value = DEFAULT_DINAS_ISI;
            
            checkLetterType();
            
            // Focus on first input
            document.getElementById('nomor').focus();
            
            // Set default tembusan
            document.getElementById('tembusan').value = DEFAULT_DINAS_TEMBUSAN;
            
            // Set semua input halaman belakang kosong (tanpa default)
            clearBackInputs();
            
            // Initial preview update
            updatePreview();
            
            // Update waktu real-time
            updateDateTime();
            setInterval(updateDateTime, 1000);
        }
        
        // Fungsi untuk update tanggal dan waktu
        function updateDateTime() {
            const now = new Date();
            const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
            document.getElementById('current-date').innerText = now.toLocaleDateString('id-ID', options);
            document.getElementById('current-time').innerText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        }
        
        // Fungsi untuk update jabatan dari dropdown
        function updateJabatanFromSelect() {
            const selectedJabatan = document.getElementById('jabatan-penandatangan').value;
            document.getElementById('input-jabatan').value = selectedJabatan;
            updatePreview();
        }
        
        function clearBackInputs() {
            // Kosongkan semua input halaman belakang
            const backInputs = [
                'back-berangkat-dari-kanan', 'back-berangkat-ke-kanan', 'back-berangkat-tgl-kanan', 
                'back-berangkat-kepala-kanan', 'back-berangkat-nama-kanan', 'back-berangkat-nip-kanan',
                'back-ii-tiba', 'back-ii-tiba-tgl', 'back-ii-tiba-kepala',
                'back-ii-berangkat', 'back-ii-berangkat-ke', 'back-ii-berangkat-tgl', 'back-ii-berangkat-kepala',
                'back-iii-tiba', 'back-iii-tiba-tgl', 'back-iii-tiba-kepala',
                'back-iii-berangkat', 'back-iii-berangkat-ke', 'back-iii-berangkat-tgl', 'back-iii-berangkat-kepala',
                'back-iv-tiba', 'back-iv-tiba-tgl', 'back-iv-tiba-kepala',
                'back-iv-berangkat', 'back-iv-berangkat-ke', 'back-iv-berangkat-tgl', 'back-iv-berangkat-kepala',
                'back-v-tiba', 'back-v-tiba-tgl', 'back-v-tiba-kepala',
                'back-v-berangkat', 'back-v-berangkat-ke', 'back-v-berangkat-tgl', 'back-v-berangkat-kepala',
                'back-vi-tiba', 'back-vi-tempat-kedudukan', 'back-vi-tiba-tgl',
                'back-vi-nama', 'back-vi-nip',
                'back-vi-keterangan', 'back-vi-nama-kanan', 'back-vi-nip-kanan',
                'back-catatan'
            ];
            
            backInputs.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.value = '';
            });
            
            // Set default text for back-vi-keterangan
            const keteranganEl = document.getElementById('back-vi-keterangan');
            if (keteranganEl) {
                keteranganEl.value = "Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.";
            }
        }

        // Reset form
        function resetForm() {
            if(confirm("Apakah Anda yakin ingin mereset semua data form?")) {
                document.querySelectorAll('input[type="text"], textarea').forEach(input => {
                    input.value = '';
                });
                
                // Reset select elements
                document.getElementById('letter-type').value = 'SURAT DINAS';
                document.getElementById('jabatan-penandatangan').value = DEFAULT_DINAS_JABATAN_TTD;
                document.getElementById('sifat').value = DEFAULT_DINAS_SIFAT;
                
                // Reset signatory to default
                document.getElementById('input-nama-ttd').value = DEFAULT_DINAS_NAMA_TTD;
                document.getElementById('input-nip-ttd').value = DEFAULT_DINAS_NIP_TTD;
                document.getElementById('input-jabatan').value = DEFAULT_DINAS_JABATAN_TTD;
                
                // Set default isi surat dengan template
                document.getElementById('isi').value = DEFAULT_DINAS_ISI;
                document.getElementById('tembusan').value = DEFAULT_DINAS_TEMBUSAN;
                
                // Clear pengikut
                pengikutList = [];
                document.getElementById('pengikut-container-input').innerHTML = '';
                
                // Set default text for back-vi-keterangan
                const keteranganEl = document.getElementById('back-vi-keterangan');
                if (keteranganEl) {
                    keteranganEl.value = "Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.";
                }
                
                // Reinitialize form
                checkLetterType();
                updatePreview();
            }
        }

        // Fungsi untuk menampilkan tombol sesuai jenis surat - HANYA TOMBOL PDF
        function updateButtons() {
            const buttonContainer = document.getElementById('button-container');
            const type = document.getElementById('letter-type').value;
            
            if (type === 'SPPD') {
                buttonContainer.innerHTML = `
                    <button class="btn btn-primary btn-full" onclick="downloadPDF()">
                        <i class="fas fa-file-pdf"></i> CETAK SPPD (2 HALAMAN)
                    </button>
                `;
            } else {
                buttonContainer.innerHTML = `
                    <button class="btn btn-primary" onclick="downloadPDF()">
                        <i class="fas fa-file-pdf"></i> CETAK PDF
                    </button>
                `;
                buttonContainer.style.display = 'flex';
            }
        }

        function checkLetterType() {
            const type = document.getElementById('letter-type').value;
            
            // Reset visibility
            ['form-general', 'form-tugas', 'form-sppd'].forEach(id => document.getElementById(id).classList.add('hidden'));
            document.getElementById('general-sign-selector').style.display = 'block';
            document.getElementById('sppd-page-toggle').classList.add('hidden');

            if (type === 'SPPD') {
                document.getElementById('form-sppd').classList.remove('hidden');
                document.getElementById('general-sign-selector').style.display = 'none';
                document.getElementById('sppd-page-toggle').classList.remove('hidden');
                
                // Sembunyikan bagian "INFORMASI SURAT" untuk SPPD
                document.getElementById('general-inputs').style.display = 'none';
                
                // Initialize pengikut if empty
                if(pengikutList.length === 0) {
                    addPengikutRow();
                }
                toggleSppdInputMode();
            }
            else if (type === 'SURAT TUGAS') {
                document.getElementById('form-tugas').classList.remove('hidden');
                // Tampilkan "INFORMASI SURAT" untuk Surat Tugas
                document.getElementById('general-inputs').style.display = 'block';
                // Set template untuk isi surat tugas
                document.getElementById('isi').value = TEMPLATE_ISI_SURAT;
            } else if (type === 'SURAT DINAS') {
                document.getElementById('form-general').classList.remove('hidden');
                // Tampilkan "INFORMASI SURAT" untuk Surat Dinas
                document.getElementById('general-inputs').style.display = 'block';
                
                // Pre-populate with values from the image
                document.getElementById('nomor').value = DEFAULT_DINAS_NOMOR;
                document.getElementById('tanggal').value = DEFAULT_DINAS_TANGGAL;
                document.getElementById('sifat').value = DEFAULT_DINAS_SIFAT;
                document.getElementById('lampiran').value = DEFAULT_DINAS_LAMPIRAN;
                document.getElementById('perihal').value = DEFAULT_DINAS_PERIHAL;
                document.getElementById('penerima').value = DEFAULT_DINAS_PENERIMA;
                document.getElementById('tujuan-tempat').value = DEFAULT_DINAS_TEMPAT;
                document.getElementById('isi').value = DEFAULT_DINAS_ISI;
                document.getElementById('tembusan').value = DEFAULT_DINAS_TEMBUSAN;
                
                // Signatory defaults for Surat Dinas
                document.getElementById('input-nama-ttd').value = DEFAULT_DINAS_NAMA_TTD;
                document.getElementById('input-nip-ttd').value = DEFAULT_DINAS_NIP_TTD;
                document.getElementById('jabatan-penandatangan').value = DEFAULT_DINAS_JABATAN_TTD;
                document.getElementById('input-jabatan').value = DEFAULT_DINAS_JABATAN_TTD;
            } else {
                document.getElementById('form-general').classList.remove('hidden');
                // Tampilkan "INFORMASI SURAT" untuk Nota Dinas
                document.getElementById('general-inputs').style.display = 'block';
                // Set template untuk isi surat
                document.getElementById('isi').value = TEMPLATE_ISI_SURAT;
            }
            
            // Update tombol sesuai jenis surat (hanya tombol PDF)
            updateButtons();
            updatePreview();
        }

        // Toggle SPPD input mode
        function toggleSppdInputMode() {
            const mode = document.querySelector('input[name="sppd_page"]:checked').value;
            const divDepan = document.getElementById('inputs-depan');
            const divBelakang = document.getElementById('inputs-belakang');
            const buttonContainer = document.getElementById('button-container');

            if (mode === 'depan') {
                divDepan.classList.remove('hidden');
                divBelakang.classList.add('hidden');
                buttonContainer.style.display = 'none';
            } else {
                divDepan.classList.add('hidden');
                divBelakang.classList.remove('hidden');
                buttonContainer.style.display = 'flex';
            }
            updatePreview();
        }

        // Pengikut management
        function addPengikutRow() {
            const id = Date.now();
            pengikutList.push({ id, nama: "", tgl: "", ket: "" });
            renderPengikutInputs();
            updatePreview();
        }

        function removePengikutRow(id) {
            pengikutList = pengikutList.filter(p => p.id !== id);
            renderPengikutInputs();
            updatePreview();
        }

        function updatePengikutData(id, field, value) {
            const item = pengikutList.find(p => p.id === id);
            if(item) {
                item[field] = value;
                updatePreview();
            }
        }

        function renderPengikutInputs() {
            const container = document.getElementById('pengikut-container-input');
            container.innerHTML = "";
            pengikutList.forEach((p, index) => {
                const div = document.createElement('div');
                div.className = 'fade-in';
                div.style.marginBottom = "15px";
                div.style.padding = "18px";
                div.style.border = "2px solid #e8ecf2";
                div.style.borderRadius = "16px";
                div.style.background = "linear-gradient(135deg, #f9fcff, #f0f5ff)";
                div.innerHTML = `
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:15px; background:white; padding:8px 15px; border-radius:30px;">
                        <span style="font-weight:bold; color:#2c3e50;">Pengikut ${index+1}</span>
                        <button class="btn btn-del" onclick="removePengikutRow(${p.id})"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="form-group" style="margin-bottom:12px;">
                        <label style="font-size:0.9rem;">Nama Lengkap</label>
                        <input type="text" placeholder="Isi nama pengikut" value="${p.nama}" oninput="updatePengikutData(${p.id}, 'nama', this.value)" style="background:white; border:2px solid #e0e7f0; border-radius:10px;">
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                        <div class="form-group" style="margin-bottom:0;">
                            <label style="font-size:0.9rem;">Tanggal Lahir</label>
                            <input type="text" placeholder="Isi tanggal lahir" value="${p.tgl}" oninput="updatePengikutData(${p.id}, 'tgl', this.value)" style="background:white; border:2px solid #e0e7f0; border-radius:10px;">
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label style="font-size:0.9rem;">Keterangan</label>
                            <input type="text" placeholder="Isi keterangan" value="${p.ket}" oninput="updatePengikutData(${p.id}, 'ket', this.value)" style="background:white; border:2px solid #e0e7f0; border-radius:10px;">
                        </div>
                    </div>
                `;
                container.appendChild(div);
            });
        }

        function generateList(text, type) {
            if(!text || text.trim() === "") return "-";
            
            const lines = text.split('\n').filter(line => line.trim() !== "");
            if(lines.length === 0) return "-";
            
            let html = '';
            if (type === 'a') {
                const letters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'];
                lines.forEach((line, index) => {
                    const cleanLine = line.replace(/^[a-z0-9]\.\s|^-\s/i, '').trim();
                    if (cleanLine) {
                        html += `<div style="margin-bottom: 5px;">${letters[index]}. ${cleanLine}</div>`;
                    }
                });
            } else {
                lines.forEach((line, index) => {
                    const cleanLine = line.replace(/^[0-9]\.\s|^-\s/i, '').trim();
                    if (cleanLine) {
                        html += `<div style="margin-bottom: 5px;">${index + 1}. ${cleanLine}</div>`;
                    }
                });
            }
            
            return html;
        }

        // Fungsi untuk membuat kop surat dinamis
        function createKopSurat(type, role) {
            const kopEl = document.getElementById('main-kop');
            kopEl.innerHTML = '';
            
            if (type === 'SPPD') {
                kopEl.style.display = 'none';
                return;
            }
            
            kopEl.style.display = 'block';
            kopEl.style.position = 'relative';
            kopEl.style.top = '0';
            kopEl.style.left = '0';
            kopEl.style.right = '0';
            kopEl.style.width = '100%';
            
            // Get the actual role from signatory data
            const jabatan = document.getElementById('input-jabatan').value || '';
            const isSekretaris = jabatan.toUpperCase().includes('SEKRETARIS');
            
            // SURAT TUGAS dengan Sekretaris
            if (type === 'SURAT TUGAS' && isSekretaris) {
                kopEl.className = 'kop-container kop-surat-tugas-sekretaris';
                kopEl.innerHTML = `
                    <div class="kop-header">
                        <img src="logo-kpu.png" alt="Logo KPU" class="logo" style="width:75px; height:75px; object-fit:contain; margin-bottom: 8px;">
                        <div class="kop-judul">
                            <h1>KOMISI PEMILIHAN UMUM</h1>
                            <h2>KOTA PEKALONGAN</h2>
                            <div class="alamat">Alamat : Jl. Sriwijaya No. 17 Pekalongan 51119</div>
                        </div>
                    </div>
                    <div class="kontak kontak-telepon-email">
                        <div>Telp. (0285) 4416076 – 4415988</div>
                        <div>Fax. (0285) 4416076 - 4415987</div>
                    </div>
                `;
            } 
            // SURAT TUGAS dengan Ketua
            else if (type === 'SURAT TUGAS') {
                kopEl.className = 'kop-container kop-center';
                kopEl.innerHTML = `
                    <div class="kop-top">
                        <img src="logo-kpu.png" alt="Logo" class="kop-logo-img" style="width:75px; height:75px; object-fit:contain;">
                        <div class="kop-text">
                            <h1>KOMISI PEMILIHAN UMUM</h1>
                            <h2>KOTA PEKALONGAN</h2>
                        </div>
                    </div>
                `;
            }
            // SURAT DINAS dengan Sekretaris - LOGO DI KIRI LEBIH KE KIRI DAN TEKS CENTER
            else if (type === 'SURAT DINAS' && isSekretaris) {
                kopEl.className = 'kop-container kop-surat-sekretaris';
                kopEl.innerHTML = `
                    <div class="kop-sekretaris-header">
                        <div class="kop-sekretaris-logo">
                            <img src="logo-kpu.png" alt="Logo KPU">
                        </div>
                        <div class="kop-sekretaris-text">
                            <h1>KOMISI PEMILIHAN UMUM</h1>
                            <h2>KOTA PEKALONGAN</h2>
                            <div class="alamat">Jalan Sriwijaya No. 17 Pekalongan 51119</div>
                        </div>
                    </div>
                    <div class="kop-sekretaris-kontak kontak-telepon-email">
                        <div>Telp. (0285) 4416076</div>
                        <div>Email: kota_pekalongan@kpu.go.id</div>
                    </div>
                `;
            }
            // SURAT DINAS dengan Ketua
            else if (type === 'SURAT DINAS') {
                kopEl.className = 'kop-container kop-center';
                kopEl.innerHTML = `
                    <div class="kop-top">
                        <img src="logo-kpu.png" alt="Logo" class="kop-logo-img" style="width:75px; height:75px; object-fit:contain; margin-bottom: 6px;">
                        <div class="kop-text">
                            <h1>KOMISI PEMILIHAN UMUM</h1>
                            <h2>KOTA PEKALONGAN</h2>
                        </div>
                    </div>
                `;
            }
            // NOTA DINAS dengan Sekretaris - LOGO DI KIRI LEBIH KE KIRI DAN TEKS CENTER
            else if (type === 'NOTA DINAS' && isSekretaris) {
                kopEl.className = 'kop-container kop-surat-sekretaris';
                kopEl.innerHTML = `
                    <div class="kop-sekretaris-header">
                        <div class="kop-sekretaris-logo">
                            <img src="logo-kpu.png" alt="Logo KPU">
                        </div>
                        <div class="kop-sekretaris-text">
                            <h1>KOMISI PEMILIHAN UMUM</h1>
                            <h2>KOTA PEKALONGAN</h2>
                        </div>
                    </div>
                    <div class="kop-sekretaris-kontak kontak-telepon-email">
                        <div>Telp. (0285) 4416076</div>
                        <div>Email: kota_pekalongan@kpu.go.id</div>
                    </div>
                `;
            }
            // NOTA DINAS dengan Ketua
            else if (type === 'NOTA DINAS') {
                kopEl.className = 'kop-container kop-center';
                kopEl.innerHTML = `
                    <div class="kop-top">
                        <img src="logo-kpu.png" alt="Logo" class="kop-logo-img" style="width:75px; height:75px; object-fit:contain; margin-bottom: 6px;">
                        <div class="kop-text">
                            <h1>KOMISI PEMILIHAN UMUM</h1>
                            <h2>KOTA PEKALONGAN</h2>
                        </div>
                    </div>
                `;
            }
            // Default
            else {
                kopEl.className = 'kop-container kop-center';
                kopEl.innerHTML = `
                    <div class="kop-top">
                        <img src="logo-kpu.png" alt="Logo" class="kop-logo-img" style="width:75px; height:75px; object-fit:contain;">
                        <div class="kop-text">
                            <h1>KOMISI PEMILIHAN UMUM</h1>
                            <h2>KOTA PEKALONGAN</h2>
                            <div class="kop-alamat-detail">
                                Jalan Sriwijaya No. 17 Pekalongan 51119
                            </div>
                        </div>
                    </div>
                `;
            }
        }

        function updatePreview() {
            const type = document.getElementById('letter-type').value;
            const jabatan = document.getElementById('input-jabatan').value || '';
            const isSekretaris = jabatan.toUpperCase().includes('SEKRETARIS');
            const previewContainer = document.getElementById('letter-preview');

            // Hapus class sppd-preview dulu
            previewContainer.classList.remove('sppd-preview');
            
            createKopSurat(type, jabatan);
            
            if (type === 'SPPD') {
                previewContainer.classList.add('padding-sppd');
                previewContainer.classList.add('sppd-preview'); // Tambah class untuk ukuran F4
                document.getElementById('group-tanggal-umum').style.display = 'none';
            } else {
                previewContainer.classList.remove('padding-sppd');
                document.getElementById('group-tanggal-umum').style.display = 'block';
            }

            ['preview-surat-dinas', 'preview-nota', 'preview-tugas', 'preview-sppd-depan', 'preview-sppd-belakang'].forEach(id => {
                document.getElementById(id).classList.add('hidden');
            });
            
            document.getElementById('tembusan-section').style.display = 'none';
            document.getElementById('general-signature').style.display = 'block';

            const tglText = document.getElementById('tanggal').value;
            const nomorVal = document.getElementById('nomor').value;
            const alamatKantor = document.getElementById('alamat-kantor')?.value || 'Jalan Sriwijaya No. 17 Pekalongan 51119'; // masih ada untuk fallback, tapi tidak dipakai di tampilan

            if (type === 'SURAT DINAS') {
                document.getElementById('preview-surat-dinas').classList.remove('hidden');
                
                // Ambil nilai penerima
                const penerimaVal = document.getElementById('penerima').value;
                document.getElementById('sd-penerima').innerHTML = penerimaVal || "...";
                
                document.getElementById('sd-nomor').innerText = nomorVal;
                document.getElementById('sd-sifat').innerText = document.getElementById('sifat').value;
                document.getElementById('sd-lampiran').innerText = document.getElementById('lampiran').value;
                document.getElementById('sd-perihal').innerText = document.getElementById('perihal').value;
                document.getElementById('sd-tempat').innerText = document.getElementById('tujuan-tempat').value || "Tempat";
                document.getElementById('sd-isi').innerHTML = formatIsiSurat(document.getElementById('isi').value);
                
                // Set tanggal saja, alamat sudah di kop
                document.getElementById('sd-tanggal').innerText = tglText;
                
                const tembusanVal = document.getElementById('tembusan').value;
                if(tembusanVal && tembusanVal.trim() !== "" && tembusanVal !== "-") {
                    document.getElementById('tembusan-section').style.display = 'block';
                    document.getElementById('tembusan-list-content').innerHTML = generateList(tembusanVal, '1');
                }

            } else if (type === 'NOTA DINAS') {
                document.getElementById('preview-nota').classList.remove('hidden');
                
                // Untuk Nota Dinas, kita gunakan field penerima yang sama
                const penerimaVal = document.getElementById('penerima').value;
                document.getElementById('nota-kepada').innerHTML = penerimaVal || "...";
                
                // Set "Dari" berdasarkan role yang dipilih dari input manual
                if (isSekretaris) {
                    document.getElementById('nota-dari').innerText = 'Sekretaris KPU Kota Pekalongan';
                } else {
                    document.getElementById('nota-dari').innerText = 'Ketua KPU Kota Pekalongan';
                }
                document.getElementById('nota-tembusan').innerText = document.getElementById('tembusan').value;
                document.getElementById('nota-nomor').innerText = nomorVal;
                document.getElementById('nota-tanggal').innerText = tglText;
                document.getElementById('nota-sifat').innerText = document.getElementById('sifat').value;
                document.getElementById('nota-lampiran').innerText = document.getElementById('lampiran').value;
                document.getElementById('nota-perihal').innerText = document.getElementById('perihal').value;
                document.getElementById('nota-isi').innerHTML = formatIsiSurat(document.getElementById('isi').value);

            } else if (type === 'SURAT TUGAS') {
                document.getElementById('preview-tugas').classList.remove('hidden');
                document.getElementById('prev-nomor-tugas').innerText = nomorVal;
                document.getElementById('prev-menimbang').innerHTML = generateList(document.getElementById('menimbang').value, 'a');
                document.getElementById('prev-dasar').innerHTML = generateList(document.getElementById('dasar').value, '1');
                document.getElementById('prev-untuk').innerHTML = document.getElementById('untuk').value.replace(/\n/g, '<br>');
                document.getElementById('prev-anggaran').innerHTML = document.getElementById('anggaran').value.replace(/\n/g, '<br>');
                
                const kepadaText = document.getElementById('kepada').value;
                if (kepadaText && kepadaText.trim() !== "") {
                    const kepadaLines = kepadaText.split('\n').filter(line => line.trim() !== "");
                    let kepadaHtml = '';
                    kepadaLines.forEach((line, index) => {
                        const cleanLine = line.replace(/^[0-9]\.\s|^-\s/i, '').trim();
                        if (cleanLine) {
                            kepadaHtml += `<div style="margin-bottom: 3px;">${index + 1}. ${cleanLine}</div>`;
                        }
                    });
                    document.getElementById('prev-kepada-tugas').innerHTML = kepadaHtml;
                } else {
                    document.getElementById('prev-kepada-tugas').innerHTML = "...";
                }
                
                // Untuk Surat Tugas, tanda tangan menggunakan data dari form penandatangan manual
                // Tampilkan tanggal surat di atas jabatan penandatangan
                if(tglText) {
                    const tempatTanggal = tglText.includes(',') ? tglText : `Pekalongan, ${tglText}`;
                    document.getElementById('sign-jabatan').innerHTML = `<div style="margin-bottom: 12px;">${tempatTanggal}</div>` + jabatan;
                } else {
                    document.getElementById('sign-jabatan').innerHTML = jabatan;
                }

            } else if (type === 'SPPD') {
                document.getElementById('general-signature').style.display = 'none';
                const sppdPage = document.querySelector('input[name="sppd_page"]:checked').value;
                
                const ppkNama = document.getElementById('sppd-ppk-nama').value;
                const ppkNip = document.getElementById('sppd-ppk-nip').value;

                // Tampilkan hanya halaman yang dipilih sesuai radio button
                const previewContainer = document.getElementById('letter-preview');
                if (sppdPage === 'depan') {
                    document.getElementById('preview-sppd-depan').classList.remove('hidden');
                    document.getElementById('preview-sppd-belakang').classList.add('hidden');
                    previewContainer.classList.remove('sppd-belakang-active');
                } else {
                    document.getElementById('preview-sppd-depan').classList.add('hidden');
                    document.getElementById('preview-sppd-belakang').classList.remove('hidden');
                    previewContainer.classList.add('sppd-belakang-active');
                }
                
                // Update data untuk halaman depan
                document.getElementById('prev-sppd-lembar').innerText = document.getElementById('sppd-lembar-manual').value;
                document.getElementById('prev-sppd-kode-no').innerText = document.getElementById('sppd-kode-no').value;
                document.getElementById('prev-sppd-nomor').innerText = document.getElementById('sppd-nomor').value;

                document.getElementById('prev-sppd-ppk-nama').innerText = ppkNama;
                document.getElementById('prev-sppd-nama').innerText = document.getElementById('sppd-nama').value;
                document.getElementById('prev-sppd-nip').innerHTML = "NIP. " + document.getElementById('sppd-nip').value;
                
                document.getElementById('prev-sppd-pangkat').innerText = document.getElementById('sppd-pangkat').value;
                document.getElementById('prev-sppd-jabatan').innerText = document.getElementById('sppd-jabatan').value;
                document.getElementById('prev-sppd-biaya').innerText = document.getElementById('sppd-biaya').value;
                
                document.getElementById('prev-sppd-maksud').innerText = document.getElementById('sppd-maksud').value;
                document.getElementById('prev-sppd-transport').innerText = document.getElementById('sppd-transport').value;
                
                document.getElementById('prev-sppd-berangkat').innerText = document.getElementById('sppd-berangkat').value;
                document.getElementById('prev-sppd-tujuan').innerText = document.getElementById('sppd-tujuan').value;
                
                document.getElementById('prev-sppd-lama').innerText = document.getElementById('sppd-lama').value;
                document.getElementById('prev-sppd-tgl-berangkat').innerText = document.getElementById('sppd-tgl-berangkat').value;
                document.getElementById('prev-sppd-tgl-kembali').innerText = document.getElementById('sppd-tgl-kembali').value;
                
                document.getElementById('prev-sppd-instansi').innerText = document.getElementById('sppd-instansi').value;
                document.getElementById('prev-sppd-akun').innerText = document.getElementById('sppd-akun').value;
                document.getElementById('prev-sppd-lain').innerText = document.getElementById('sppd-lain').value;

                let htmlList = "";
                let rowCount = pengikutList.length > 0 ? pengikutList.length : 1; 
                for (let i = 0; i < rowCount; i++) {
                    const p = pengikutList[i] || {nama:'', tgl:'', ket:''};
                    const num = i + 1;
                    htmlList += `<tr>
                        <td class="n8-col-nama" style="border-bottom:1px solid #000; padding:3px 4px; font-size: 10pt;">${num}. ${p.nama}</td>
                        <td class="n8-col-tgl" style="border-bottom:1px solid #000; padding:3px 4px; text-align:center; font-size: 10pt;">${p.tgl}</td>
                        <td class="n8-col-ket" style="border-bottom:1px solid #000; padding:3px 4px; text-align:center; font-size: 10pt;">${p.ket}</td>
                    <tr>`;
                }
                document.getElementById('prev-list-pengikut-body').innerHTML = htmlList;

                const place = document.getElementById('sppd-dikeluarkan').value;
                const date = document.getElementById('sppd-tgl-validasi').value;
                document.getElementById('prev-sppd-dikeluarkan').innerText = place;
                document.getElementById('prev-sppd-tgl-surat').innerText = date;
                
                // Format nama PPK dengan tanda kurung, tidak tebal dan tidak bergaris bawah (CSS sudah diatur)
                document.getElementById('ppk-sign-name').innerText = ppkNama ? `(${ppkNama})` : "( )";
                document.getElementById('ppk-sign-nip').innerHTML = ppkNip ? 'NIP. ' + ppkNip : 'NIP. -';

                // Update data untuk halaman belakang
                document.getElementById('v-b1-asal2').innerText = document.getElementById('back-berangkat-dari-kanan').value || '';
                document.getElementById('v-b1-ke2').innerText = document.getElementById('back-berangkat-ke-kanan').value || '';
                document.getElementById('v-b1-tgl2').innerText = document.getElementById('back-berangkat-tgl-kanan').value || '';
                document.getElementById('v-b1-kepala2').innerText = document.getElementById('back-berangkat-kepala-kanan')?.value || '';
                document.getElementById('v-b1-nama2').innerText = document.getElementById('back-berangkat-nama-kanan').value || '';
                document.getElementById('v-b1-nip2').innerHTML = document.getElementById('back-berangkat-nip-kanan').value ? 'NIP. ' + document.getElementById('back-berangkat-nip-kanan').value : '';
                
                document.getElementById('v-b2-tiba').innerText = document.getElementById('back-ii-tiba').value || '';
                document.getElementById('v-b2-tiba-tgl').innerText = document.getElementById('back-ii-tiba-tgl').value || '';
                document.getElementById('v-b2-tiba-kepala').innerText = document.getElementById('back-ii-tiba-kepala').value || '';
                
                document.getElementById('v-b2-berangkat').innerText = document.getElementById('back-ii-berangkat').value || '';
                document.getElementById('v-b2-berangkat-ke').innerText = document.getElementById('back-ii-berangkat-ke')?.value || '................................';
                document.getElementById('v-b2-berangkat-tgl').innerText = document.getElementById('back-ii-berangkat-tgl').value || '';
                document.getElementById('v-b2-berangkat-kepala').innerText = document.getElementById('back-ii-berangkat-kepala').value || '';
                
                document.getElementById('v-b3-tiba').innerText = document.getElementById('back-iii-tiba').value || '';
                document.getElementById('v-b3-tiba-tgl').innerText = document.getElementById('back-iii-tiba-tgl').value || '';
                document.getElementById('v-b3-tiba-kepala').innerText = document.getElementById('back-iii-tiba-kepala').value || '';
                
                document.getElementById('v-b3-berangkat').innerText = document.getElementById('back-iii-berangkat').value || '';
                document.getElementById('v-b3-berangkat-ke').innerText = document.getElementById('back-iii-berangkat-ke')?.value || '................................';
                document.getElementById('v-b3-berangkat-tgl').innerText = document.getElementById('back-iii-berangkat-tgl').value || '';
                document.getElementById('v-b3-berangkat-kepala').innerText = document.getElementById('back-iii-berangkat-kepala').value || '';
                
                document.getElementById('v-b4-tiba').innerText = document.getElementById('back-iv-tiba').value || '';
                document.getElementById('v-b4-tiba-tgl').innerText = document.getElementById('back-iv-tiba-tgl').value || '';
                document.getElementById('v-b4-tiba-kepala').innerText = document.getElementById('back-iv-tiba-kepala').value || '';
                
                document.getElementById('v-b4-berangkat').innerText = document.getElementById('back-iv-berangkat').value || '';
                document.getElementById('v-b4-berangkat-ke').innerText = document.getElementById('back-iv-berangkat-ke')?.value || '................................';
                document.getElementById('v-b4-berangkat-tgl').innerText = document.getElementById('back-iv-berangkat-tgl').value || '';
                document.getElementById('v-b4-berangkat-kepala').innerText = document.getElementById('back-iv-berangkat-kepala').value || '';
                
                document.getElementById('v-b5-tiba').innerText = document.getElementById('back-v-tiba').value || '';
                document.getElementById('v-b5-tiba-tgl').innerText = document.getElementById('back-v-tiba-tgl').value || '';
                document.getElementById('v-b5-tiba-kepala').innerText = document.getElementById('back-v-tiba-kepala').value || '';
                
                document.getElementById('v-b5-berangkat').innerText = document.getElementById('back-v-berangkat').value || '';
                document.getElementById('v-b5-berangkat-ke').innerText = document.getElementById('back-v-berangkat-ke')?.value || '................................';
                document.getElementById('v-b5-berangkat-tgl').innerText = document.getElementById('back-v-berangkat-tgl').value || '';
                document.getElementById('v-b5-berangkat-kepala').innerText = document.getElementById('back-v-berangkat-kepala').value || '';
                
                // Update data untuk kolom VI - Tempat Kedudukan selalu ditampilkan
                document.getElementById('v-b6-tiba').innerText = document.getElementById('back-vi-tiba').value || '';
                
                document.getElementById('v-b6-tiba-tgl').innerText = document.getElementById('back-vi-tiba-tgl').value || '';
                
                // Nama PPK di halaman belakang (kiri) dengan format (Nama)
                const backNamaPpk = document.getElementById('back-vi-nama').value;
                document.getElementById('v-ppk-nama').innerText = backNamaPpk ? `(${backNamaPpk})` : "( )";
                document.getElementById('v-ppk-nip').innerHTML = document.getElementById('back-vi-nip').value ? 'NIP. ' + document.getElementById('back-vi-nip').value : '';
                
                const keteranganText = document.getElementById('back-vi-keterangan')?.value || 'Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.';
                document.getElementById('v-vi-keterangan').innerHTML = keteranganText + '<div style="height:10px;"></div>';
                
                // Nama PPK di halaman belakang (kanan) dengan format (Nama)
                const backNamaPpkKanan = document.getElementById('back-vi-nama-kanan')?.value;
                document.getElementById('v-vi-nama-kanan').innerText = backNamaPpkKanan ? `(${backNamaPpkKanan})` : "( )";
                document.getElementById('v-vi-nip-kanan').innerHTML = document.getElementById('back-vi-nip-kanan')?.value ? 'NIP. ' + document.getElementById('back-vi-nip-kanan').value : '';
                
                document.getElementById('v-catatan').innerText = document.getElementById('back-catatan').value || '';
                
                return;
            }

            // Update tanda tangan umum untuk Surat Dinas, Nota Dinas, dan Surat Tugas (khusus Surat Tugas sudah ditangani di atas, namun untuk amannya tetap di sini)
            // Tapi untuk Surat Tugas sudah diisi di bagian khusus, jadi abaikan untuk type SURAT TUGAS.
            if (type !== 'SURAT TUGAS') {
                document.getElementById('sign-jabatan').innerText = jabatan;
                const namaTtd = document.getElementById('input-nama-ttd').value;
                if (type === 'SURAT DINAS') {
                    document.getElementById('sign-name').innerText = namaTtd ? namaTtd : "Nama";
                    document.getElementById('sign-name').style.textDecoration = "underline";
                    document.getElementById('sign-name').style.fontWeight = "bold";
                } else {
                    document.getElementById('sign-name').innerText = namaTtd ? `(${namaTtd})` : "( Nama )";
                    document.getElementById('sign-name').style.textDecoration = "none";
                    document.getElementById('sign-name').style.fontWeight = "normal";
                }
                
                const nipVal = document.getElementById('input-nip-ttd').value;
                const nipEl = document.getElementById('sign-nip');
                
                if(nipVal && nipVal.trim() !== "") {
                    nipEl.style.display = "block";
                    if (nipVal.trim() === "*") {
                        nipEl.innerText = "*";
                        nipEl.style.textAlign = "center";
                    } else {
                        nipEl.innerText = "NIP. " + nipVal;
                    }
                } else {
                    nipEl.style.display = "none";
                }
            } else {
                // Untuk Surat Tugas, tanda tangan sudah diatur di bagian khusus, namun pastikan sign-name dan sign-nip tetap diisi
                const namaTtd = document.getElementById('input-nama-ttd').value;
                document.getElementById('sign-name').innerText = namaTtd ? `(${namaTtd})` : "( Nama )";
                document.getElementById('sign-name').style.textDecoration = "none";
                document.getElementById('sign-name').style.fontWeight = "normal";
                const nipVal = document.getElementById('input-nip-ttd').value;
                const nipEl = document.getElementById('sign-nip');
                if(nipVal && nipVal.trim() !== "") {
                    nipEl.style.display = "block";
                    if (nipVal.trim() === "*") {
                        nipEl.innerText = "*";
                    } else {
                        nipEl.innerText = "NIP. " + nipVal;
                    }
                } else {
                    nipEl.style.display = "none";
                }
            }
        }

        function formatIsiSurat(text) {
            if (!text || text.trim() === "") return "";
            
            const paragraphs = text.split('\n');
            let html = "";
            
            paragraphs.forEach((p, index) => {
                const trimmedP = p.trim();
                if (trimmedP === "") {
                    html += '<div style="height: 12px;"></div>';
                } else {
                    if (trimmedP.includes(":") && 
                        (trimmedP.toLowerCase().includes("hari") || 
                         trimmedP.toLowerCase().includes("waktu") || 
                         trimmedP.toLowerCase().includes("tempat") ||
                         trimmedP.toLowerCase().includes("pukul") ||
                         trimmedP.toLowerCase().includes("tanggal"))) {
                        
                        const parts = trimmedP.split(":");
                        const label = parts[0].trim();
                        const value = parts.slice(1).join(":").trim();
                        
                        // Capitalize label
                        const capLabel = label.charAt(0).toUpperCase() + label.slice(1);
                        
                        html += `<div style="display: flex; margin-left: 0; margin-bottom: 8px;">
                                    <div style="width: 120px; font-weight: normal;">${capLabel}</div>
                                    <div style="width: 15px; text-align: center;">:</div>
                                    <div style="flex: 1;">${value}</div>
                                 </div>`;
                    } else {
                        // Capitalize first letter of paragraph automatically
                        const capitalizedP = trimmedP.charAt(0).toUpperCase() + trimmedP.slice(1);
                        html += `<p style="text-indent: 1.27cm; margin-bottom: 8px; margin-top: 0; text-align: justify; line-height: 1.5;">${capitalizedP}</p>`;
                    }
                }
            });
            
            return html;
        }

        // FUNGSI DOWNLOAD PDF - UKURAN F4 UNTUK SPPD, DIPERKECIL PADDINGNYA
        function downloadPDF() {
            try {
                const element = document.getElementById('letter-preview');
                const divDepan = document.getElementById('preview-sppd-depan');
                const divBelakang = document.getElementById('preview-sppd-belakang');
                
                if (!element) {
                    throw new Error("Elemen preview tidak ditemukan");
                }

                const type = document.getElementById('letter-type').value;
                const timestamp = new Date().getTime();
                
                let fileName = `Surat_${type.replace(/\s+/g, '_')}_${timestamp}.pdf`;
                const isSppd = (type === 'SPPD');
                
                if (isSppd) {
                    fileName = `SPPD_Lengkap_${timestamp}.pdf`;
                }

                const btn = document.querySelector('.btn-primary');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> MEMPROSES PDF...';
                btn.disabled = true;
                
                // Simpan style asli
                const originalStyles = {
                    width: element.style.width,
                    padding: element.style.padding,
                    margin: element.style.margin,
                    className: element.className,
                    overflow: element.style.overflow,
                    maxWidth: element.style.maxWidth,
                    position: element.style.position,
                    fontSize: element.style.fontSize,
                    transform: element.style.transform,
                    zoom: element.style.zoom,
                    lineHeight: element.style.lineHeight,
                    backgroundColor: element.style.backgroundColor,
                    boxShadow: element.style.boxShadow
                };
                
                // Simpan state display asli untuk sppd depan & belakang
                const depanOriginalDisplay = divDepan ? divDepan.style.display : '';
                const belakangOriginalDisplay = divBelakang ? divBelakang.style.display : '';
                const depanOriginalClass = divDepan ? divDepan.className : '';
                const belakangOriginalClass = divBelakang ? divBelakang.className : '';
                
                // Reset dan set style untuk PDF - UKURAN BERDASARKAN JENIS SURAT
                if (isSppd) {
                    // Paksa tampilkan keduanya
                    if (divDepan) {
                        divDepan.classList.remove('hidden');
                        divDepan.style.display = 'block';
                        divDepan.style.padding = '5mm 6mm 5mm 10mm'; // Margin atas 5mm, bawah 5mm
                        divDepan.style.fontSize = '12pt';
                        divDepan.style.boxSizing = 'border-box';
                    }
                    if (divBelakang) {
                        divBelakang.classList.remove('hidden');
                        divBelakang.style.display = 'block';
                        // Padding untuk belakang (top 10mm, right 5mm, bottom 5mm, left 8mm)
                        divBelakang.style.padding = '10mm 5mm 0mm 8mm'; // Padding bawah 0 agar tidak meluap ke halaman 3
                        divBelakang.style.fontSize = '10pt';
                        divBelakang.style.boxSizing = 'border-box';
                        
                        // Menambahkan page-break sebelum elemen belakang menggunakan CSS saja
                        divBelakang.style.pageBreakBefore = 'always';
                        // Hapus class agar tidak terjadi double page break
                        divBelakang.classList.remove('html2pdf__page-break');
                    }
                    
                    // Hilangkan padding pada elemen induk karena padding sekarang diatur di child
                    element.style.width = '215mm';
                    element.style.maxWidth = '215mm';
                    element.style.padding = '0'; 
                    element.style.minHeight = 'auto'; // Pastikan tidak dipaksa melebihi konten
                    element.classList.add('sppd-preview');
                    
                    // Optimasi khusus untuk SPPD halaman belakang
                    if (divBelakang) {
                        const backGrid = divBelakang.querySelector('.sppd-back-grid');
                        if (backGrid) {
                            backGrid.style.width = '100%';
                            backGrid.style.tableLayout = 'fixed';
                            backGrid.style.fontSize = '10pt';
                            
                            const cells = backGrid.querySelectorAll('td');
                            cells.forEach(cell => {
                                cell.style.padding = '0px 1px';
                                cell.style.fontSize = '10pt';
                                cell.style.lineHeight = '1.0';
                            });
                            
                            // Kembalikan padding khusus untuk Baris 7 (Catatan Lain) dan Baris 8 (Perhatian) agar teks tidak menempel garis
                            const baris7_8 = backGrid.querySelectorAll('tr:nth-child(7) td, tr:nth-child(8) td');
                            baris7_8.forEach(cell => {
                                cell.style.padding = '3px 6px';
                            });
                        }
                        
                        // Perkecil juga font untuk elemen-elemen tertentu
                        const dataRows = divBelakang.querySelectorAll('.sppd-data-row-fixed');
                        dataRows.forEach(row => {
                            row.style.marginBottom = '0px';
                            row.style.minHeight = '12px';
                        });
                        
                        // Label dan value
                        const labels = divBelakang.querySelectorAll('.sppd-label-fixed, .sppd-value-fixed, .sppd-value-fixed-wrap');
                        labels.forEach(label => {
                            label.style.fontSize = '10pt';
                        });
                        
                        // Perpanjang titik-titik
                        const titikKiri = divBelakang.querySelectorAll('.titik-ttd.kiri-turun');
                        titikKiri.forEach(titik => {
                            titik.innerText = '(.............................)';
                            titik.style.marginTop = '2px';
                            titik.style.fontSize = '10pt';
                        });
                        
                        const titikKanan = divBelakang.querySelectorAll('.titik-ttd.kanan-turun');
                        titikKanan.forEach(titik => {
                            titik.innerText = '(.............................)';
                            titik.style.marginTop = '2px';
                            titik.style.fontSize = '10pt';
                        });
                        
                        // Kurangi jarak signature
                        const signatures = divBelakang.querySelectorAll('.sppd-signature-ppk, .sppd-signature-ppk-kanan');
                        signatures.forEach(sig => {
                            sig.style.marginTop = '-15px';
                        });
                        
                        // JS Override dihapus agar mengikuti CSS sepenuhnya
                        // const sekretaris = divBelakang.querySelectorAll('.sppd-signature.sekretaris-column .jabatan');
                        // sekretaris.forEach(jab => {
                        //     jab.style.marginBottom = '5px';
                        //     jab.style.fontSize = '10pt';
                        // });
                        
                        const sekretarisNama = divBelakang.querySelectorAll('.sppd-signature.sekretaris-column .nama, .sppd-signature.sekretaris-column .nip');
                        sekretarisNama.forEach(el => {
                            el.style.fontSize = '10pt';
                        });
                        
                        // JS Override dihapus agar mengikuti CSS sepenuhnya
                        // const ppkJabatan = divBelakang.querySelectorAll('.jabatan-ppk, .jabatan-ppk-kanan');
                        // ppkJabatan.forEach(jab => {
                        //     jab.style.marginBottom = '5px';
                        //     jab.style.fontSize = '10pt';
                        // });
                        
                        const ppkNama = divBelakang.querySelectorAll('.nama-ppk, .nama-ppk-kanan, .nip-ppk, .nip-ppk-kanan');
                        ppkNama.forEach(el => {
                            el.style.fontSize = '10pt';
                        });
                        
                        // TAMBAHKAN JARAK UNTUK PEJABAT PEMBUAT KOMITMEN (KE BAWAH)
                        // JS Override dihapus agar mengikuti CSS sepenuhnya
                    }
                } else {
                    // Ukuran A4 untuk surat lainnya (210mm x 297mm)
                    element.style.width = '210mm';
                    element.style.minHeight = '297mm';
                    element.style.maxWidth = '210mm';
                    element.style.padding = '5mm 10mm 5mm 15mm';
                    element.style.fontSize = '12pt';
                    element.classList.remove('sppd-preview');
                }
                
                element.style.margin = '0 auto';
                element.style.backgroundColor = 'white';
                element.style.boxShadow = 'none';
                element.style.position = 'relative';
                element.style.overflow = 'visible';
                element.style.float = 'none';
                element.style.display = 'block';
                element.style.transform = 'none';
                element.style.zoom = '1';
                element.style.lineHeight = '1.4';
                element.style.color = 'black';
                element.style.textAlign = 'left';
                element.style.fontFamily = "'Tahoma', 'Arial', sans-serif";
                
                // Tentukan format PDF berdasarkan jenis surat
                const pdfFormat = isSppd ? [215, 330] : 'a4'; // F4 = 215mm x 330mm
                
                // Opsi PDF
                const opt = {
                    margin: isSppd ? [0, 0, 0, 0] : [0, 0, 15, 0], // Hapus margin bawah agar tidak memancing halaman kosong
                    filename: fileName,
                    image: { type: 'jpeg', quality: 1.0 },
                    html2canvas: { 
                        scale: 2,
                        useCORS: true,
                        letterRendering: true,
                        logging: false,
                        allowTaint: false,
                        backgroundColor: '#ffffff',
                        windowWidth: isSppd ? 215 : 210,
                        windowHeight: isSppd ? 330 : 297,
                        scrollX: 0,
                        scrollY: 0,
                        x: 0,
                        y: 0,
                        onclone: function(clonedDoc) {
                            if (isSppd) {
                                const clonedBelakang = clonedDoc.getElementById('preview-sppd-belakang');
                                if (clonedBelakang) {
                                    const clonedTitikKiri = clonedBelakang.querySelectorAll('.titik-ttd.kiri-turun');
                                    clonedTitikKiri.forEach(titik => {
                                        titik.innerText = '(.............................)';
                                    });
                                    
                                    const clonedTitikKanan = clonedBelakang.querySelectorAll('.titik-ttd.kanan-turun');
                                    clonedTitikKanan.forEach(titik => {
                                        titik.innerText = '(.............................)';
                                    });
                                    
                                    // Tambah jarak untuk pejabat pembuat komitmen di clone
                                    // JS Override dihapus agar mengikuti CSS sepenuhnya
                                }
                            }
                        }
                    },
                    jsPDF: { 
                        unit: 'mm', 
                        format: pdfFormat, 
                        orientation: 'portrait',
                        compress: true,
                        precision: 16
                    },
                    pagebreak: { mode: ['css', 'legacy'] }
                };
                
                // Gunakan html2pdf dengan timeout yang lebih lama
                setTimeout(() => {
                    html2pdf().set(opt).from(element).save()
                        .then(() => {
                            console.log('PDF berhasil dibuat');
                            
                            // Simpan ke Arsip Unduhan
                            try {
                                const type = document.getElementById('letter-type').value;
                                const nomor = (type === 'SPPD') ? document.getElementById('sppd-nomor').value : document.getElementById('nomor').value;
                                const tglSurat = (type === 'SPPD') ? document.getElementById('sppd-tgl-validasi').value : document.getElementById('tanggal').value;
                                
                                const formData = {};
                                const inputs = document.querySelectorAll('input, select, textarea');
                                inputs.forEach(input => {
                                    if (input.id) {
                                        if (input.type === 'radio') {
                                            if (input.checked) {
                                                formData[input.name] = input.value;
                                            }
                                        } else {
                                            formData[input.id] = input.value;
                                        }
                                    }
                                });
                                
                                if (type === 'SPPD') {
                                    formData['pengikutList'] = pengikutList;
                                }

                                const downloadTime = new Date().toLocaleString('id-ID', { 
                                    day: 'numeric', 
                                    month: 'short', 
                                    year: 'numeric', 
                                    hour: '2-digit', 
                                    minute: '2-digit' 
                                });

                                const archiveItem = {
                                    id: timestamp,
                                    fileName: fileName,
                                    type: type,
                                    nomor: nomor || '-',
                                    tglSurat: tglSurat || '-',
                                    downloadTime: downloadTime,
                                    formData: formData
                                };

                                let archive = JSON.parse(localStorage.getItem('letterArchive') || '[]');
                                archive.unshift(archiveItem);
                                if (archive.length > 20) {
                                    archive.pop();
                                }
                                localStorage.setItem('letterArchive', JSON.stringify(archive));
                                updateArchiveBadge();
                            } catch (e) {
                                console.error('Error saving to archive:', e);
                            }
                            
                            // Kembalikan style asli element utama
                            Object.keys(originalStyles).forEach(key => {
                                element.style[key] = originalStyles[key];
                            });
                            element.className = originalStyles.className;
                            
                            // Kembalikan style depan dan belakang
                            if (isSppd) {
                                if (divDepan) {
                                    divDepan.className = depanOriginalClass;
                                    divDepan.style.display = '';
                                    divDepan.style.padding = '';
                                    divDepan.style.fontSize = '';
                                    divDepan.style.minHeight = '';
                                    divDepan.style.boxSizing = '';
                                }
                                if (divBelakang) {
                                    divBelakang.className = belakangOriginalClass;
                                    divBelakang.style.display = '';
                                    divBelakang.style.padding = '';
                                    divBelakang.style.fontSize = '';
                                    divBelakang.style.boxSizing = '';
                                    divBelakang.style.pageBreakBefore = '';
                                    divBelakang.classList.remove('html2pdf__page-break');
                                }
                            }
                            
                            btn.innerHTML = originalText;
                            btn.disabled = false;
                        })
                        .catch((error) => {
                            console.error('Error detail:', error);
                            
                            // Kembalikan style asli element utama
                            Object.keys(originalStyles).forEach(key => {
                                element.style[key] = originalStyles[key];
                            });
                            element.className = originalStyles.className;
                            
                            // Kembalikan style depan dan belakang
                            if (isSppd) {
                                if (divDepan) {
                                    divDepan.className = depanOriginalClass;
                                    divDepan.style.display = '';
                                    divDepan.style.padding = '';
                                    divDepan.style.fontSize = '';
                                    divDepan.style.minHeight = '';
                                    divDepan.style.boxSizing = '';
                                }
                                if (divBelakang) {
                                    divBelakang.className = belakangOriginalClass;
                                    divBelakang.style.display = '';
                                    divBelakang.style.padding = '';
                                    divBelakang.style.fontSize = '';
                                    divBelakang.style.boxSizing = '';
                                    divBelakang.style.pageBreakBefore = '';
                                    divBelakang.classList.remove('html2pdf__page-break');
                                }
                            }
                            
                            alert('Gagal membuat PDF. Silakan coba lagi.\nError: ' + error.message);
                            btn.innerHTML = originalText;
                            btn.disabled = false;
                        });
                }, 500);
                    
            } catch (error) {
                console.error('Error di fungsi downloadPDF:', error);
                alert('Terjadi kesalahan: ' + error.message);
                
                const btn = document.querySelector('.btn-primary');
                if (btn) {
                    btn.innerHTML = '<i class="fas fa-file-pdf"></i> CETAK PDF';
                    btn.disabled = false;
                }
            }
        }

        // ==========================================
        // FITUR ARSIP UNDUHAN SURAT & DYNAMIC DATE
        // ==========================================
        function updateHeaderDate() {
            const headerTgl = document.getElementById('header-tanggal-surat');
            if (headerTgl) {
                const type = document.getElementById('letter-type').value;
                let tglValue = '';
                if (type === 'SPPD') {
                    const el = document.getElementById('sppd-tgl-validasi');
                    tglValue = el ? el.value : '';
                } else {
                    const el = document.getElementById('tanggal');
                    tglValue = el ? el.value : '';
                }
                headerTgl.innerText = tglValue && tglValue.trim() !== '' ? tglValue : '-';
            }
        }

        const ArchiveState = {
            currentPage: 1,
            pageSize: 15,
            searchQuery: "",
            sortColumn: "id",
            sortOrder: "desc",
            filteredItems: []
        };

        function getArchivePerihal(item) {
            if (!item.formData) return '-';
            if (item.type === 'SPPD') {
                return item.formData['sppd-maksud'] || '-';
            }
            if (item.type === 'SURAT TUGAS') {
                return item.formData['untuk'] || '-';
            }
            return item.formData['perihal'] || '-';
        }

        function getArchiveTujuan(item) {
            if (!item.formData) return '-';
            if (item.type === 'SPPD') {
                return item.formData['sppd-tujuan'] || '-';
            }
            if (item.type === 'SURAT TUGAS') {
                return item.formData['kepada'] || '-';
            }
            return item.formData['penerima'] || '-';
        }

        function setFormData(item) {
            const typeSelect = document.getElementById('letter-type');
            if (typeSelect && item.type) {
                typeSelect.value = item.type;
                checkLetterType();
            }

            const formData = item.formData || {};
            Object.keys(formData).forEach(key => {
                if (key === 'pengikutList') {
                    pengikutList = formData[key] || [];
                    renderPengikutInputs();
                } else {
                    const el = document.getElementById(key);
                    if (el) {
                        if (el.type === 'radio') {
                            // Handled separately
                        } else {
                            el.value = formData[key];
                        }
                    }
                }
            });

            if (formData['sppd_page']) {
                const radio = document.querySelector(`input[name="sppd_page"][value="${formData['sppd_page']}"]`);
                if (radio) radio.checked = true;
            }

            const hiddenJabatan = document.getElementById('input-jabatan');
            if (hiddenJabatan && formData['input-jabatan']) {
                hiddenJabatan.value = formData['input-jabatan'];
            }

            const selectJabatan = document.getElementById('jabatan-penandatangan');
            if (selectJabatan && formData['input-jabatan']) {
                selectJabatan.value = formData['input-jabatan'];
            }

            checkLetterType(); 
            updatePreview();
            updateHeaderDate();
        }

        function downloadArchivedPDF(id) {
            let archive = JSON.parse(localStorage.getItem('letterArchive') || '[]');
            const item = archive.find(x => x.id === id);
            if (!item) return;

            // Keep current form data to restore after download
            const currentType = document.getElementById('letter-type').value;
            const currentFormData = {};
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                if (input.id && input.type !== 'radio') {
                    currentFormData[input.id] = input.value;
                }
            });
            const currentPengikut = [...pengikutList];
            
            // Set the archived letter data
            setFormData(item);
            
            // Download the PDF
            downloadPDF();
            
            // Restore current form data after a short timeout to let downloadPDF complete
            setTimeout(() => {
                const typeSelect = document.getElementById('letter-type');
                if (typeSelect) {
                    typeSelect.value = currentType;
                    checkLetterType();
                }
                
                Object.keys(currentFormData).forEach(key => {
                    const el = document.getElementById(key);
                    if (el) el.value = currentFormData[key];
                });
                
                pengikutList = currentPengikut;
                renderPengikutInputs();
                
                checkLetterType();
                updatePreview();
                updateHeaderDate();
            }, 1200);
        }

        function openArchiveModal() {
            const modal = document.getElementById('archive-modal');
            if (modal) {
                modal.style.display = 'flex';
                const searchInput = document.getElementById('archive-search');
                if (searchInput) searchInput.value = '';
                ArchiveState.currentPage = 1;
                ArchiveState.searchQuery = '';
                renderArchiveList();
            }
        }

        function closeArchiveModal() {
            const modal = document.getElementById('archive-modal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        function renderArchiveList() {
            const searchInput = document.getElementById('archive-search');
            if (searchInput) {
                ArchiveState.searchQuery = searchInput.value;
            } else {
                ArchiveState.searchQuery = "";
            }
            
            let archive = JSON.parse(localStorage.getItem('letterArchive') || '[]');
            
            // Filter
            const query = ArchiveState.searchQuery.toLowerCase().trim();
            if (query === "") {
                ArchiveState.filteredItems = [...archive];
            } else {
                ArchiveState.filteredItems = archive.filter(item => {
                    const nomor = (item.nomor || "").toLowerCase();
                    const tanggal = (item.tglSurat || "").toLowerCase();
                    const file = (item.fileName || "").toLowerCase();
                    const type = (item.type || "").toLowerCase();
                    const perihal = getArchivePerihal(item).toLowerCase();
                    const tujuan = getArchiveTujuan(item).toLowerCase();
                    
                    return nomor.includes(query) || 
                           tanggal.includes(query) || 
                           file.includes(query) || 
                           type.includes(query) || 
                           perihal.includes(query) || 
                           tujuan.includes(query);
                });
            }

            // Sort
            const column = ArchiveState.sortColumn;
            const order = ArchiveState.sortOrder === 'asc' ? 1 : -1;
            
            ArchiveState.filteredItems.sort((a, b) => {
                let valA = '';
                let valB = '';
                
                switch (column) {
                    case 'nomor':
                        valA = a.nomor || '';
                        valB = b.nomor || '';
                        break;
                    case 'tanggal':
                        valA = a.tglSurat || '';
                        valB = b.tglSurat || '';
                        break;
                    case 'perihal':
                        valA = getArchivePerihal(a);
                        valB = getArchivePerihal(b);
                        break;
                    case 'tujuan':
                        valA = getArchiveTujuan(a);
                        valB = getArchiveTujuan(b);
                        break;
                    case 'file':
                        valA = a.fileName || '';
                        valB = b.fileName || '';
                        break;
                    default:
                        valA = a.id;
                        valB = b.id;
                }
                
                return valA.toString().localeCompare(valB.toString(), undefined, {numeric: true, sensitivity: 'base'}) * order;
            });

            renderArchiveTable();
            updateSortIcons();
        }

        function renderArchiveTable() {
            const tableBody = document.getElementById('archive-table-body');
            const entriesInfo = document.getElementById('archive-entries-info');
            const pagination = document.getElementById('archive-pagination');
            
            if (!tableBody) return;

            const totalItems = ArchiveState.filteredItems.length;
            const totalPages = Math.ceil(totalItems / ArchiveState.pageSize);
            
            // Adjust current page
            if (ArchiveState.currentPage > totalPages) {
                ArchiveState.currentPage = totalPages > 0 ? totalPages : 1;
            }
            if (ArchiveState.currentPage < 1) {
                ArchiveState.currentPage = 1;
            }

            if (totalItems === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 30px; color: #7f8c8d; font-size: 13px;">
                            Tidak ada data arsip yang cocok.
                        </td>
                    </tr>
                `;
                if (entriesInfo) entriesInfo.innerText = "Showing 0 to 0 of 0 entries";
                if (pagination) pagination.innerHTML = "";
                return;
            }

            const startIndex = (ArchiveState.currentPage - 1) * ArchiveState.pageSize;
            const endIndex = Math.min(startIndex + ArchiveState.pageSize, totalItems);
            const pageItems = ArchiveState.filteredItems.slice(startIndex, endIndex);

            let html = "";
            pageItems.forEach((item, index) => {
                const globalIndex = startIndex + index + 1;
                const rowBg = index % 2 === 1 ? '#f8fafc' : '#ffffff';
                const cleanFileName = item.fileName || 'Download PDF';
                
                html += `
                    <tr style="background-color: ${rowBg}; border-bottom: 1px solid #e2e8f0; transition: background-color 0.15s;" onmouseover="this.style.backgroundColor='#f1f5f9'" onmouseout="this.style.backgroundColor='${rowBg}'">
                        <td style="padding: 10px; text-align: center; border-right: 1px solid #cbd5e1; color: #475569;">${globalIndex}</td>
                        <td style="padding: 10px 15px; border-right: 1px solid #cbd5e1; font-weight: 500; color: #1e293b;">${item.nomor || '-'}</td>
                        <td style="padding: 10px 15px; border-right: 1px solid #cbd5e1; color: #475569;">${item.tglSurat || '-'}</td>
                        <td style="padding: 10px 15px; border-right: 1px solid #cbd5e1; color: #475569; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="${getArchivePerihal(item)}">${getArchivePerihal(item)}</td>
                        <td style="padding: 10px 15px; border-right: 1px solid #cbd5e1; color: #475569; max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="${getArchiveTujuan(item)}">${getArchiveTujuan(item)}</td>
                        <td style="padding: 10px 15px; border-right: 1px solid #cbd5e1;">
                            <a onclick="downloadArchivedPDF(${item.id})" style="color: #2563eb; text-decoration: none; cursor: pointer; font-weight: 500;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                                ${cleanFileName}
                            </a>
                        </td>
                        <td style="padding: 10px; text-align: center;">
                            <div style="display: flex; gap: 6px; justify-content: center;">
                                <button onclick="loadArchivedLetter(${item.id})" style="background-color: #f59e0b; color: white; border: none; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 600; cursor: pointer; transition: background-color 0.15s;" onmouseover="this.style.backgroundColor='#d97706'" onmouseout="this.style.backgroundColor='#f59e0b'">
                                    Ubah
                                </button>
                                <button onclick="deleteArchiveItem(${item.id}, event)" style="background-color: #ef4444; color: white; border: none; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 600; cursor: pointer; transition: background-color 0.15s;" onmouseover="this.style.backgroundColor='#dc2626'" onmouseout="this.style.backgroundColor='#ef4444'">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });
            tableBody.innerHTML = html;

            // Update entries info
            if (entriesInfo) {
                entriesInfo.innerText = `Showing ${startIndex + 1} to ${endIndex} of ${totalItems} entries`;
            }

            // Render pagination
            if (pagination) {
                let pagHtml = "";
                
                // Previous button
                const prevDisabled = ArchiveState.currentPage === 1;
                pagHtml += `<button onclick="${prevDisabled ? '' : 'changeArchivePage(' + (ArchiveState.currentPage - 1) + ')'}" style="padding: 5px 10px; font-size: 12px; border: 1px solid #cbd5e1; background: ${prevDisabled ? '#f1f5f9' : 'white'}; color: ${prevDisabled ? '#94a3b8' : '#475569'}; cursor: ${prevDisabled ? 'default' : 'pointer'}; border-radius: 4px;" ${prevDisabled ? 'disabled' : ''}>Previous</button>`;
                
                // Page numbers
                for (let p = 1; p <= totalPages; p++) {
                    const isCurrent = p === ArchiveState.currentPage;
                    pagHtml += `<button onclick="changeArchivePage(${p})" style="padding: 5px 10px; font-size: 12px; border: 1px solid ${isCurrent ? '#3b82f6' : '#cbd5e1'}; background: ${isCurrent ? '#3b82f6' : 'white'}; color: ${isCurrent ? 'white' : '#475569'}; cursor: pointer; border-radius: 4px; font-weight: ${isCurrent ? 'bold' : 'normal'};">${p}</button>`;
                }
                
                // Next button
                const nextDisabled = ArchiveState.currentPage === totalPages;
                pagHtml += `<button onclick="${nextDisabled ? '' : 'changeArchivePage(' + (ArchiveState.currentPage + 1) + ')'}" style="padding: 5px 10px; font-size: 12px; border: 1px solid #cbd5e1; background: ${nextDisabled ? '#f1f5f9' : 'white'}; color: ${nextDisabled ? '#94a3b8' : '#475569'}; cursor: ${nextDisabled ? 'default' : 'pointer'}; border-radius: 4px;" ${nextDisabled ? 'disabled' : ''}>Next</button>`;
                
                pagination.innerHTML = pagHtml;
            }
        }

        function changeArchivePage(page) {
            ArchiveState.currentPage = page;
            renderArchiveTable();
        }

        function changeArchivePageSize(size) {
            ArchiveState.pageSize = parseInt(size) || 10;
            ArchiveState.currentPage = 1;
            renderArchiveTable();
        }

        function filterArchive(val) {
            ArchiveState.searchQuery = val;
            ArchiveState.currentPage = 1;
            renderArchiveList();
        }

        function sortArchiveBy(column) {
            if (ArchiveState.sortColumn === column) {
                ArchiveState.sortOrder = ArchiveState.sortOrder === 'asc' ? 'desc' : 'asc';
            } else {
                ArchiveState.sortColumn = column;
                ArchiveState.sortOrder = 'asc';
            }
            ArchiveState.currentPage = 1;
            renderArchiveList();
        }

        function updateSortIcons() {
            const columns = ['id', 'nomor', 'tanggal', 'perihal', 'tujuan', 'file'];
            columns.forEach(col => {
                const icon = document.getElementById(`sort-icon-${col}`);
                if (icon) {
                    if (ArchiveState.sortColumn === col) {
                        icon.className = ArchiveState.sortOrder === 'asc' ? 'fas fa-sort-up' : 'fas fa-sort-down';
                        icon.style.color = '#3b82f6';
                    } else {
                        icon.className = 'fas fa-sort';
                        icon.style.color = '#a0aec0';
                    }
                }
            });
        }

        function deleteArchiveItem(id, event) {
            if (event) event.stopPropagation();
            if (!confirm('Hapus item ini dari riwayat unduhan?')) return;
            
            let archive = JSON.parse(localStorage.getItem('letterArchive') || '[]');
            archive = archive.filter(item => item.id !== id);
            localStorage.setItem('letterArchive', JSON.stringify(archive));
            
            renderArchiveList();
            updateArchiveBadge();
        }

        function clearAllArchive() {
            if (!confirm('Apakah Anda yakin ingin menghapus seluruh riwayat unduhan surat?')) return;
            localStorage.removeItem('letterArchive');
            renderArchiveList();
            updateArchiveBadge();
        }

        function updateArchiveBadge() {
            const btnBadge = document.getElementById('archive-btn-badge');
            if (btnBadge) {
                let archive = JSON.parse(localStorage.getItem('letterArchive') || '[]');
                if (archive.length > 0) {
                    btnBadge.innerText = archive.length;
                    btnBadge.style.display = 'inline-block';
                } else {
                    btnBadge.style.display = 'none';
                }
            }
        }

        function loadArchivedLetter(id) {
            let archive = JSON.parse(localStorage.getItem('letterArchive') || '[]');
            const item = archive.find(x => x.id === id);
            if (!item) return;

            if (!confirm(`Muat ulang surat nomor "${item.nomor}" ke dalam form? Ini akan menimpa data yang sedang Anda isi sekarang.`)) return;

            try {
                setFormData(item);
                closeArchiveModal();
                alert('Data surat berhasil dimuat ulang ke dalam form!');
            } catch (e) {
                console.error('Error loading archived letter:', e);
                alert('Gagal memuat arsip: ' + e.message);
            }
        }

        function exportArchiveToExcel() {
            let archive = ArchiveState.filteredItems;
            if (archive.length === 0) {
                alert('Tidak ada data untuk diekspor.');
                return;
            }
            
            let csvContent = "\uFEFF"; // UTF-8 BOM
            csvContent += "No,No. Surat,Tanggal Surat,Perihal,Tujuan Surat,File\n";
            
            archive.forEach((item, index) => {
                const no = index + 1;
                const nomor = `"${(item.nomor || '').replace(/"/g, '""')}"`;
                const tanggal = `"${(item.tglSurat || '').replace(/"/g, '""')}"`;
                const perihal = `"${getArchivePerihal(item).replace(/"/g, '""')}"`;
                const tujuan = `"${getArchiveTujuan(item).replace(/"/g, '""')}"`;
                const file = `"${(item.fileName || '').replace(/"/g, '""')}"`;
                
                csvContent += `${no},${nomor},${tanggal},${perihal},${tujuan},${file}\n`;
            });
            
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement("a");
            link.setAttribute("href", url);
            link.setAttribute("download", `Arsip_Surat_Keluar_${new Date().getTime()}.csv`);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        function printArchiveList() {
            let archive = ArchiveState.filteredItems;
            if (archive.length === 0) {
                alert('Tidak ada data untuk dicetak.');
                return;
            }
            
            const printWindow = window.open('', '_blank', 'width=900,height=600');
            let html = `
                <html>
                <head>
                    <title>Cetak Data Surat Keluar</title>
                    <style>
                        body { font-family: Tahoma, sans-serif; padding: 20px; color: #333; }
                        h2 { text-align: center; margin-bottom: 20px; }
                        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
                        th, td { border: 1px solid #cbd5e1; padding: 10px; text-align: left; font-size: 13px; }
                        th { background-color: #f1f5f9; font-weight: bold; }
                        tr:nth-child(even) { background-color: #f8fafc; }
                    </style>
                </head>
                <body>
                    <h2>Data Surat Keluar</h2>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 50px; text-align: center;">No</th>
                                <th>No. Surat</th>
                                <th style="width: 130px;">Tanggal Surat</th>
                                <th>Perihal</th>
                                <th>Tujuan Surat</th>
                                <th>File Name</th>
                            </tr>
                        </thead>
                        <tbody>
            `;
            
            archive.forEach((item, index) => {
                html += `
                    <tr>
                        <td style="text-align: center;">${index + 1}</td>
                        <td>${item.nomor || '-'}</td>
                        <td>${item.tglSurat || '-'}</td>
                        <td>${getArchivePerihal(item)}</td>
                        <td>${getArchiveTujuan(item)}</td>
                        <td>${item.fileName || '-'}</td>
                    </tr>
                `;
            });
            
            html += `
                        </tbody>
                    </table>
                    <script>
                        window.onload = function() {
                            window.print();
                            window.onafterprint = function() { window.close(); };
                        };
                    <\/script>
                </body>
                </html>
            `;
            
            printWindow.document.open();
            printWindow.document.write(html);
            printWindow.document.close();
        }

        window.onload = function() {
            initForm();
            // Otomatis scroll ke atas (bagian header) ketika halaman dimuat ulang
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            // Fokuskan kursor ke input pertama (Jenis Surat)
            const typeSelect = document.getElementById('letter-type');
            if(typeSelect) {
                typeSelect.focus();
            }

            // Update badge dan date on load
            updateArchiveBadge();
            updateHeaderDate();
            
            // Listen for input changes to update header date dynamically
            const inputTgl = document.getElementById('tanggal');
            if (inputTgl) {
                inputTgl.addEventListener('input', updateHeaderDate);
            }
            const inputSppdTgl = document.getElementById('sppd-tgl-validasi');
            if (inputSppdTgl) {
                inputSppdTgl.addEventListener('input', updateHeaderDate);
            }
            const inputType = document.getElementById('letter-type');
            if (inputType) {
                inputType.addEventListener('change', updateHeaderDate);
            }
        };
    </script>

    <!-- HTML MODAL ARSIP -->
    <div id="archive-modal" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5); backdrop-filter: blur(5px); justify-content: center; align-items: center; padding: 20px;">
        <div style="background: #f8fafc; border-radius: 8px; width: 98%; max-width: 1500px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); display: flex; flex-direction: column; max-height: 95vh; animation: fadeIn 0.3s ease; padding: 25px; font-family: 'Tahoma', 'Arial', sans-serif;">
            
            <!-- Page Title -->
            <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                <h1 style="font-size: 26px; color: #5f6368; font-weight: normal; margin: 0;">Surat Keluar</h1>
                <span onclick="closeArchiveModal()" style="font-size: 30px; font-weight: bold; color: #888; cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#888'">&times;</span>
            </div>

            <!-- Card container -->
            <div style="background: white; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); padding: 25px; display: flex; flex-direction: column; flex: 1; overflow: hidden; border-top: 4px solid #3b82f6;">
                
                <!-- Card Header with Title -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2 style="font-size: 20px; color: #475569; font-weight: normal; margin: 0;">Data Surat Keluar</h2>
                </div>

                <!-- DataTable Toolbar (Hanya Search) -->
                <div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 15px;">
                    <!-- Right tools: Search -->
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="font-size: 13px; color: #475569;">Search:</span>
                        <input type="text" id="archive-search" oninput="filterArchive(this.value)" placeholder="Cari surat..." style="padding: 6px 12px; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 13px; width: 220px; background: white;">
                    </div>
                </div>

                <!-- Table Container -->
                <div style="flex: 1; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 4px;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 13px;">
                        <thead>
                            <tr style="background-color: #d2e3fc; color: #334155; border-bottom: 2px solid #b5ccf8; cursor: pointer;">
                                <th onclick="sortArchiveBy('id')" style="padding: 12px 10px; font-weight: bold; border-right: 1px solid #cbd5e1; width: 50px; text-align: center;">No <span id="sort-icon-id" class="fas fa-sort" style="float: right; color: #a0aec0; font-size: 11px; margin-top: 3px;"></span></th>
                                <th onclick="sortArchiveBy('nomor')" style="padding: 12px 15px; font-weight: bold; border-right: 1px solid #cbd5e1;">No. Surat <span id="sort-icon-nomor" class="fas fa-sort" style="float: right; color: #a0aec0; font-size: 11px; margin-top: 3px;"></span></th>
                                <th onclick="sortArchiveBy('tanggal')" style="padding: 12px 15px; font-weight: bold; border-right: 1px solid #cbd5e1; width: 130px;">Tanggal Surat <span id="sort-icon-tanggal" class="fas fa-sort" style="float: right; color: #a0aec0; font-size: 11px; margin-top: 3px;"></span></th>
                                <th onclick="sortArchiveBy('perihal')" style="padding: 12px 15px; font-weight: bold; border-right: 1px solid #cbd5e1;">Perihal <span id="sort-icon-perihal" class="fas fa-sort" style="float: right; color: #a0aec0; font-size: 11px; margin-top: 3px;"></span></th>
                                <th onclick="sortArchiveBy('tujuan')" style="padding: 12px 15px; font-weight: bold; border-right: 1px solid #cbd5e1;">Tujuan Surat <span id="sort-icon-tujuan" class="fas fa-sort" style="float: right; color: #a0aec0; font-size: 11px; margin-top: 3px;"></span></th>
                                <th onclick="sortArchiveBy('file')" style="padding: 12px 15px; font-weight: bold; border-right: 1px solid #cbd5e1;">File <span id="sort-icon-file" class="fas fa-sort" style="float: right; color: #a0aec0; font-size: 11px; margin-top: 3px;"></span></th>
                                <th style="padding: 12px 15px; font-weight: bold; text-align: center; width: 160px; cursor: default;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="archive-table-body">
                            <!-- Diisi dinamis -->
                        </tbody>
                    </table>
                </div>

                <!-- Card Footer (Showing entry and Pagination) -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px; flex-wrap: wrap; gap: 10px;">
                    <div id="archive-entries-info" style="font-size: 13px; color: #64748b;">
                        Showing 0 to 0 of 0 entries
                    </div>
                    <div id="archive-pagination" style="display: flex; gap: 4px;">
                        <!-- Diisi dinamis -->
                    </div>
                </div>

            </div> <!-- Close Card container -->
            
            <!-- Clear Button and Close Button -->
            <div style="display: flex; justify-content: flex-end; margin-top: 15px; align-items: center; gap: 10px;">
                <button onclick="clearAllArchive()" style="background: #ef4444; color: white; border: none; padding: 8px 16px; border-radius: 4px; font-size: 13px; font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 6px;" onmouseover="this.style.backgroundColor='#dc2626'" onmouseout="this.style.backgroundColor='#ef4444'">
                    <i class="fas fa-trash-alt"></i> Hapus Semua Riwayat
                </button>
                <button onclick="closeArchiveModal()" style="background: #e2e8f0; color: #475569; border: none; padding: 8px 16px; border-radius: 4px; font-size: 13px; font-weight: bold; cursor: pointer;" onmouseover="this.style.backgroundColor='#cbd5e1'" onmouseout="this.style.backgroundColor='#e2e8f0'">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</body>
</html>

<?php
// File: index.php
// Sistem Surat KPU (SPPD Final - 1 Lembar Depan & Belakang)

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
            font-family: 'Tahoma', 'Arial', sans-serif !important;
        }
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
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
            background: linear-gradient(135deg, #0a1f3a, #1e3a6f, #2b4c8c); 
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
            border: 2px solid #f0b429;
        }
        
        .logo-wrapper img {
            height: 60px;
            width: 60px;
            object-fit: contain;
            border-radius: 50%;
            border: 2px solid #f0b429;
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
            color: #f0b429;
            margin-right: 5px;
        }
        
        /* Info header */
        .header-info {
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(255,255,255,0.1);
            padding: 6px 15px;
            border-radius: 40px;
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .header-info-item {
            display: flex;
            align-items: center;
            gap: 6px;
            color: white;
        }
        
        .header-info-item i {
            font-size: 0.9rem;
            color: #f0b429;
        }
        
        .header-info-item span {
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .header-info-item .value {
            font-weight: 700;
            color: #f0b429;
            margin-left: 3px;
        }
        
        /* Tombol reset */
        .btn-secondary { 
            background: rgba(255,255,255,0.15); 
            color: white; 
            border: 2px solid #f0b429; 
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
            color: #f0b429;
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
            padding: 30px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.15); 
            border: 1px solid rgba(255,255,255,0.3);
            max-height: 95vh; 
            min-height: 800px; 
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #3498db #f0f0f0;
        }
        
        /* CUSTOM SCROLLBAR YANG ELEGAN */
        .card::-webkit-scrollbar {
            width: 8px;
        }
        .card::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 10px;
        }
        .card::-webkit-scrollbar-thumb {
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
            border-left: 6px solid #3498db; 
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
            background: #525659; 
            padding: 20px; 
            border-radius: 16px; 
            overflow: auto; 
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.2);
            max-height: 95vh; 
            min-height: 800px; 
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
        
        /* ===== STYLE KHUSUS UNTUK HALAMAN BELAKANG SPPD ===== */
        /* Container untuk setiap baris data dengan lebar tetap agar : sejajar */
        .sppd-data-row-fixed {
            display: flex;
            align-items: baseline;
            margin-bottom: 4px;
            width: 100%;
            min-height: 20px;
        }
        
        /* Label dengan lebar tetap 85px agar semua : sejajar */
        .sppd-label-fixed {
            min-width: 85px;
            font-weight: normal;
            white-space: nowrap;
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
            margin-top: 60px !important;
            margin-bottom: 2px !important;
        }
        
        /* Style khusus untuk titik-titik di kolom kiri baris 2-5 */
        .sppd-signature .titik-ttd.kiri-turun {
            margin-top: 60px !important;
            margin-bottom: 2px !important;
        }
        
        /* Style khusus untuk kolom SEKRETARIS (baris 1) - LANGSUNG NAMA SEKRETARIS TANPA TITIK-TITIK DENGAN JARAK SANGAT PANJANG */
        .sppd-signature.sekretaris-column {
            margin-top: 0px !important;
        }
        
        .sppd-signature.sekretaris-column .jabatan {
            margin-top: 10px !important;
            margin-bottom: 60px !important;
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
        
        /* Style untuk PPK tanpa titik-titik - DENGAN JARAK SANGAT BESAR ANTARA JABATAN DAN NAMA, TAPI NAMA DAN NIP RAPAT */
        .sppd-signature-ppk { 
            margin-top: -20px !important; 
            text-align: center !important; 
            display: flex; 
            flex-direction: column; 
            width: 100%; 
            margin-bottom: 20px !important; 
        }
        
        .sppd-signature-ppk .jabatan-ppk { 
            font-weight: normal !important; 
            margin-bottom: 80px !important; /* JARAK SANGAT BESAR */
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
        
        .sppd-signature-ppk .nama-ppk { 
            font-weight: bold; 
            text-decoration: underline; 
            margin-bottom: 2px !important; /* JARAK SANGAT RAPAT */
            line-height: 1.2 !important; 
            text-align: center !important; 
            width: 100%; 
            font-size: 10pt; 
        }
        
        .sppd-signature-ppk .nip-ppk { 
            margin-top: 1px !important; 
            margin-bottom: 5px !important; /* DIPERKECIL dari 30px menjadi 5px agar garis lebih dekat ke NIP */
            line-height: 1.2 !important; 
            text-align: center !important; 
            width: 100%; 
            font-size: 10pt; 
        }
        
        .sppd-signature-ppk-kanan { 
            margin-top: 5px; 
            text-align: center !important; 
            display: flex; 
            flex-direction: column; 
            width: 100%; 
            margin-bottom: 2px !important; 
        }
        
        .sppd-signature-ppk-kanan .jabatan-ppk-kanan { 
            font-weight: normal !important; 
            margin-bottom: 80px !important; /* JARAK SANGAT BESAR */
            text-align: center !important; 
            width: 100%; 
            font-size: 10pt; 
            line-height: 1.2 !important; 
        }
        
        .sppd-signature-ppk-kanan .space-ttd-kanan { 
            height: 15px !important; 
            width: 100%; 
        }
        
        .sppd-signature-ppk-kanan .nama-ppk-kanan { 
            font-weight: bold; 
            text-decoration: underline; 
            margin-bottom: 2px !important; /* JARAK SANGAT RAPAT */
            line-height: 1.2 !important;
            text-align: center !important; 
            width: 100%; 
            font-size: 10pt;
        }
        
        .sppd-signature-ppk-kanan .nip-ppk-kanan { 
            margin-top: 1px !important; 
            margin-bottom: 5px !important; /* DIPERKECIL dari 20px menjadi 5px agar garis lebih dekat ke NIP */
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
            padding: 8px 10px; 
            vertical-align: top; 
            width: 50%; 
            min-height: 150px; 
            font-size: 10pt; 
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
        .kop-center .kop-text h1, .kop-center .kop-text h2 { font-size: 11pt !important; font-weight: bold !important; margin: 0; text-transform: uppercase; line-height: 1.2; color: black; }
        .kontak-row { display: flex; justify-content: space-between; width: 100%; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 8px; margin-bottom: 10px; font-size: 10pt; }
        .kop-surat-tugas-sekretaris { display: flex; flex-direction: column; align-items: center; text-align: center; width: 100%; margin-bottom: 15px; }
        .kop-surat-tugas-sekretaris .kop-header { display: flex; flex-direction: column; align-items: center; text-align: center; width: 100%; }
        .kop-surat-tugas-sekretaris .logo { width: 75px; height: 75px; margin: 0 auto 8px auto; display: block; object-fit: contain; }
        .kop-surat-tugas-sekretaris .kop-judul { width: 100%; text-align: center; }
        .kop-surat-tugas-sekretaris .kop-judul h1, .kop-surat-tugas-sekretaris .kop-judul h2 { font-size: 11pt !important; font-weight: bold !important; margin: 0; text-transform: uppercase; line-height: 1.2; color: black; text-align: center; }
        .kop-surat-tugas-sekretaris .alamat { font-size: 10pt; margin-top: 3px; font-weight: normal; color: black; text-align: center; }
        .kop-surat-tugas-sekretaris .kontak { display: flex; justify-content: space-between; font-size: 10pt; margin-top: 3px; border-bottom: 2px solid black; padding-bottom: 4px; width: 100%; }
        .judul-surat, .judul-nota, .judul-tugas, .nomor-surat-center { font-family: 'Tahoma', sans-serif !important; }
        .judul-surat { text-align: center; font-weight: bold !important; font-size: 13pt; margin-bottom: 12px; text-transform: uppercase; margin-top: 20px; }
        .judul-nota { text-align: center; font-weight: bold !important; font-size: 13pt; margin-bottom: 12px; text-transform: uppercase; text-decoration: underline; margin-top: 20px; }
        .judul-tugas { text-align: center; font-weight: bold !important; font-size: 13pt; margin-bottom: 12px; text-transform: uppercase; margin-top: 20px; text-decoration: underline; }
        .nomor-surat-center { text-align: center; font-size: 11pt; margin-bottom: 20px; font-weight: normal; }
        .signature-section { margin-top: 30px; float: right; width: 45%; display: flex; flex-direction: column; align-items: center; text-align: center; margin-right: 20px; }
        .sign-spacer { height: 60px; width: 100%; }
        .sign-name { font-weight: bold; text-decoration: underline; font-size: 11pt; text-transform: uppercase; width: 100%; margin-bottom: 8px; text-align: center; }
        .sign-nip { margin-top: 8px; width: 100%; font-size: 11pt; text-align: center; }
        .sign-jabatan { font-size: 11pt; margin-bottom: 12px; text-align: center; width: 100%; }
        .meta-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .meta-table td { vertical-align: top; padding-bottom: 4px; font-size: 11pt; }
        .surat-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; width: 100%; margin-top: 15px; }
        .surat-header-left { width: 50%; }
        .surat-header-left table td { padding-bottom: 4px; font-size: 11pt; }
        .surat-header-right { width: 45%; text-align: right; white-space: nowrap; }
        .surat-header-alamat { width: 45%; text-align: right; font-size: 11pt; line-height: 1.4; font-weight: normal; }
        .kontak-telepon-email { font-size: 10pt !important; }
        .content-body { font-size: 11pt; line-height: 1.5; text-align: justify; margin-top: 20px; }
        .content-body p { text-indent: 1.27cm; margin-bottom: 8px; margin-top: 0; margin-left: 0; margin-right: 0; font-size: 11pt; text-align: justify; line-height: 1.5; }
        .content-body br { display: block; content: ""; margin-top: 8px; }
        .tugas-table { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
        .tugas-table td { vertical-align: top; font-size: 11pt; padding-bottom: 6px; text-align: left; }
        .tugas-table .col-label { width: 100px; font-weight: bold; vertical-align: top; }
        .tugas-table .col-content { padding-left: 8px; }
        .memberi-tugas { text-align: left; font-weight: bold; margin: 15px 0 8px 0; font-size: 11pt; text-transform: uppercase; }
        .tembusan-section { clear: both; margin-top: 60px; font-size: 11pt; width: 100%; }
        .tembusan-title { margin-bottom: 6px; font-weight: bold; }
        .tembusan-list-content { font-size: 11pt; }
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
            
            <div class="header-info">
                <div class="header-info-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span><span class="value" id="current-date"></span></span>
                </div>
                <div class="header-info-item">
                    <i class="fas fa-clock"></i>
                    <span><span class="value" id="current-time"></span></span>
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
                <!-- Jenis Surat -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-file-alt"></i> 1. JENIS SURAT
                    </div>
                    <select id="letter-type" onchange="checkLetterType()" style="font-weight:bold; background:white;">
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
                            </select>
                        </div>
                        
                        <div style="background: linear-gradient(135deg, #e3f2fd, #d4e8fc); padding: 20px; border-radius: 16px; border: 2px solid #3498db; margin-top: 15px;">
                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:15px;">
                                <i class="fas fa-pencil-alt" style="color: #2c3e50;"></i>
                                <span style="font-weight:bold;">Data Penandatangan</span>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap Penandatangan *</label>
                                <input type="text" id="input-nama-ttd" placeholder="Contoh: FAJAR RANDI YOGANANDA" oninput="updatePreview()">
                            </div>
                            <div class="form-group">
                                <label>NIP Penandatangan</label>
                                <input type="text" id="input-nip-ttd" placeholder="Contoh: 19730528 200501 1 007" oninput="updatePreview()">
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
                                <input type="text" id="nomor" placeholder="Contoh: XXX/RT.XX.X-ST/XXXX/XXXX" oninput="updatePreview()">
                            </div>
                            <div class="form-group" id="group-tanggal-umum">
                                <label>Tanggal Surat</label>
                                <input type="text" id="tanggal" placeholder="Contoh: Pekalongan, 1 Jan 2024" oninput="updatePreview()">
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
                                    <option value="Biasa">Biasa</option>
                                    <option value="Penting" selected>Penting</option>
                                    <option value="Segera">Segera</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Lampiran</label>
                                <input type="text" id="lampiran" placeholder="Jumlah berkas lampiran" oninput="updatePreview()">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Perihal</label>
                            <textarea rows="3" id="perihal" oninput="updatePreview()" placeholder="Pokok persoalan surat"></textarea>
                        </div>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label>Tujuan Tempat</label>
                                <input type="text" id="tujuan-tempat" placeholder="Lokasi tujuan" oninput="updatePreview()">
                            </div>
                            <div class="form-group">
                                <label>Alamat Kantor</label>
                                <input type="text" id="alamat-kantor" placeholder="Alamat lengkap kantor" value="Jalan Sriwijaya No. 17 Pekalongan 51119" oninput="updatePreview()">
                            </div>
                        </div>
                        
                        <!-- KOLOM ISI SURAT DENGAN TEMPLATE -->
                        <div class="form-group-isi-surat">
                            <label><i class="fas fa-file-signature"></i> Isi Surat</label>
                            <textarea id="isi" rows="10" oninput="updatePreview()" placeholder="Tulis isi surat di sini...">Tempat

Sehubungan dengan.....(alinea pembuka).....

Isi surat.....(alinea isi).....

Demikian disampaikan.....(alinea penutup).....</textarea>
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
                                        <label>KODE NO</label>
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
                                <label><span class="label-num">1</span>Pejabat Pembuat Komitmen (PPK)</label>
                                <input type="text" id="sppd-ppk" placeholder="Nama PPK" oninput="updatePreview()">
                            </div>

                            <div class="form-group">
                                <label><span class="label-num">2</span>Pegawai yang Melaksanakan</label>
                                <input type="text" id="sppd-nama" placeholder="Nama pegawai pelaksana" oninput="updatePreview()">
                                <input type="text" id="sppd-nip" placeholder="NIP pegawai pelaksana" oninput="updatePreview()" style="margin-top:10px;">
                            </div>

                            <div class="form-group">
                                <label><span class="label-num">3</span>Info Pangkat & Jabatan</label>
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
                                <label><span class="label-num">4</span>Maksud Perjalanan Dinas</label>
                                <textarea id="sppd-maksud" rows="2" placeholder="Tujuan perjalanan dinas" oninput="updatePreview()"></textarea>
                            </div>

                            <div class="form-group">
                                <label><span class="label-num">5</span>Alat Angkut</label>
                                <input type="text" id="sppd-transport" placeholder="Moda transportasi yang digunakan" oninput="updatePreview()">
                            </div>

                            <div class="form-group">
                                <label><span class="label-num">6</span>Tempat Berangkat & Tujuan</label>
                                <input type="text" id="sppd-berangkat" placeholder="Lokasi keberangkatan" oninput="updatePreview()">
                                <input type="text" id="sppd-tujuan" placeholder="Lokasi tujuan" oninput="updatePreview()" style="margin-top:10px;">
                            </div>

                            <div class="form-group">
                                <label><span class="label-num">7</span>Waktu Perjalanan</label>
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
                                <label><span class="label-num">8</span>Pengikut (Tambah Manual)</label>
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
                                <label><span class="label-num">9</span>Anggaran</label>
                                <input type="text" id="sppd-instansi" placeholder="Instansi pembebanan anggaran" oninput="updatePreview()">
                                <input type="text" id="sppd-akun" placeholder="Kode akun anggaran" oninput="updatePreview()" style="margin-top:10px;">
                            </div>

                            <div class="form-group">
                                <label><span class="label-num">10</span>Keterangan Lain-Lain</label>
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
                            
                            <!-- KOLOM I - BERANGKAT (KANAN) - SEKRETARIS -->
                            <div style="background:white; padding:20px; border-radius:16px; margin-bottom:20px; border:2px solid #e8ecf2;">
                                <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
                                    <span style="background:#6c757d; color:white; width:35px; height:35px; display:flex; align-items:center; justify-content:center; border-radius:50%; font-weight:bold;">I</span>
                                    <span style="font-weight:bold; color:#2c3e50;">KOLOM I - BERANGKAT (SEKRETARIS)</span>
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
                                        <label>Nama Sekretaris</label>
                                        <input type="text" id="back-berangkat-nama-kanan" placeholder="Isi nama sekretaris" oninput="updatePreview()">
                                    </div>
                                    <div class="form-group">
                                        <label>NIP Sekretaris</label>
                                        <input type="text" id="back-berangkat-nip-kanan" placeholder="Isi NIP sekretaris" oninput="updatePreview()">
                                    </div>
                                </div>
                                <div class="input-info">* Bagian ini untuk tanda tangan Sekretaris di kolom kanan</div>
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
            </div>

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
                                        <tr><td>Sifat</td><td>:</td><td id="sd-sifat">...</td></tr>
                                        <tr><td>Lampiran</td><td>:</td><td id="sd-lampiran">...</td></tr>
                                        <tr><td>Perihal</td><td>:</td><td id="sd-perihal" style="vertical-align: top;">...</td></tr>
                                    </table>
                                </div>
                                <div class="surat-header-alamat" id="sd-alamat-kanan">
                                    <span id="sd-alamat-teks">Jalan Sriwijaya No. 17 Pekalongan 51119</span><br>
                                    <span id="sd-tanggal" style="font-weight: normal; font-size: 12pt;"></span>
                                </div>
                            </div>
                            <div style="margin-bottom: 30px;">
                                <div style="font-size: 12pt;">Yth.</div>
                                <div id="sd-kepada" style="margin-left: 0; font-weight: bold; font-size: 12pt; margin-top: 6px;">...</div>
                                <div style="margin-left: 30px; font-size: 12pt; margin-top: 6px;" id="sd-tempat">Tempat</div>
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
                                <tr>
                                    <td class="col-label">Menimbang</td>
                                    <td class="sep-col" style="width:20px;">:</td>
                                    <td id="prev-menimbang" class="col-content"></td>
                                </tr>
                                <tr>
                                    <td class="col-label">Dasar</td>
                                    <td>:</td>
                                    <td id="prev-dasar" class="col-content"></td>
                                </tr>
                            </table>
                            
                            <div class="memberi-tugas">MEMBERI TUGAS :</div>
                            
                            <table class="tugas-table">
                                <tr>
                                    <td class="col-label">Kepada</td>
                                    <td>:</td>
                                    <td id="prev-kepada-tugas" class="col-content"></td>
                                </tr>
                                <tr>
                                    <td class="col-label">Untuk</td>
                                    <td>:</td>
                                    <td id="prev-untuk" class="col-content"></td>
                                </tr>
                                <tr>
                                    <td class="col-label">Anggaran</td>
                                    <td>:</td>
                                    <td id="prev-anggaran" class="col-content"></td>
                                </tr>
                            </table>
                        </div>

                        <!-- Preview SPPD Depan -->
                        <div id="preview-sppd-depan" class="hidden">
                            <div class="sppd-header-right">
                                <table class="sppd-header-table">
                                    <tr>
                                        <td class="label">Lembar Ke</td>
                                        <td>:</td>
                                        <td id="prev-sppd-lembar">...</td>
                                    </tr>
                                    <tr>
                                        <td class="label">KODE NO</td>
                                        <td>:</td>
                                        <td id="prev-sppd-kode-no">...</td>
                                    </tr>
                                    <tr>
                                        <td class="label">Nomor</td>
                                        <td>:</td>
                                        <td id="prev-sppd-nomor">...</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="sppd-title-main">SURAT PERJALANAN DINAS (SPD)</div>

                            <table class="sppd-table-front">
                                <colgroup>
                                    <col class="col-no">
                                    <col class="col-label">
                                    <col class="col-content">
                                </colgroup>

                                <tr><td class="col-no">1</td><td class="col-label">Pejabat Pembuat Komitmen</td><td><span id="prev-sppd-ppk">...</span></td></tr>
                                <tr><td class="col-no">2</td><td class="col-label">Nama/NIP Pegawai yang melaksanakan Perjalanan Dinas</td><td><div id="prev-sppd-nama" style="font-weight:bold;">...</div><div id="prev-sppd-nip" class="nip-spacer">NIP. ...</div></td></tr>
                                <tr><td class="col-no">3</td><td class="col-label">a. Pangkat / golongan<br>b. Jabatan/Instansi<br>c. Tingkat Biaya Perjalanan Dinas</td><td>a. <span id="prev-sppd-pangkat">...</span><br>b. <span id="prev-sppd-jabatan">...</span><br>c. <span id="prev-sppd-biaya">...</span></td></tr>
                                <tr><td class="col-no">4</td><td class="col-label">Maksud Perjalanan Dinas</td><td><span id="prev-sppd-maksud">...</span></td></tr>
                                <tr><td class="col-no">5</td><td class="col-label">Alat angkut yang dipergunakan</td><td><span id="prev-sppd-transport">...</span></td></tr>
                                <tr><td class="col-no">6</td><td class="col-label">a. Tempat berangkat<br>b. Tempat tujuan</td><td>a. <span id="prev-sppd-berangkat">...</span><br>b. <span id="prev-sppd-tujuan">...</span></td></tr>
                                <tr><td class="col-no">7</td><td class="col-label">a. Lamanya Perjalanan Dinas<br>b. Tanggal Berangkat<br>c. Tanggal harus kembali/tiba di tempat baru *)</td><td>a. <span id="prev-sppd-lama">...</span><br>b. <span id="prev-sppd-tgl-berangkat">...</span><br>c. <span id="prev-sppd-tgl-kembali">...</span></td></tr>
                                
                                <tr>
                                    <td class="col-no" style="vertical-align: top;">8</td>
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

                                <tr><td class="col-no">9</td><td class="col-label">Pembebanan anggaran :<br>a. Instansi<br>b. Kegiatan/Output/Akun</td><td><br>a. <span id="prev-sppd-instansi">...</span><br>b. <span id="prev-sppd-akun">...</span></td></tr>
                                <tr><td class="col-no">10</td><td class="col-label">Keterangan lain - lain</td><td><span id="prev-sppd-lain"></span></td></tr>
                            </table>

                            <div class="signature-section" style="margin-top:20px;">
                                <div style="text-align:left; width:100%; font-size: 10.5pt;">
                                    Dikeluarkan di : <span id="prev-sppd-dikeluarkan">...</span><br>
                                    Pada Tanggal &nbsp;&nbsp;: <span id="prev-sppd-tgl-surat">...</span>
                                </div>
                                <div class="sign-jabatan" style="margin-top:10px; margin-bottom:5px;">Pejabat Pembuat Komitmen</div>
                                <div class="sign-spacer" style="height:35px;"></div>
                                <div class="sign-name" id="ppk-sign-name">...</div>
                                <div class="sign-nip" id="ppk-sign-nip">NIP. -</div>
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
                                                            <span class="sppd-label-fixed">Berangkat dari</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b1-asal2"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">ke</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b1-ke2"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">pada tanggal</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b1-tgl2"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">kepala</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b1-kepala2"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="signature-area">
                                                <div class="sppd-signature sekretaris-column">
                                                    <div class="jabatan">SEKRETARIS</div>
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
                                                            <span class="sppd-label-fixed">pada tanggal</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b2-tiba-tgl"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">kepala</span>
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
                                                        <span class="sppd-label-fixed">ke</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b2-berangkat-ke"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">pada tanggal</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b2-berangkat-tgl"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">kepala</span>
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
                                                            <span class="sppd-label-fixed">pada tanggal</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b3-tiba-tgl"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">kepala</span>
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
                                                        <span class="sppd-label-fixed">ke</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b3-berangkat-ke"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">pada tanggal</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b3-berangkat-tgl"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">kepala</span>
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
                                                            <span class="sppd-label-fixed">pada tanggal</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b4-tiba-tgl"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">kepala</span>
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
                                                        <span class="sppd-label-fixed">ke</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b4-berangkat-ke"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">pada tanggal</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b4-berangkat-tgl"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">kepala</span>
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
                                                            <span class="sppd-label-fixed">pada tanggal</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b5-tiba-tgl"></span>
                                                        </div>
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">kepala</span>
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
                                                        <span class="sppd-label-fixed">ke</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b5-berangkat-ke"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">pada tanggal</span>
                                                        <span class="sppd-separator-fixed">:</span>
                                                        <span class="sppd-value-fixed" id="v-b5-berangkat-tgl"></span>
                                                    </div>
                                                    <div class="sppd-data-row-fixed">
                                                        <span class="sppd-label-fixed">kepala</span>
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
                                <tr>
                                    <td style="vertical-align:top; width:50%; border:1px solid black; background:white; padding:5px 6px;">
                                        <div class="sppd-data-content">
                                            <div class="data-area">
                                                <div class="sppd-roman-header-fixed">
                                                    <span class="sppd-roman-number-fixed">VI.</span>
                                                    <div class="sppd-data-area-fixed">
                                                        <!-- Tiba di dengan : sejajar -->
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Tiba di</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b6-tiba"></span>
                                                        </div>
                                                        
                                                        <!-- Tempat Kedudukan (selalu tampil dengan titik dua sejajar) -->
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">Tempat Kedudukan</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed-wrap" id="v-b6-tempat-kedudukan"></span>
                                                        </div>
                                                        
                                                        <!-- Pada tanggal dengan : sejajar -->
                                                        <div class="sppd-data-row-fixed">
                                                            <span class="sppd-label-fixed">pada tanggal</span>
                                                            <span class="sppd-separator-fixed">:</span>
                                                            <span class="sppd-value-fixed" id="v-b6-tiba-tgl"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="signature-area">
                                                <div class="sppd-signature-ppk">
                                                    <div class="jabatan-ppk">Pejabat Pembuat Komitmen</div>
                                                    <div class="space-ttd" style="display:none;"></div>
                                                    <div class="nama-ppk" id="v-ppk-nama"></div>
                                                    <div class="nip-ppk" id="v-ppk-nip"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align:top; width:50%; border:1px solid black; background:white; padding:5px 6px;">
                                        <div class="sppd-data-content">
                                            <div class="data-area">
                                                <div style="text-align:justify; font-size:9pt; line-height:1.3; margin-bottom:5px; text-align:left; padding-left:0;">
                                                    <span id="v-vi-keterangan">Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.</span>
                                                </div>
                                            </div>
                                            <div class="signature-area">
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
                                <!-- BARIS 7: CATATAN LAIN -->
                                <tr style="height:auto;">
                                    <td colspan="2" style="border:1px solid black; padding:4px 6px; background:white; border-bottom:1px solid black; height:35px !important; text-align:left;">
                                        <span style="font-weight:bold;">VII. Catatan Lain :</span>
                                        <span id="v-catatan" style="margin-left:5px;"></span>
                                    </td>
                                </tr>
                                <!-- BARIS 8: PERHATIAN -->
                                <tr>
                                    <td colspan="2" style="border:1px solid black; padding:5px 6px; background:white; border-top:1px double black; text-align:left;">
                                        <b>VIII. PERHATIAN</b><br>
                                        <span style="font-size: 8.5pt;">PPK yang menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan peraturan-peraturan Keuangan Negara apabila negara menderita kerugian akibat kesalahan, kelalaian, dan kealpaannya.</span>
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

        // Global variables
        let pengikutList = [];

        // Initialize form
        function initForm() {
            // Set default values for signatory
            document.getElementById('input-nama-ttd').value = NAMA_KETUA;
            document.getElementById('input-nip-ttd').value = "";
            document.getElementById('jabatan-penandatangan').value = "KETUA,";
            
            // Update hidden jabatan
            document.getElementById('input-jabatan').value = "KETUA,";
            
            // Set default isi surat dengan template
            document.getElementById('isi').value = TEMPLATE_ISI_SURAT;
            
            checkLetterType();
            
            // Focus on first input
            document.getElementById('nomor').focus();
            
            // Set default tembusan kosong
            document.getElementById('tembusan').value = '';
            
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
                document.getElementById('jabatan-penandatangan').value = 'KETUA,';
                document.getElementById('sifat').value = 'Penting';
                
                // Reset signatory to default
                document.getElementById('input-nama-ttd').value = NAMA_KETUA;
                document.getElementById('input-nip-ttd').value = "";
                document.getElementById('input-jabatan').value = "KETUA,";
                
                // Set default isi surat dengan template
                document.getElementById('isi').value = TEMPLATE_ISI_SURAT;
                
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
            
            // Hanya tampilkan satu tombol PDF untuk semua jenis surat
            buttonContainer.innerHTML = `
                <button class="btn btn-primary" onclick="downloadPDF()">
                    <i class="fas fa-file-pdf"></i> CETAK PDF
                </button>
            `;
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
            } else {
                document.getElementById('form-general').classList.remove('hidden');
                // Tampilkan "INFORMASI SURAT" untuk Surat Dinas dan Nota
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

            if (mode === 'depan') {
                divDepan.classList.remove('hidden');
                divBelakang.classList.add('hidden');
            } else {
                divDepan.classList.add('hidden');
                divBelakang.classList.remove('hidden');
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
            // SURAT DINAS dengan Ketua
            else if (type === 'SURAT DINAS' && !isSekretaris) {
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
            // SURAT DINAS dengan Sekretaris
            else if (type === 'SURAT DINAS' && isSekretaris) {
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
                    <div class="kontak-row kontak-telepon-email">
                        <div class="kontak-left">Telp. (0285) 4416076</div>
                        <div class="kontak-right">Email: kota_pekalongan@kpu.go.id</div>
                    </div>
                `;
            }
            // NOTA DINAS dengan Sekretaris
            else if (type === 'NOTA DINAS' && isSekretaris) {
                kopEl.className = 'kop-container kop-center';
                kopEl.innerHTML = `
                    <div class="kop-top">
                        <img src="logo-kpu.png" alt="Logo" class="kop-logo-img" style="width:75px; height:75px; object-fit:contain;">
                        <div class="kop-text">
                            <h1>KOMISI PEMILIHAN UMUM</h1>
                            <h2>KOTA PEKALONGAN</h2>
                        </div>
                    </div>
                    <div class="kontak-row kontak-telepon-email">
                        <div class="kontak-left">Telp. (0285) 4416076</div>
                        <div class="kontak-right">Email: kota_pekalongan@kpu.go.id</div>
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
            const alamatKantor = document.getElementById('alamat-kantor')?.value || 'Jalan Sriwijaya No. 17 Pekalongan 51119';

            if (type === 'SURAT DINAS') {
                document.getElementById('preview-surat-dinas').classList.remove('hidden');
                
                document.getElementById('sd-kepada').innerHTML = "...";
                document.getElementById('sd-nomor').innerText = nomorVal;
                document.getElementById('sd-sifat').innerText = document.getElementById('sifat').value;
                document.getElementById('sd-lampiran').innerText = document.getElementById('lampiran').value;
                document.getElementById('sd-perihal').innerText = document.getElementById('perihal').value;
                document.getElementById('sd-tempat').innerText = document.getElementById('tujuan-tempat').value;
                document.getElementById('sd-isi').innerHTML = formatIsiSurat(document.getElementById('isi').value);
                
                // Set alamat dan tanggal
                const alamatTeks = document.getElementById('sd-alamat-teks');
                if (alamatTeks) alamatTeks.innerText = alamatKantor;
                document.getElementById('sd-tanggal').innerText = tglText;
                
                const tembusanVal = document.getElementById('tembusan').value;
                if(tembusanVal && tembusanVal.trim() !== "" && tembusanVal !== "-") {
                    document.getElementById('tembusan-section').style.display = 'block';
                    document.getElementById('tembusan-list-content').innerHTML = generateList(tembusanVal, '1');
                }

            } else if (type === 'NOTA DINAS') {
                document.getElementById('preview-nota').classList.remove('hidden');
                
                document.getElementById('nota-kepada').innerHTML = "...";
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
                if(tglText) {
                    const tempatTanggal = tglText.includes(',') ? tglText : `Pekalongan, ${tglText}`;
                    document.getElementById('sign-jabatan').innerHTML = `<div style="margin-bottom: 12px;">${tempatTanggal}</div>` + jabatan;
                }

            } else if (type === 'SPPD') {
                document.getElementById('general-signature').style.display = 'none';
                const sppdPage = document.querySelector('input[name="sppd_page"]:checked').value;
                
                const ppkName = document.getElementById('sppd-ppk').value;

                // Tampilkan hanya halaman yang dipilih sesuai radio button
                if (sppdPage === 'depan') {
                    document.getElementById('preview-sppd-depan').classList.remove('hidden');
                    document.getElementById('preview-sppd-belakang').classList.add('hidden');
                } else {
                    document.getElementById('preview-sppd-depan').classList.add('hidden');
                    document.getElementById('preview-sppd-belakang').classList.remove('hidden');
                }
                
                // Update data untuk halaman depan
                document.getElementById('prev-sppd-lembar').innerText = document.getElementById('sppd-lembar-manual').value;
                document.getElementById('prev-sppd-kode-no').innerText = document.getElementById('sppd-kode-no').value;
                document.getElementById('prev-sppd-nomor').innerText = document.getElementById('sppd-nomor').value;

                document.getElementById('prev-sppd-ppk').innerText = ppkName;
                document.getElementById('prev-sppd-nama').innerText = document.getElementById('sppd-nama').value;
                document.getElementById('prev-sppd-nip').innerText = "NIP. " + document.getElementById('sppd-nip').value;
                
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
                    </tr>`;
                }
                document.getElementById('prev-list-pengikut-body').innerHTML = htmlList;

                const place = document.getElementById('sppd-dikeluarkan').value;
                const date = document.getElementById('sppd-tgl-validasi').value;
                document.getElementById('prev-sppd-dikeluarkan').innerText = place;
                document.getElementById('prev-sppd-tgl-surat').innerText = date;
                
                document.getElementById('ppk-sign-name').innerText = ppkName;
                document.getElementById('ppk-sign-nip').innerText = "NIP. -";

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
                
                const tempatKedudukan = document.getElementById('back-vi-tempat-kedudukan').value;
                const tempatKedudukanSpan = document.getElementById('v-b6-tempat-kedudukan');
                
                // Jika tempat kedudukan diisi, tampilkan isinya, jika tidak tampilkan "-"
                if (tempatKedudukan && tempatKedudukan.trim() !== '') {
                    tempatKedudukanSpan.innerText = tempatKedudukan;
                } else {
                    tempatKedudukanSpan.innerText = " ";
                }
                
                document.getElementById('v-b6-tiba-tgl').innerText = document.getElementById('back-vi-tiba-tgl').value || '';
                document.getElementById('v-ppk-nama').innerText = document.getElementById('back-vi-nama').value || '';
                document.getElementById('v-ppk-nip').innerHTML = document.getElementById('back-vi-nip').value ? 'NIP. ' + document.getElementById('back-vi-nip').value : '';
                
                const keteranganText = document.getElementById('back-vi-keterangan')?.value || 'Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.  ';
                document.getElementById('v-vi-keterangan').innerText = keteranganText;
                
                document.getElementById('v-vi-nama-kanan').innerText = document.getElementById('back-vi-nama-kanan')?.value || '';
                document.getElementById('v-vi-nip-kanan').innerHTML = document.getElementById('back-vi-nip-kanan')?.value ? 'NIP. ' + document.getElementById('back-vi-nip-kanan').value : '';
                
                document.getElementById('v-catatan').innerText = document.getElementById('back-catatan').value || '';
                
                return;
            }

            // Update tanda tangan umum untuk Surat Dinas, Nota Dinas, dan Surat Tugas
            document.getElementById('sign-jabatan').innerText = jabatan;
            document.getElementById('sign-name').innerText = document.getElementById('input-nama-ttd').value || "( Nama )";
            
            const nipVal = document.getElementById('input-nip-ttd').value;
            const nipEl = document.getElementById('sign-nip');
            
            if(nipVal && nipVal.trim() !== "") {
                nipEl.style.display = "block";
                nipEl.innerText = "NIP. " + nipVal;
            } else {
                nipEl.style.display = "none";
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
                        
                        html += `<div style="display: flex; margin-left: 0; margin-bottom: 8px;">
                                    <div style="width: 120px; font-weight: normal;">${label}</div>
                                    <div style="width: 15px; text-align: center;">:</div>
                                    <div style="flex: 1;">${value}</div>
                                 </div>`;
                    } else {
                        html += `<p style="text-indent: 1.27cm; margin-bottom: 8px; margin-top: 0; text-align: justify; line-height: 1.5;">${trimmedP}</p>`;
                    }
                }
            });
            
            return html;
        }

        // FUNGSI DOWNLOAD PDF - UKURAN F4 UNTUK SPPD, DIPERKECIL PADDINGNYA
        function downloadPDF() {
            try {
                const element = document.getElementById('letter-preview');
                
                if (!element) {
                    throw new Error("Elemen preview tidak ditemukan");
                }

                const type = document.getElementById('letter-type').value;
                const timestamp = new Date().getTime();
                
                let fileName = `Surat_${type.replace(/\s+/g, '_')}_${timestamp}.pdf`;
                const isSppd = (type === 'SPPD');
                const sppdPage = isSppd ? document.querySelector('input[name="sppd_page"]:checked').value : null;
                const isSppdBelakang = (isSppd && sppdPage === 'belakang');
                
                if (isSppd) {
                    fileName = `SPPD_${sppdPage === 'depan' ? 'Halaman_Depan' : 'Halaman_Belakang'}_${timestamp}.pdf`;
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
                    lineHeight: element.style.lineHeight
                };
                
                // Reset dan set style untuk PDF - UKURAN BERDASARKAN JENIS SURAT
                if (isSppd) {
                    // Ukuran F4 untuk SPPD (215mm x 330mm)
                    element.style.width = '215mm';
                    element.style.minHeight = '330mm';
                    element.style.maxWidth = '215mm';
                    
                    // KURANGI PADDING AGAR LEBIH KECIL
                    if (isSppdBelakang) {
                        element.style.padding = '3mm 5mm 3mm 8mm'; // Padding lebih kecil
                        element.style.fontSize = '8.5pt'; // Font size tetap
                    } else {
                        element.style.padding = '4mm 6mm 4mm 10mm'; // Padding lebih kecil untuk depan
                        element.style.fontSize = '10pt';
                    }
                    
                    element.classList.add('padding-sppd');
                    element.classList.add('sppd-preview');
                    
                    // Optimasi khusus untuk SPPD halaman belakang
                    if (isSppdBelakang) {
                        const backGrid = element.querySelector('.sppd-back-grid');
                        if (backGrid) {
                            backGrid.style.width = '100%';
                            backGrid.style.tableLayout = 'fixed';
                            backGrid.style.fontSize = '8.5pt';
                            
                            const cells = backGrid.querySelectorAll('td');
                            cells.forEach(cell => {
                                cell.style.padding = '1px 2px'; // Padding sel lebih kecil
                                cell.style.fontSize = '8.5pt';
                                cell.style.lineHeight = '1.2';
                            });
                        }
                        
                        // Kurangi margin baris data
                        const dataRows = element.querySelectorAll('.sppd-data-row-fixed');
                        dataRows.forEach(row => {
                            row.style.marginBottom = '2px'; // Margin lebih kecil
                            row.style.minHeight = '16px';
                        });
                        
                        // Perpanjang titik-titik
                        const titikKiri = element.querySelectorAll('.titik-ttd.kiri-turun');
                        titikKiri.forEach(titik => {
                            titik.innerText = '(.............................)'; // 25 titik
                            titik.style.marginTop = '15px'; // Kurangi jarak
                        });
                        
                        const titikKanan = element.querySelectorAll('.titik-ttd.kanan-turun');
                        titikKanan.forEach(titik => {
                            titik.innerText = '(.............................)'; // 25 titik
                            titik.style.marginTop = '15px'; // Kurangi jarak
                        });
                        
                        // Kurangi jarak signature
                        const signatures = element.querySelectorAll('.sppd-signature-ppk, .sppd-signature-ppk-kanan');
                        signatures.forEach(sig => {
                            sig.style.marginTop = '-10px';
                        });
                        
                        const sekretaris = element.querySelectorAll('.sppd-signature.sekretaris-column .jabatan');
                        sekretaris.forEach(jab => {
                            jab.style.marginBottom = '30px'; // Kurangi jarak
                        });
                        
                        const ppkJabatan = element.querySelectorAll('.jabatan-ppk, .jabatan-ppk-kanan');
                        ppkJabatan.forEach(jab => {
                            jab.style.marginBottom = '40px'; // Kurangi jarak
                        });
                        
                        // TAMBAHKAN JARAK UNTUK PEJABAT PEMBUAT KOMITMEN (KE BAWAH)
                        const ppkJabatanKiri = element.querySelectorAll('.sppd-back-grid tr:nth-child(6) td:first-child .sppd-signature-ppk .jabatan-ppk');
                        ppkJabatanKiri.forEach(jab => {
                            jab.style.marginBottom = '60px'; // Tambah jarak jadi lebih besar
                        });
                        
                        const ppkJabatanKanan = element.querySelectorAll('.sppd-back-grid tr:nth-child(6) td:last-child .sppd-signature-ppk-kanan .jabatan-ppk-kanan');
                        ppkJabatanKanan.forEach(jab => {
                            jab.style.marginBottom = '60px'; // Tambah jarak jadi lebih besar
                        });
                    }
                } else {
                    // Ukuran A4 untuk surat lainnya (210mm x 297mm)
                    element.style.width = '210mm';
                    element.style.minHeight = '297mm';
                    element.style.maxWidth = '210mm';
                    element.style.padding = '5mm 10mm 5mm 15mm';
                    element.style.fontSize = '11pt';
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
                    margin: 0,
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
                            if (isSppd && isSppdBelakang) {
                                const clonedTitikKiri = clonedDoc.querySelectorAll('.titik-ttd.kiri-turun');
                                clonedTitikKiri.forEach(titik => {
                                    titik.innerText = '(.............................)';
                                });
                                
                                const clonedTitikKanan = clonedDoc.querySelectorAll('.titik-ttd.kanan-turun');
                                clonedTitikKanan.forEach(titik => {
                                    titik.innerText = '(.............................)';
                                });
                                
                                // Tambah jarak untuk pejabat pembuat komitmen di clone
                                const clonedPpkKiri = clonedDoc.querySelectorAll('.sppd-back-grid tr:nth-child(6) td:first-child .sppd-signature-ppk .jabatan-ppk');
                                clonedPpkKiri.forEach(jab => {
                                    jab.style.marginBottom = '60px';
                                });
                                
                                const clonedPpkKanan = clonedDoc.querySelectorAll('.sppd-back-grid tr:nth-child(6) td:last-child .sppd-signature-ppk-kanan .jabatan-ppk-kanan');
                                clonedPpkKanan.forEach(jab => {
                                    jab.style.marginBottom = '60px';
                                });
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
                            
                            // Kembalikan style asli
                            Object.keys(originalStyles).forEach(key => {
                                element.style[key] = originalStyles[key];
                            });
                            element.className = originalStyles.className;
                            
                            btn.innerHTML = originalText;
                            btn.disabled = false;
                        })
                        .catch((error) => {
                            console.error('Error detail:', error);
                            
                            // Kembalikan style asli
                            Object.keys(originalStyles).forEach(key => {
                                element.style[key] = originalStyles[key];
                            });
                            element.className = originalStyles.className;
                            
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

        window.onload = initForm;
    </script>
</body>
</html>
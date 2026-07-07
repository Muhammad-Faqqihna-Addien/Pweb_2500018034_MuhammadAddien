<?php
function hitungNilaiAkhir($tugas, $ujian) {
    return ($tugas * 0.4) + ($ujian * 0.6);
}

function tentukanPredikat($nilai) {
    if ($nilai >= 85) return "A (Sangat Memuaskan)";
    if ($nilai >= 75) return "B (Memuaskan)";
    if ($nilai >= 60) return "C (Cukup)";
    return "E (Tidak Lulus)";
}

$daftarMahasiswa = [
    "M001" => ["nama" => "Muhammad Faqqihna Addien", "tugas" => 80, "ujian" => 85],
    "M002" => ["nama" => "Hafidz Atha Ramadhan", "tugas" => 95, "ujian" => 90],
    "M003" => ["nama" => "Rachmad Hanafi", "tugas" => 60, "ujian" => 55],
    "M004" => ["nama" => "Galih Ramadani Pamungkas", "tugas" => 75, "ujian" => 80]
];

foreach ($daftarMahasiswa as $nim => $data) {
    $na = hitungNilaiAkhir($data['tugas'], $data['ujian']);
    $daftarMahasiswa[$nim]['nilai_akhir'] = $na;
    $daftarMahasiswa[$nim]['predikat'] = tentukanPredikat($na);
}

$mahasiswaUrut = $daftarMahasiswa;
uasort($mahasiswaUrut, function($a, $b) {
    return $b['nilai_akhir'] <=> $a['nilai_akhir'];
});

reset($mahasiswaUrut);
$topNIM = key($mahasiswaUrut);
$topData = current($mahasiswaUrut);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penilaian Mahasiswa - PWeb2026</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f7f6; }
        .container { max-width: 800px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.05); margin: auto; }
        h2, h3 { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; margin-bottom: 30px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #3498db; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .highlight-box { background-color: #e8f4fd; border-left: 5px solid #2ecc71; padding: 15px; border-radius: 4px; margin-top: 20px; }
        .footer-info { font-size: 12px; color: #7f8c8d; margin-top: 20px; text-align: center; }
    </style>
</head>
<body>

<div class="container">
    <h2>Sistem Manajemen Performa Mahasiswa</h2>
    
    <h3>1. Daftar Semua Mahasiswa (Urutan Data Asli)</h3>
    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama Lengkap</th>
                <th>Nilai Tugas</th>
                <th>Nilai Ujian</th>
                <th>Nilai Akhir</th>
                <th>Predikat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftarMahasiswa as $nim => $mhs): ?>
            <tr>
                <td><?= $nim ?></td>
                <td><?= $mhs['nama'] ?></td>
                <td><?= $mhs['tugas'] ?></td>
                <td><?= $mhs['ujian'] ?></td>
                <td><?= $mhs['nilai_akhir'] ?></td>
                <td><?= $mhs['predikat'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>2. Peringkat Nilai Tertinggi (Hasil Perulangan & `uasort`)</h3>
    <table>
        <thead>
            <tr>
                <th>Peringkat</th>
                <th>NIM</th>
                <th>Nama Lengkap</th>
                <th>Nilai Akhir</th>
                <th>Predikat</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach ($mahasiswaUrut as $nim => $mhs): 
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $nim ?></td>
                <td><?= $mhs['nama'] ?></td>
                <td><strong><?= $mhs['nilai_akhir'] ?></strong></td>
                <td><?= $mhs['predikat'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>3. Analisis Pointer Array (`reset()`, `current()`, `key()`)</h3>
    <div class="highlight-box">
        <strong>Mahasiswa Lulusan Terbaik Berdasarkan Pointer Teratas:</strong><br>
        NIM: <?= $topNIM ?><br>
        Nama: <?= $topData['nama'] ?><br>
        Nilai Akhir Terbaik: <strong><?= $topData['nilai_akhir'] ?></strong> (Predikat: <?= $topData['predikat'] ?>)
    </div>

    <div class="footer-info">
        <p>Aplikasi ini memanfaatkan fungsi pengecekan PHP: 
           <code>function_exists()</code> untuk hitungNilaiAkhir = 
           <strong><?= function_exists('hitungNilaiAkhir') ? 'Tersedia/Aktif' : 'Tidak Ada' ?></strong>
        </p>
    </div>
</div>

</body>
</html>
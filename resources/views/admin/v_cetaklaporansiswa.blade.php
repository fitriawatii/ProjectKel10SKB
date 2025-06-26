<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Nilai Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .info {
            margin-bottom: 20px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        td {
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body onload="window.print()">

    <h2>Laporan Nilai Siswa</h2>

    <div class="info">
        <p><strong>Nama:</strong> {{ $siswa->nama_lengkap }}</p>
        <p><strong>NISN:</strong> {{ $siswa->nisn }}</p>
        <p><strong>Kelas:</strong> {{ $siswa->nama_kelas }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Judul Tugas</th>
                <th>Nilai</th>
                <th>Komentar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($nilai as $i => $n)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $n->nama_mapel }}</td>
                <td>{{ $n->judul_tugas }}</td>
                <td class="text-center">{{ $n->nilai }}</td>
                <td>{{ $n->komentar }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data nilai ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>

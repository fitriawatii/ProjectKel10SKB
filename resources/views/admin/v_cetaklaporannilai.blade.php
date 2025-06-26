<!DOCTYPE html>
<html>
<head>
    <title>Laporan Nilai Siswa</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
    </style>
</head>
<body onload="window.print()">
    <h2>Laporan Nilai Siswa</h2>
    <p><strong>Kelas:</strong> {{ $kelas->nama_kelas }}<br>
       <strong>Mapel:</strong> {{ $mapel->nama_mapel }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>NISN</th>
                <th>Judul Tugas</th>
                <th>Nilai</th>
                <th>Komentar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($nilai as $i => $n)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $n->nama_lengkap }}</td>
                <td>{{ $n->nisn }}</td>
                <td>{{ $n->judul_tugas }}</td>
                <td>{{ $n->nilai }}</td>
                <td>{{ $n->komentar }}</td>
            </tr>
            @empty
            <tr><td colspan="6">Tidak ada data nilai ditemukan.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

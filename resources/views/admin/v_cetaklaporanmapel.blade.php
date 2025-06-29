<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Nilai Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h2, h3 { text-align: center; margin-bottom: 10px; }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
            font-size: 12px;
            margin-top: 30px;
        }
    </style>
</head>
<body onload="window.print()">

    <h2>Laporan Nilai Siswa</h2>
    <h3>Mata Pelajaran: {{ $mapel->nama_mapel }} - {{ $mapel->nama_paket }}</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Total Nilai</th>
                <th>Rata-rata</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($rekapNilai as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data['nama_siswa'] }}</td>
                <td>{{ $data['kelas'] }}</td>
                <td>{{ $data['total_nilai'] }}</td>
                <td>{{ number_format($data['rata_rata'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-right">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>

</body>
</html>

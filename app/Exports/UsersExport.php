<?php

namespace App\Exports;

use App\Models\User;
use Dotenv\Parser\Value;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithStyles
{
    protected $data;

    // Konstruktor untuk menerima tipe ekspor
    function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mulai dengan query dasar untuk mengambil data user
        $query = User::query();

        // Menangani filter berdasarkan peran (role)
        if ($this->data == 2) {
            // Hanya pengguna Admin
            $query->role(['Superadmin', 'Admin']);
        } elseif ($this->data == 3) {
            // Hanya pengguna Umum
            $query->role('Umum');
        } elseif ($this->data == 4) {
            // Pengguna Umum yang belum melakukan voting
            $query->role('Umum')->where('is_vote', 0);
        } elseif ($this->data == 5) {
            // Pengguna Umum yang sudah melakukan voting
            $query->role('Umum')->where('is_vote', 1);
        }

        // Kolom dasar untuk semua ekspor
        $columns = ['id', 'nim', 'nama', 'email', 'hp', 'angkatan'];

        // Untuk ekspor Admin, hapus kolom 'is_vote'
        if ($this->data == 2) {
            $users = $query->get($columns);
        } else {
            // Untuk ekspor lainnya, gunakan kolom dasar + 'is_vote'
            $columns[] = 'is_vote';
            $users = $query->get($columns);
        }

        // Terapkan transformasi is_vote jika ada (untuk ekspor selain Admin)
        if ($this->data != 2) {
            $users = $this->transformIsVote($users);
        }

        // Untuk export "All", tambahkan kolom role
        if ($this->data == 1 || $this->data == 2) {
            $users->transform(function ($user) {
                // Tambahkan role ke setiap user
                $user->role = $user->getRoleNames()->implode(', '); // Gabungkan nama role jika lebih dari satu
                return $user;
            });
        }

        return $users;
    }

    /**
     * Menambahkan header tabel yang dinamis berdasarkan tipe ekspor.
     *
     * @return array
     */
    public function headings(): array
    {
        $headings = [
            1 => ['ID', 'NIM', 'Nama', 'Email', 'Telepon', 'Angkatan', 'Status Voting', 'Role'], // Semua pengguna + Role
            2 => ['ID', 'NIM', 'Nama', 'Email', 'Telepon', 'Angkatan', 'Role'], // Pengguna Admin (tanpa 'is_vote')
            3 => ['ID', 'NIM', 'Nama', 'Email', 'Telepon', 'Angkatan', 'Status Voting'], // Pengguna Umum
            4 => ['ID', 'NIM', 'Nama', 'Email', 'Telepon', 'Angkatan', 'Status Voting'], // Pengguna Umum yang belum voting
            5 => ['ID', 'NIM', 'Nama', 'Email', 'Telepon', 'Angkatan', 'Status Voting'], // Pengguna Umum yang sudah voting
        ];

        return $headings[$this->data] ?? ['Nama', 'Email', 'Status Voting', 'Tanggal Dibuat'];
    }

    /**
     * Mengubah kolom 'is_vote' menjadi teks 'Sudah Vote' atau 'Belum Vote'.
     *
     * @param  \Illuminate\Support\Collection  $collection
     * @return \Illuminate\Support\Collection
     */
    public function transformIsVote($collection)
    {
        return $collection->map(function ($item) {
            // Mengubah nilai is_vote menjadi teks
            if ($item->is_vote !== null) {
                $item->is_vote = $item->is_vote == 1 ? 'Sudah Vote' : 'Belum Vote';
            }
            return $item;
        });
    }

    /**
     * Menambahkan styling (warna) pada header dan data.
     *
     * @param Worksheet $sheet
     * @return void
     */
    public function styles(Worksheet $sheet)
    {
        // Menerapkan gaya pada header (warna latar belakang hijau)
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['argb' => '4CAF50'],
            ]
        ]);

        // Menambahkan warna pada data berdasarkan status vote
        $highestRow = $sheet->getHighestRow(); // Dapatkan nomor baris tertinggi
        $IndexStatus = 7;
        $IndexRole = 8;

        // Iterasi melalui semua baris mulai dari baris kedua (baris pertama adalah header)
        for ($row = 2; $row <= $highestRow; $row++) {
            // Ambil nilai cell pada kolom 'is_vote' (kolom H)
            $ValueRole = $sheet->getCell([$IndexRole, $row])->getValue();
            if ($ValueRole == 'Superadmin' || $ValueRole == 'Admin') {
                $sheet->getStyle("A$row:H$row")->applyFromArray([
                    'font' => ['color' => ['argb' => 'FFFFFF']], // Warna teks putih
                    'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => '0000FF']], // Biru
                ]);
            } else {
                $ValueStatus = $sheet->getCell([$IndexStatus, $row])->getValue();

                // Terapkan gaya berdasarkan status voting
                if ($ValueStatus == 'Sudah Vote') {
                    $sheet->getStyle("A$row:H$row")->applyFromArray([
                        'font' => ['color' => ['argb' => 'FFFFFF']], // Warna teks putih
                        'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => '8BC34A']], // Hijau
                    ]);
                } elseif ($ValueStatus == 'Belum Vote') {
                    $sheet->getStyle("A$row:H$row")->applyFromArray([
                        'font' => ['color' => ['argb' => 'FFFFFF']], // Warna teks putih
                        'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF5722']], // Merah
                    ]);
                }
            };
        }

        foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}

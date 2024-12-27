<?php

namespace App\Exports;

use App\Models\LogVoting;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class LogVotingExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return LogVoting::join('users', 'log_votings.user_id', '=', 'users.id')
            ->select('log_votings.user_id', 'users.nim', 'users.nama', 'log_votings.created_at')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIM',
            'Nama',
            'Waktu',
        ];
    }

    public function map($row): array
    {
        // Carbon::parse($item->created_at)->isoFormat('H:m:s, D MMMM Y')
        $formattedCreatedAt = $row->created_at ? Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->locale('id')->isoFormat('D MMMM YYYY, HH:mm:ss') : 'N/A';
        return [
            $row->user_id,
            $row->nim,
            $row->nama,
            $formattedCreatedAt
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Menerapkan gaya pada header (warna latar belakang hijau)
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['argb' => '4CAF50'],
            ]
        ]);

        foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}

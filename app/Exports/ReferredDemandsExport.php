<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReferredDemandsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithEvents, WithStyles
{
    private $row;

    private $columnChar;

    public function collection()
    {
        $userId = getUserId();

        $statusId = getStatusId('todo');

        $referredDemands = Ticket::with('user')->where([['status_id', $statusId], ['referred_id', $userId]])->get();

        $this->row = $referredDemands->count() + 1;

        $count = count($this->headings());

        $this->columnChar = getEndColumn($count);

        return $referredDemands;
    }

    public function headings(): array
    {
        return [
            'نام درخواست دهنده',
            'عنوان',
            'متن درخواست',
            'تاریخ ایجاد'
        ];
    }

    public function map($referredDemands): array
    {
        return [
            $referredDemands->user->name,
            $referredDemands->subject,
            $referredDemands->content,
            jdate($referredDemands->created_at),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);

                $columnChar = $this->columnChar;
                $row = $this->row;

                $event->sheet->getStyle("A1:$columnChar$row")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // $sheet->getStyle('1:1')->getFont()->setBold(true);

        return [
            // Style the first row as bold text.
            1    => [
                'font' => [
                    'name' => 'Calibri',
                    'size' => 12,
                    'bold' => true
                ]
            ],

            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            'A:Z'  => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ]
        ];
    }
}

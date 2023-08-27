<?php

namespace App\Exports;

use App\Models\Phonebook;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PhonebooksExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithEvents, WithStyles, WithColumnFormatting
{
    private $row;

    private $columnChar;

    private $fields = ['نام', 'شماره تماس'];

    public function collection()
    {
        $phonebooks = Phonebook::get();

        $this->row = $phonebooks->count() + 1;

        $count = count($this->headings());

        $this->columnChar = getEndColumn($count);

        return $phonebooks;
    }

    public function headings(): array
    {
        return $this->fields;
    }

    public function map($phonebooks): array
    {

        return [
            $phonebooks->name,
            $phonebooks->phone,
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

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
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

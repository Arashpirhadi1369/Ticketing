<?php

namespace App\Exports;

use App\Models\AssetTurnover;
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

class AssetTurnoversExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithEvents, WithStyles, WithColumnFormatting
{
    private $row;

    private $columnChar;

    private $fields = [
        'پلاک دارایی',
        'نام دارایی',
        'واحد مسئول',
        'شخص تحویل گیرنده',
        'محل قرارگیری',
        'تاریخ تحویل',
        'مغایرت',
        'توضیحات',
        'نام کاربر ثبت کننده',
        'تاریخ ایجاد'
    ];

    public function collection()
    {
        $assetTurnovers = AssetTurnover::get();

        $this->row = $assetTurnovers->count() + 1;

        $count = count($this->headings());

        $this->columnChar = getEndColumn($count);

        return $assetTurnovers;
    }

    public function headings(): array
    {
        return $this->fields;
    }

    public function map($assetTurnovers): array
    {
        if ($assetTurnovers->conflict == 1) {
            $assetTurnovers->conflict = 'دارد';
        } else {
            $assetTurnovers->conflict = 'ندارد';
        }

        return [
            $assetTurnovers->asset->asset_tag,
            $assetTurnovers->asset->asset_name,
            __($assetTurnovers->unit),
            __($assetTurnovers->belong_to_user),
            $assetTurnovers->asset_location,
            $assetTurnovers->delivery_date,
            $assetTurnovers->conflict,
            $assetTurnovers->description,
            __($assetTurnovers->user->name),
            jdate($assetTurnovers->created_at)
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

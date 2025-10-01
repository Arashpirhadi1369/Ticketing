<?php

namespace App\Exports;

use App\Models\CourseUser;
use Illuminate\Support\Arr;
use App\Models\EffectivenessUser;
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

class EffectivenessesUserExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithEvents, WithStyles, WithColumnFormatting
{
    private $row;

    private $columnChar;

    private $result;

    private $fields = [
        'نوع دوره',
        'نام دوره',
        'آموزشگاه / مدرس',
        'زمان دوره (به ساعت)',
        'شرکت کننده',
        'واحد',
        'مدیر',
        'تاریخ شروع',
        'تاریخ پایان',
        'تاریخ تکمیل فرم اثربخشی',
        'سوالات اثربخشی',
        'پاسخ سوال'
    ];

    public function collection()
    {
        $effectivenessUsers = EffectivenessUser::with('courseUser', 'effectivenessQuestion', 'effectivenessQuestionAnswer')->get();

        $this->result = CourseUser::get();

        $this->row = $effectivenessUsers->count() + 1;

        $count = count($this->headings());

        $this->columnChar = getEndColumn($count);

        return $effectivenessUsers;
    }

    public function headings(): array
    {
        return $this->fields;
    }

    public function map($effectivenessUsers): array
    {
        $rowData = [];

        foreach ($this->fields as $field) {
            if ($field == 'نوع دوره') {
                $rowData[] = $effectivenessUsers->courseUser->course->category->name;
            } elseif ($field == 'نام دوره') {
                $rowData[] = $effectivenessUsers->courseUser->course->name;
            } elseif ($field == 'آموزشگاه / مدرس') {
                $rowData[] = $effectivenessUsers->courseUser->lecturer;
            } elseif ($field == 'زمان دوره (به ساعت)') {
                $rowData[] = $effectivenessUsers->courseUser->course->duration_hour;
            } elseif ($field == 'شرکت کننده') {
                $rowData[] = __($effectivenessUsers->courseUser->user->name);
            } elseif ($field == 'واحد') {
                $rowData[] = $effectivenessUsers->courseUser->unit->name;
            } elseif ($field == 'مدیر') {
                $rowData[] = __($effectivenessUsers->courseUser->managerUser->name);
            } elseif ($field == 'هزینه پیامک') {
                $rowData[] = $effectivenessUsers->courseUser->course->duration_hour;
            } elseif ($field == 'تاریخ شروع') {
                $rowData[] = $effectivenessUsers->courseUser->start_date;
            } elseif ($field == 'تاریخ پایان') {
                $rowData[] = $effectivenessUsers->courseUser->end_date;
            } elseif ($field == 'تاریخ تکمیل فرم اثربخشی') {
                $rowData[] = $effectivenessUsers->courseUser->effectiveness_finished_date;
            } elseif ($field == 'سوالات اثربخشی') {
                $rowData[] = $effectivenessUsers->effectivenessQuestion->question;
            } elseif ($field == 'پاسخ سوال') {
                if ($effectivenessUsers->effectivenessQuestionAnswer != null) {
                    $rowData[] = $effectivenessUsers->effectivenessQuestionAnswer->answer;
                } else {
                    $rowData[] = null;
                }
            }
        }

        return array_chunk($rowData, count($this->fields));
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
        $productsCell = [];
        $startRow = 2;
        $endRow = 1;

        foreach ($this->result as $courseUser) {
            $endRow = $endRow + $courseUser->course->effectiveness->questions_count;

            $productsCell[] = [
                "A$startRow:A$endRow",
                "B$startRow:B$endRow",
                "C$startRow:C$endRow",
                "D$startRow:D$endRow",
                "E$startRow:E$endRow",
                "F$startRow:F$endRow",
                "G$startRow:G$endRow",
                "H$startRow:H$endRow",
                "I$startRow:I$endRow",
                "J$startRow:J$endRow"
            ];

            $startRow = $endRow + 1;
        }

        $mergedCells = Arr::flatten($productsCell);

        $sheet->setMergeCells($mergedCells);

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

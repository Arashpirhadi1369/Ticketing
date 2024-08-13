<?php

namespace App\Exports;

use App\Models\CourseUser;
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

class CoursesUsersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithEvents, WithStyles, WithColumnFormatting
{
    private $row;

    private $columnChar;

    private $fields = [
        'نام دوره',
        'نوع دوره',
        'آموزشگاه / مدرس',
        'زمان دوره (به ساعت)',
        'شرکت کننده',
        'واحد',
        'مدیر',
        'تاریخ شروع',
        'تاریخ پایان',
        'تاریخ تکمیل فرم نظرسنجی',
        'تاریخ تکمیل فرم اثربخشی',
    ];

    public function collection()
    {
        $coursesUsers = CourseUser::get();

        $this->row = $coursesUsers->count() + 1;

        $count = count($this->headings());

        $this->columnChar = getEndColumn($count);

        return $coursesUsers;
    }

    public function headings(): array
    {
        return $this->fields;
    }

    public function map($coursesUsers): array
    {

        return [
            $coursesUsers->course->name,
            $coursesUsers->course->category->name,
            $coursesUsers->lecturer,
            $coursesUsers->course->duration_hour,
            __($coursesUsers->user->name),
            $coursesUsers->unit->name,
            __($coursesUsers->managerUser->name),
            $coursesUsers->start_date,
            $coursesUsers->end_date,
            $coursesUsers->survey_finished_date,
            $coursesUsers->effectiveness_finished_date,
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

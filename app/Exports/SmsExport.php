<?php

namespace App\Exports;

use App\Models\Sms;
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


class SmsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithEvents, WithStyles, WithColumnFormatting
{
    private $row;

    private $columnChar;

    private $fields = [
        'شماره ارسال', 'نام ارسال کننده', 'نام دریافت کننده', 'شماره دریافت کننده', 'متن پیامک', 'وضعیت پیامک', 'هزینه پیامک', 'تاریخ ایجاد'
    ];

    public function collection()
    {
        $sms = Sms::with('senderUser', 'receiverUser')->get();

        $this->row = $sms->count() + 1;

        $count = count($this->headings());

        $this->columnChar = getEndColumn($count);

        return $sms;
    }

    public function headings(): array
    {
        return $this->fields;
    }

    public function map($sms): array
    {

        $rowData = [];

        foreach ($this->fields as $field) {
            if ($field == 'شماره ارسال') {
                $rowData[] = $sms->source_number;
            } elseif ($field == 'نام ارسال کننده') {
                if ($sms->senderUser != null) {
                    $rowData[] = $sms->senderUser->name;
                } else {
                    $rowData[] = $sms->senderUser;
                }
            } elseif ($field == 'نام دریافت کننده') {
                if ($sms->receiverUser != null) {
                    $rowData[] = $sms->receiverUser->name;
                } else {
                    $rowData[] = $sms->receiverUser;
                }
            } elseif ($field == 'شماره دریافت کننده') {
                if ($sms->receiverUser != null) {
                    $rowData[] = $sms->receiverUser->phone;
                } else {
                    $rowData[] = $sms->receiverUser;
                }
            } elseif ($field == 'متن پیامک') {
                $rowData[] = $sms->message;
            } elseif ($field == 'وضعیت پیامک') {
                if ($sms->status == 1) {
                    $rowData[] =  'ارسال شده';
                } else {
                    $rowData[] =  'خطا';
                }
            } elseif ($field == 'هزینه پیامک') {
                $rowData[] = $sms->cost;
            } elseif ($field == 'تاریخ ایجاد') {
                $rowData[] = jdate($sms->created_at)->format('Y-m-d H:i:s');
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

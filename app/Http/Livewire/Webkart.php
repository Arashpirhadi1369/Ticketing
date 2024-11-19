<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Webkart extends Component
{
    public $personNumber;
    public $year;
    public $month;
    public $beginDay;
    public $endDay;
    public $beginTime;
    public $endTime;
    public $duration;

    public function render()
    {
        return view('livewire.webkart');
    }

    public function store()
    {
        $personNumber = $this->personNumber;
        $year         = $this->year;
        $month        = $this->month;
        $beginDay     = $this->beginDay;
        $endDay       = $this->endDay;
        $beginTime    = $this->beginTime;
        $endTime      = $this->endTime;
        $duration     = $this->endTime;

        $updatedRow = 0;

        for ($i = 0; $i < $endDay; $i++) {
            $beginDate = $month . '/' . $beginDay;

            $beginDay = $beginDay + 1;
            if ($beginDay < 10) {
                $beginDay = '0' . $beginDay;
            }

            $selected = DB::connection('webkart')->select(DB::raw("SELECT * FROM EOS_$year.dbo.IOInfo WHERE PERNO = $personNumber AND BEGINDATE = '$beginDate'"));
            dump($selected);
            if (count($selected) == 1) {
                DB::connection('webkart')->update(
                    DB::raw(
                        "UPDATE EOS_1403.dbo.IOInfo SET
                        BEGINTIME    = '$beginTime',
                        BBEGINTIME   = '$beginTime',
                        -- ENDTIME      = '$endTime',
                        -- BENDTIME     = '$endTime',
                        ENDDATE      = '$beginDate',
                        BENDDATE     = '$beginDate',
                        LastEditDate = '$beginDate',
                        -- DURATION     = '$duration'
                        BEGINCLOCK   = 1,
                        ENDCLOCK     = 1,
                        BeginComCode = 1,
                        EndComCode   = 1
                        WHERE PERNO = $personNumber AND BEGINDATE = '$beginDate'"
                    )
                );
            }

            $updatedRow = ++$updatedRow;
            dump($updatedRow . 'Rows Effected');
        }
    }
}

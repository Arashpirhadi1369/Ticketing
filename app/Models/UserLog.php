<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserLog extends Model
{
    use HasFactory;

    protected $fillable = ['ip', 'user_id', 'table_id', 'action_id', 'record_id', 'attribute', 'old', 'new'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(TableName::class);
    }

    public static function getTableId($tableName)
    {
        return DB::table('table_names')->where('name', $tableName)->first()->id;
    }

    public static function getChangesAfterUpdate($model)
    {
        $changeNames = [];
        $old     = [];
        $new     = [];

        if ($model->wasChanged()) {
            foreach ($model->getChanges() as $key => $value) {
                if ($key == 'updated_at') {
                    continue;
                } else {
                    $changeNames[] = $key;
                    $old[] = $model->getOriginal($key);
                    $new[] = $value;
                }
            }

            $changes = [];
            foreach ($changeNames as $key => $value) {
                $changes[] = [$value => ['old' => $old[$key], 'new' => $new[$key]]];
            }

            return $changes;
        }
    }
}

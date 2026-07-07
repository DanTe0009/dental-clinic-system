<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Xray extends Model
{
    protected $table='XRAY';

    protected $primaryKey='xray_id';

    public $timestamps=false;

    protected $fillable=[
        'record_id',
        'file_path',
        'xray_date',
        'xray_type'
    ];

    public function record()
    {
        return $this->belongsTo(DentalRecord::class,'record_id');
    }
}
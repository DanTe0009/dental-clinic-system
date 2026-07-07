<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $table='TREATMENT';

    protected $primaryKey='treatment_id';

    public $timestamps=false;

    protected $fillable=[
        'record_id',
        'treatment_name',
        'treatment_cost',
        'treatment_date'
    ];

    public function record()
    {
        return $this->belongsTo(DentalRecord::class,'record_id');
    }
}
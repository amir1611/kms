<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $primaryKey = 'id';

    protected $fillable = [
        'kiosk_id',
        'report_month',
        'report_monthly_revenue',
        'report_operating_hour',
        'report_remark',
        'report_pdf',
        'report_status',
        'report_suggestion',
    ];

    protected $casts = [
        'report_month' => 'datetime',
    ];

    public function kiosk()
    {
      //  return $this->belongsTo(Kiosk::class); // Assuming you have a Kiosk model
    }
}

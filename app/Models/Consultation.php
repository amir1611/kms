<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'date',
        'ref_slot_id',
        'description',
        'document',
        'ref_location_id',
        'managed_by',
        'sp_id',
        'app_id',
        'cons_id',
        'ref_status_id'
    ];

    public function managed_by()
    {
        return $this->belongsTo(User::class, 'managed_by');
    }

    public function spouse()
    {
        return $this->belongsTo(Spouse::class, 'sp_id');
    }
    
    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'app_id');
    }

    public function consultant()
    {
        return $this->belongsTo(Consultant::class, 'cons_id');
    }

    public function location()
    {
        return $this->belongsTo(Reference::class, 'ref_location_id');
    }

    public function slot()
    {
        return $this->belongsTo(Reference::class, 'ref_slot_id');
    }
    
    public function status()
    {
        return $this->belongsTo(Reference::class, 'ref_status_id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TellerTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'sender_id',
        'receiver_id',
        'employee_id',
        'amount',
        'country',
        'type',
        'paid',
        'status',
        'iban',
        'swift',
        'bank_name',
        'bank_city',
        'ifsc',
        'routeing_number',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'order_type',
        'business_id',
        'business_name',
        'email',
        'application_date',
        'expiration_date',
    ];

    public function reminder(): HasOne
    {
        return $this->hasOne(Reminder::class)->activeReminders();
    }
}

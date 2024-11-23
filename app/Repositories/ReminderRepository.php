<?php

namespace App\Repositories;

use App\Enums\ReminderStatus;
use App\Enums\ReminderTypes;
use App\Models\Reminder;
use Illuminate\Database\Eloquent\Model;

class ReminderRepository extends BaseRepositories
{
    public function __construct()
    {
        parent::__construct(new Reminder());
    }

    public function update(int $orderId)
    {
        return $this->model
            ->where('order_id', $orderId)
            ->update(['status' => ReminderStatus::INACTIVE->value]);
    }

    public function create(array $data): Model
    {
        return $this->model->create([
            'order_id' => $data['id'],
            'reminder_type' => ReminderTypes::PRE->value,
            'status' => ReminderStatus::ACTIVE->value
        ]);
    }
}

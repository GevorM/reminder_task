<?php

namespace App\DTO;

class CreateOrUpdateReminderDTO
{
    public int $orderId;
    public string $status;

    public function init(array $order): CreateOrUpdateReminderDTO
    {
        return (new self())
            ->setOrderId($order['status'])
            ->setStatus($order['status']);
    }

    public function setOrderId(int $orderId): CreateOrUpdateReminderDTO
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function setStatus(string $status): CreateOrUpdateReminderDTO
    {
        $this->status = $status;

        return $this;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function toArray(): array
    {
        return [
            'order_type' => $this->getOrderId(),
            'user_id' => $this->getStatus(),
        ];
    }
}

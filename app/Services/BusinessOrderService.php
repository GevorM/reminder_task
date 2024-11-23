<?php

namespace App\Services;

use App\Enums\OrderTypes;
use Carbon\Carbon;

class BusinessOrderService
{
    /**
     * @param string $orderType
     * @return array|array[]|null
     */
    public function fetchOrders(string $orderType): ?array
    {
        return $this->getBusinessOrders($orderType);
    }

    /**
     * @param string $orderType
     * @return array[]|null
     */
    private function getBusinessOrders(string $orderType): ?array
    {
        return match ($orderType) {
            OrderTypes::X->value => [
                [
                    'business_name' => 'Business A',
                    'order_id' => 1,
                    'order_type' => OrderTypes::X->value,
                    'application_date' => '2023-11-23',
                    'expiration_date' => $this->calculateExpirationDate('2023-11-23', OrderTypes::X->value),
                    'status' => 'active',
                ],
                [
                    'business_name' => 'Business A',
                    'order_type' => OrderTypes::X->value,
                    'application_date' => '2023-11-24',
                    'expiration_date' => $this->calculateExpirationDate('2023-11-24', OrderTypes::X->value),
                    'status' => 'active',
                ],
            ],
            OrderTypes::Y->value => [
                [
                    'order_id' => 3,
                    'order_type' => OrderTypes::Y->value,
                    'application_date' => '2023-11-15',
                    'expiration_date' => $this->calculateExpirationDate('2023-11-15', OrderTypes::X->value),
                    'status' => 'active',
                ],
                [
                    'order_id' => 4,
                    'order_type' => OrderTypes::Y->value,
                    'application_date' => '2023-11-10',
                    'expiration_date' => $this->calculateExpirationDate('2023-11-10', OrderTypes::X->value),
                    'status' => 'active',
                ],
            ],
            default => null,
        };
    }

    private function calculateExpirationDate(string $applicationDate, string $orderType): string
    {
        $applicationDate = Carbon::parse($applicationDate);
        return match ($orderType) {
            OrderTypes::X->value => $applicationDate->addYear()->format('Y-m-d'),
            OrderTypes::Y->value => $applicationDate->endOfYear()->format('Y-m-d'),
            default => $applicationDate->format('Y-m-d'),
        };
    }
}


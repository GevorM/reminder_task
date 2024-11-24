<?php

namespace App\DTO;

use App\Services\ReminderService;

class CreateOrderDTO
{
    public string $orderType;
    public string $userId;
    public int $businessId;
    public string $businessName;
    public string $email;
    public string $applicationDate;

    public function init(array $validateData): CreateOrderDTO
    {
        return (new self())
            ->setBusinessName($validateData['business_name'])
            ->setUserId($validateData['user_id'])
            ->setBusinessEmail($validateData['email'])
            ->setBusinessId($validateData['business_id'])
            ->setOrderType($validateData['order_type'])
            ->setApplicationDate($validateData['application_date']);
    }

    /**
     * @return string
     */
    public function getBusinessName(): string
    {
        return $this->businessName;
    }

    /**
     * @param string $businessName
     * @return $this
     */
    public function setBusinessName(string $businessName): CreateOrderDTO
    {
        $this->businessName = $businessName;

        return $this;
    }

    /**
     * @return int
     */
    public function getBusinessId(): int
    {
        return $this->businessId;
    }

    /**
     * @param int $userId
     * @return $this
     */
    public function setUserId(int $userId): CreateOrderDTO
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $businessId
     * @return $this
     */
    public function setBusinessId(int $businessId): CreateOrderDTO
    {
        $this->businessId = $businessId;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderType(): string
    {
        return $this->orderType;
    }

    /**
     * @param string $orderType
     * @return $this
     */
    public function setOrderType(string $orderType): CreateOrderDTO
    {
        $this->orderType = $orderType;

        return $this;
    }

    /**
     * @return string
     */
    public function getApplicationDate(): string
    {
        return $this->applicationDate;
    }

    /**
     * @param string $applicationDate
     * @return $this
     */
    public function setApplicationDate(string $applicationDate): CreateOrderDTO
    {
        $this->applicationDate = $applicationDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getExpirationDate(): string
    {
        return app(ReminderService::class)->calculateExpirationDate($this->applicationDate, $this->orderType);
    }

    /**
     * @return string
     */
    public function getBusinessEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setBusinessEmail(string $email): CreateOrderDTO
    {
        $this->email = $email;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'order_type' => $this->getOrderType(),
            'user_id' => $this->getUserId(),
            'business_name' => $this->getBusinessName(),
            'email' => $this->getBusinessEmail(),
            'business_id' => $this->getBusinessId(),
            'application_date' => $this->getApplicationDate(),
            'expiration_date' => $this->getExpirationDate(),
        ];
    }
}

<?php

declare(strict_types=1);

namespace Suno\Subscription\Api\Data;

interface CatalogCustomerSubscriptionInterface
{
    public const ENTITY_ID = 'entity_id';

    public const PRODUCT_ID = 'product_id';

    public const CUSTOMER_ID = 'customer_id';

    public const FREQUENCY_UNIT = 'frequency_unit';

    public const SUBSCRIPTION_DATE = 'subscription_date';

    public const IS_ACTIVE = 'is_active';

    /**
     * Get entity_id
     *
     * @return mixed
     */
    public function getEntityId();

    /**
     * Set entity_id
     *
     * @param mixed $entityId
     *
     * @return self
     */
    public function setEntityId($entityId): self;

    /**
     * Get product_id
     *
     * @return string
     */
    public function getProductId(): string;

    /**
     * Set product_id
     *
     * @param string $productId
     *
     * @return self
     */
    public function setProductId(string $productId): self;

    /**
     * Get customer_id
     *
     * @return string
     */
    public function getCustomerId(): string;

    /**
     * Set customer_id
     *
     * @param string $customerId
     *
     * @return self
     */
    public function setCustomerId(string $customerId): self;

    /**
     * Get frequency_unit
     *
     * @return string
     */
    public function getFrequencyUnit(): string;

    /**
     * Set frequency_unit
     *
     * @param string $frequencyUnit
     *
     * @return self
     */
    public function setFrequencyUnit(string $frequencyUnit): self;

    /**
     * Get subscription_date
     *
     * @return string
     */
    public function getSubscriptionDate(): string;

    /**
     * Set subscription_date
     *
     * @param string $subscriptionDate
     *
     * @return self
     */
    public function setSubscriptionDate(string $subscriptionDate): self;

    /**
     * Get is_active
     *
     * @return bool
     */
    public function isActive(): bool;

    /**
     * Set is_active
     *
     * @param bool $isActive
     *
     * @return self
     */
    public function setIsActive(bool $isActive): self;
}

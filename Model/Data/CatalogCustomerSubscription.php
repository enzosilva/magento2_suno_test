<?php

declare(strict_types=1);

namespace Suno\Subscription\Model\Data;

use Suno\Subscription\Api\Data\CatalogCustomerSubscriptionInterface;
use Suno\Subscription\Model\ResourceModel\CatalogCustomerSubscription as ResourceModel;
use Magento\Framework\Model\AbstractExtensibleModel;

class CatalogCustomerSubscription extends AbstractExtensibleModel implements CatalogCustomerSubscriptionInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'suno_catalog_product_customer_subscription';

    /**
     * @inheritdoc
     */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritdoc
     */
    public function getEntityId()
    {
        return (string) $this->_getData(self::ENTITY_ID);
    }

    /**
     * @inheritdoc
     */
    public function setEntityId($entityId): self
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * @inheritdoc
     */
    public function getProductId(): string
    {
        return (string) $this->_getData(self::PRODUCT_ID);
    }

    /**
     * @inheritdoc
     */
    public function setProductId(string $productId): self
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * @inheritdoc
     */
    public function getCustomerId(): string
    {
        return (string) $this->_getData(self::CUSTOMER_ID);
    }

    /**
     * @inheritdoc
     */
    public function setCustomerId(string $customerId): self
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * @inheritdoc
     */
    public function getFrequencyUnit(): string
    {
        return (string) $this->_getData(self::FREQUENCY_UNIT);
    }

    /**
     * @inheritdoc
     */
    public function setFrequencyUnit(string $frequencyUnit): self
    {
        return $this->setData(self::FREQUENCY_UNIT, $frequencyUnit);
    }

    /**
     * @inheritdoc
     */
    public function getSubscriptionDate(): string
    {
        return (string) $this->_getData(self::SUBSCRIPTION_DATE);
    }

    /**
     * @inheritdoc
     */
    public function setSubscriptionDate(string $subscriptionDate): self
    {
        return $this->setData(self::SUBSCRIPTION_DATE, $subscriptionDate);
    }

    /**
     * @inheritdoc
     */
    public function isActive(): bool
    {
        return (bool) $this->_getData(self::IS_ACTIVE);
    }

    /**
     * @inheritdoc
     */
    public function setIsActive(bool $isActive): self
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }
}

<?php

declare(strict_types=1);

namespace Suno\Subscription\Model\ResourceModel\CatalogCustomerSubscription;

use Suno\Subscription\Api\Data\CatalogCustomerSubscriptionInterface;
use Suno\Subscription\Model\Data\CatalogCustomerSubscription;
use Suno\Subscription\Model\ResourceModel\CatalogCustomerSubscription as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
	/**
     * @var string
     */
    protected $_idFieldName = CatalogCustomerSubscriptionInterface::ENTITY_ID;

    public function _construct()
    {
        $this->_init(
            CatalogCustomerSubscription::class,
            ResourceModel::class
        );
    }
}

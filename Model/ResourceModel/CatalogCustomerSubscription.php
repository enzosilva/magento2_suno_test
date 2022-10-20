<?php

declare(strict_types=1);

namespace Suno\Subscription\Model\ResourceModel;

use Suno\Subscription\Api\Data\CatalogCustomerSubscriptionInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CatalogCustomerSubscription extends AbstractDb
{
    /**
     * @inheritdoc
     */
    protected $_useIsObjectNew = true;

    /**
     * @inheritdoc
     */
    protected $_isPkAutoIncrement = false;

    public function _construct()
    {
        $this->_init('suno_catalog_product_customer_subscription', CatalogCustomerSubscriptionInterface::ENTITY_ID);
    }
}

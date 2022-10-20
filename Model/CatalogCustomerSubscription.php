<?php

declare(strict_types=1);

namespace Suno\Subscription\Model;

use Suno\Subscription\Api\Data\CatalogCustomerSubscriptionInterface;
use Suno\Subscription\Api\Data\CatalogCustomerSubscriptionInterfaceFactory;
use Suno\Subscription\Model\ResourceModel\CatalogCustomerSubscription as ResourceModel;
use Suno\Subscription\Model\ResourceModel\CatalogCustomerSubscription\Collection as CatalogCustomerSubscriptionCollection;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;

class CatalogCustomerSubscription extends AbstractModel
{
    public const TABLE_NAME = 'suno_catalog_product_customer_subscription';

    /**
     * @var CatalogCustomerSubscriptionInterfaceFactory
     */
    protected CatalogCustomerSubscriptionInterfaceFactory $catalogCustomerSubscriptionFactory;

    /**
     * @var DataObjectHelper
     */
    protected DataObjectHelper $dataObjectHelper;

    /**
     * @var string
     */
    protected $_eventPrefix = self::TABLE_NAME;

    public function __construct(
        CatalogCustomerSubscriptionInterfaceFactory $catalogCustomerSubscriptionFactory,
        DataObjectHelper $dataObjectHelper,
        Context $context,
        Registry $registry,
        ResourceModel $resource,
        CatalogCustomerSubscriptionCollection $resourceCollection,
        array $data = []
    ) {
        $this->catalogCustomerSubscriptionFactory = $catalogCustomerSubscriptionFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    public function getDataModel(): CatalogCustomerSubscriptionInterface
    {
        $catalogCustomerSubscriptionDataObject = $this->catalogCustomerSubscriptionFactory->create();
        $catalogCustomerSubscriptionData = $this->getData();

        $this->dataObjectHelper->populateWithArray(
            $catalogCustomerSubscriptionDataObject,
            $catalogCustomerSubscriptionData,
            CatalogCustomerSubscriptionInterface::class
        );

        return $catalogCustomerSubscriptionDataObject;
    }
}

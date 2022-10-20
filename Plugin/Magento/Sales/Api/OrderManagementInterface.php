<?php

declare(strict_types=1);

namespace Suno\Subscription\Plugin\Magento\Sales\Api;

use Magento\Sales\Api\OrderManagementInterface as Subject;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Suno\Subscription\Model\Config;
use Suno\Subscription\Model\Data\CatalogCustomerSubscription;
use Suno\Subscription\Api\CatalogCustomerSubscriptionRepositoryInterface;

class OrderManagementInterface
{
    /**
     * @var Config
     */
    private $sunoSubscriptionConfig;

    public function __construct(
        Config $sunoSubscriptionConfig,
        CatalogCustomerSubscriptionRepositoryInterface $catalogCustomerSubscriptionRepositoryInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->sunoSubscriptionConfig = $sunoSubscriptionConfig;
        $this->catalogCustomerSubscriptionRepositoryInterface = $catalogCustomerSubscriptionRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Activate product subscription when place the order
     */
    public function afterPlace(
        Subject $subject,
        OrderInterface $result
    ): OrderInterface {
        if (!$this->sunoSubscriptionConfig->isActive()) {
            return $result;
        }

        $customerId = $result->getCustomerId();
        foreach ($result->getItems() as $item) {
            $productId = $item->getProduct()->getId();

            $catalogCustomerSubscriptionList = $this->catalogCustomerSubscriptionRepositoryInterface->getByProductIdAndCustomerId(
                $productId,
                $customerId
            );

            $catalogCustomerSubscription = current($catalogCustomerSubscriptionList);
            $catalogCustomerSubscription->setIsActive(true);

            $this->catalogCustomerSubscriptionRepositoryInterface->save($catalogCustomerSubscription);
        }

        return $result;
    }
}

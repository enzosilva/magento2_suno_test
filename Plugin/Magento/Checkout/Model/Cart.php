<?php

namespace Suno\Subscription\Plugin\Magento\Checkout\Model;

use Magento\Checkout\Model\Cart as Subject;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Suno\Subscription\Model\Config;
use Suno\Subscription\Model\Data\CatalogCustomerSubscription;
use Suno\Subscription\Api\Data\CatalogCustomerSubscriptionInterfaceFactory;
use Suno\Subscription\Api\CatalogCustomerSubscriptionRepositoryInterface;

class Cart
{
    private const FREQUENCY_UNIT_MONTHLY = 'monthly';

    /**
     * @var Config
     */
    protected $sunoSubscriptionConfig;

    /**
     * @var CatalogCustomerSubscriptionInterfaceFactory
     */
    protected $catalogCustomerSubscriptionInterfaceFactory;

    /**
     * @var CatalogCustomerSubscriptionRepositoryInterface
     */
    protected $catalogCustomerSubscriptionRepositoryInterface;

    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    public function __construct(
        Config $sunoSubscriptionConfig,
        CatalogCustomerSubscriptionInterfaceFactory $catalogCustomerSubscriptionInterfaceFactory,
        CatalogCustomerSubscriptionRepositoryInterface $catalogCustomerSubscriptionRepositoryInterface,
        CustomerSession $customerSession,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->sunoSubscriptionConfig = $sunoSubscriptionConfig;
        $this->catalogCustomerSubscriptionInterfaceFactory = $catalogCustomerSubscriptionInterfaceFactory;
        $this->catalogCustomerSubscriptionRepositoryInterface = $catalogCustomerSubscriptionRepositoryInterface;
        $this->customerSession = $customerSession;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Create product subscription before add product to cart
     */
    public function beforeAddProduct(
        Subject $subject,
        $productInfo,
        $requestInfo = null
    ) {
        if (!$this->sunoSubscriptionConfig->isActive()) {
            return [$productInfo, $requestInfo];
        }

        try {
            $productId = (is_int($productInfo)) ? $productInfo : $productInfo->getId();
            $customerId = $this->customerSession->getCustomerId();

            $catalogCustomerSubscriptionList = $this->catalogCustomerSubscriptionRepositoryInterface->getByProductIdAndCustomerId(
                $productId,
                $customerId
            );

            if (!count($catalogCustomerSubscriptionList)) {
                $catalogCustomerSubscription = $this->catalogCustomerSubscriptionInterfaceFactory->create();

                $catalogCustomerSubscription->setProductId($productId);
                $catalogCustomerSubscription->setCustomerId($customerId);
                $catalogCustomerSubscription->setFrequencyUnit(self::FREQUENCY_UNIT_MONTHLY);

                $this->catalogCustomerSubscriptionRepositoryInterface->save($catalogCustomerSubscription);
            }
        } catch (\Exception $e) {
            throw new LocalizedException(__("Couldn't be made the subscription."));
        }

        return [$productInfo, $requestInfo];
    }
}
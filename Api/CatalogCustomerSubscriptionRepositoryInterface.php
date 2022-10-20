<?php

declare(strict_types=1);

namespace Suno\Subscription\Api;

use Suno\Subscription\Api\Data\CatalogCustomerSubscriptionInterface;
use Suno\Subscription\Api\Data\CatalogCustomerSubscriptionSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\SearchResultsInterface;

interface CatalogCustomerSubscriptionRepositoryInterface
{
    /**
     * Save CatalogCustomerSubscription
     *
     * @param CatalogCustomerSubscriptionInterface $catalogCustomerSubscription
     *
     * @return bool true on success
     * @throws CouldNotSaveException
     */
    public function save(
        CatalogCustomerSubscriptionInterface $catalogCustomerSubscription
    ): bool;

    /**
     * Retrieve CatalogCustomerSubscription
     *
     * @param string $entityId
     *
     * @return CatalogCustomerSubscriptionInterface|null
     */
    public function get(
    	string $entityId
    ): ?CatalogCustomerSubscriptionInterface;

    /**
     * Retrieve CatalogCustomerSubscription by Product ID and Customer ID
     *
     * @param string $productId
     * @param string $customerId
     *
     * @return CatalogCustomerSubscriptionInterface|null
     */
    public function getByProductIdAndCustomerId(
        string $productId,
        string $customerId
    ): ?array;

    /**
     * Retrieve CatalogCustomerSubscription matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return CatalogCustomerSubscriptionSearchResultsInterface|SearchResultsInterface
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete CatalogCustomerSubscription
     *
     * @param CatalogCustomerSubscriptionInterface $catalogCustomerSubscription
     *
     * @return bool true on success
     * @throws CouldNotDeleteException
     */
    public function delete(
        CatalogCustomerSubscriptionInterface $catalogCustomerSubscription
    ): bool;
}

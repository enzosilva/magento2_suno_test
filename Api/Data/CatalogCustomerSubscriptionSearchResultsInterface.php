<?php

declare(strict_types=1);

namespace Suno\Subscription\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface CatalogCustomerSubscriptionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get CatalogCustomerSubscription list.
     *
     * @return CatalogCustomerSubscriptionInterface[]
     */
    public function getItems(): array;

    /**
     * Set CatalogCustomerSubscription list.
     *
     * @param CatalogCustomerSubscriptionInterface[] $items
     *
     * @return self
     */
    public function setItems(array $items): self;
}

<?php

declare(strict_types=1);

namespace Suno\Subscription\Model;

use Suno\Subscription\Api\Data\CatalogCustomerSubscriptionInterface;
use Suno\Subscription\Api\Data\CatalogCustomerSubscriptionInterfaceFactory;
use Suno\Subscription\Api\Data\CatalogCustomerSubscriptionSearchResultsInterfaceFactory;
use Suno\Subscription\Api\CatalogCustomerSubscriptionRepositoryInterface;
use Suno\Subscription\Api\Data\CatalogCustomerSubscriptionSearchResultsInterface;
use Suno\Subscription\Model\ResourceModel\CatalogCustomerSubscription as ResourceModel;
use Suno\Subscription\Model\ResourceModel\CatalogCustomerSubscription\CollectionFactory as CatalogCustomerSubscriptionCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;

class CatalogCustomerSubscriptionRepository implements CatalogCustomerSubscriptionRepositoryInterface
{
    /**
     * @var ResourceModel
     */
    protected $resource;

    /**
     * @var CatalogCustomerSubscriptionFactory
     */
    protected $catalogCustomerSubscriptionFactory;

    /**
     * @var CatalogCustomerSubscriptionCollectionFactory
     */
    protected $catalogCustomerSubscriptionCollectionFactory;

    /**
     * @var CatalogCustomerSubscriptionSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    public function __construct(
        ResourceModel $resource,
        CatalogCustomerSubscriptionFactory $catalogCustomerSubscriptionFactory,
        CatalogCustomerSubscriptionCollectionFactory $catalogCustomerSubscriptionCollectionFactory,
        CatalogCustomerSubscriptionSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->resource = $resource;
        $this->catalogCustomerSubscriptionFactory = $catalogCustomerSubscriptionFactory;
        $this->catalogCustomerSubscriptionCollectionFactory = $catalogCustomerSubscriptionCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @inheritdoc
     */
    public function save(CatalogCustomerSubscriptionInterface $catalogCustomerSubscription): bool
    {
        try {
            $this->resource->save($catalogCustomerSubscription);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save CatalogCustomerSubscription: %1',
                $exception->getMessage()
            ));
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function get(string $entityId): ?CatalogCustomerSubscriptionInterface
    {
        $catalogCustomerSubscription = $this->catalogCustomerSubscriptionFactory->create();

        $this->resource->load($catalogCustomerSubscription, $entityId);

        if (!$catalogCustomerSubscription->getEntityId()) {
            return null;
        }

        return $catalogCustomerSubscription->getDataModel();
    }

    /**
     * @inheritdoc
     */
    public function getByProductIdAndCustomerId(
        string $productId,
        string $customerId
    ): ?array {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(
                CatalogCustomerSubscriptionInterface::PRODUCT_ID,
                $productId,
                'eq'
            )
            ->addFilter(
                CatalogCustomerSubscriptionInterface::CUSTOMER_ID,
                $customerId,
                'eq'
            )
            ->setPageSize(1)
            ->setCurrentPage(1)
            ->create();

        return $this->getList($searchCriteria)->getItems();
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        $collection = $this->catalogCustomerSubscriptionCollectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(CatalogCustomerSubscriptionInterface $catalogCustomerSubscription): bool
    {
        try {
            $catalogCustomerSubscriptionModel = $this->catalogCustomerSubscriptionFactory->create();

            $this->get($catalogCustomerSubscription->getEntityId());
            $this->resource->delete($catalogCustomerSubscriptionModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the CatalogCustomerSubscription: %1',
                $exception->getMessage()
            ));
        }

        return true;
    }
}

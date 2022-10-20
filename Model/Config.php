<?php

declare(strict_types=1);

namespace Suno\Subscription\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    const PATH_SUNO_SUBSCRITION_IS_ACTIVE = 'suno/subscription/is_active';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function isActive(string $scopeType = ScopeInterface::SCOPE_STORE, ?string $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::PATH_SUNO_SUBSCRITION_IS_ACTIVE,
            $scopeType,
            $storeId
        );
    }
}

<?php

namespace YelHex\SweetTracker\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    public const XML_PATH_SWEETTRACKER = 'sweettracker/';

    /**
     * GetConfigValue method
     *
     * @param var $field
     * @param var $storeId
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * GetGeneralConfig method
     *
     * @param var $code
     * @param var $storeId
     */
    public function getGeneralConfig($code, $storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_SWEETTRACKER .'general/'. $code, $storeId);
    }
}

<?php

namespace YelHex\SweetTracker\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Checkout\Model\Type\Onepage;
use Magento\Catalog\Model\CategoryFactory;
use YelHex\SweetTracker\Helper\Data;

/**
 * Class SweetTracker
 *
 *  Sweet Tracker class allow Magento 2 website to be tracked through Sweet.
 *
 * @author Tomas Marcik <tomas@yellowhexagon.com>
 */
class SweetTracker extends \Magento\Framework\View\Element\Template
{

    /** @var Onepage */
    private $onepage;

    /** @var CategoryFactory */
    private $categoryFactory;

    /** @var Data */
    private $helper;

    /**
     * Construction method
     *
     * @param Context $context
     * @param Onepage $onepage
     * @param CategoryFactory $categoryFactory
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Onepage $onepage,
        CategoryFactory $categoryFactory,
        Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->onepage = $onepage;
        $this->categoryFactory = $categoryFactory;
        $this->helper = $helper;
    }

    /**
     * GetTrackingId method
     */
    public function getTrackingId()
    {
        //Check if tracking_id
        $enabled = (bool)$this->helper->getGeneralConfig('enabled');
        $trackingId = $this->helper->getGeneralConfig('tracking_id');

        if ($enabled && $trackingId) {
            return $trackingId;
        }

        return null;
    }

    /**
     * GetOrder method
     */
    public function getOrder()
    {
        return $this->onepage->getCheckout()->getLastRealOrder();
    }

    /**
     * IsSuccessPage method
     */
    public function isSuccessPage()
    {
        return $this->getRequest()->getFullActionName() == 'checkout_onepage_success';
    }

    /**
     * GetCategoryName method
     *
     * @param var $categoryId
     */
    public function getCategoryName($categoryId)
    {
        $category = $this->categoryFactory->create()->load($categoryId);

        if ($category && $category->getId()) {
            return $category->getName();
        }

        return 'Unknown';
    }
}

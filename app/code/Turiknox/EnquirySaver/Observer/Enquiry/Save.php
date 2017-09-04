<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\EnquirySaver\Observer\Enquiry;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Turiknox\EnquirySaver\Api\EnquiryRepositoryInterface;
use Turiknox\EnquirySaver\Api\Data\EnquiryInterface;
use Turiknox\EnquirySaver\Model\EnquiryFactory;

class Save implements ObserverInterface
{
    const XML_PATH_CONTACTS_ENABLED     = 'contact/contact/enabled';
    const XML_PATH_ENQUIRYSAVER_ENABLED = 'contact/contact/enable_enquirysaver';

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var EnquiryRepositoryInterface
     */
    protected $enquiryRepository;

    /**
     * @var EnquiryFactory
     */
    protected $enquiryFactory;

    /**
     * Save constructor.
     * @param RequestInterface $request
     * @param DataObjectHelper $dataObjectHelper
     * @param ScopeConfigInterface $scopeConfig
     * @param EnquiryRepositoryInterface $enquiryRepositoryInterface
     * @param EnquiryFactory $enquiryFactory
     */
    public function __construct(
        RequestInterface $request,
        DataObjectHelper $dataObjectHelper,
        ScopeConfigInterface $scopeConfig,
        EnquiryRepositoryInterface $enquiryRepositoryInterface,
        EnquiryFactory $enquiryFactory
    ) {
        $this->request = $request;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->scopeConfig = $scopeConfig;
        $this->enquiryRepository = $enquiryRepositoryInterface;
        $this->enquiryFactory = $enquiryFactory;
    }

    /**
     * Save the enquiry
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        if ($this->canSaveContactEnquiries()) {
            $post = $this->request->getParams();
            if (isset($post['hideit']) && \Zend_Validate::is(trim($post['hideit']), 'NotEmpty')) {
                return;
            }
            $model = $this->enquiryFactory->create();
            $this->dataObjectHelper->populateWithArray($model, $post, EnquiryInterface::class);
            $this->enquiryRepository->save($model);
        }
    }

    /**
     * Check if enquiries can be saved
     * @return bool
     */
    public function canSaveContactEnquiries()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_CONTACTS_ENABLED, ScopeInterface::SCOPE_STORE)
            && $this->scopeConfig->getValue(self::XML_PATH_ENQUIRYSAVER_ENABLED, ScopeInterface::SCOPE_STORE);
    }
}

<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\EnquirySaver\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;
use Turiknox\EnquirySaver\Api\EnquiryRepositoryInterface;
use Turiknox\EnquirySaver\Controller\Adminhtml\EnquirySaver;
use Turiknox\EnquirySaver\Model\ResourceModel\Enquiry\CollectionFactory;

class MassDelete extends EnquirySaver
{
    /**
     * @var Filter
     */
    protected $_filter;

    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @var ForwardFactory
     */
    protected $_resultForwardFactory;

    /**
     * @var string
     */
    protected $_successMessage;

    /**
     * @var string
     */
    protected $_errorMessage;

    /**
     * MassDelete constructor.
     * @param Registry $registry
     * @param EnquiryRepositoryInterface $enquiryRepository
     * @param PageFactory $resultPageFactory
     * @param ForwardFactory $resultForwardFactory
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param $successMessage
     * @param $errorMessage
     */
    public function __construct(
        Registry $registry,
        EnquiryRepositoryInterface $enquiryRepository,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        $successMessage,
        $errorMessage
    ) {
        parent::__construct($registry, $enquiryRepository, $resultPageFactory, $resultForwardFactory, $context);
        $this->_filter            = $filter;
        $this->_collectionFactory = $collectionFactory;
        $this->_successMessage    = $successMessage;
        $this->_errorMessage      = $errorMessage;
    }

    /**
     * execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        try {
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            $collectionSize = $collection->getSize();
            foreach ($collection as $enquiry) {
                $this->_enquiryRepository->delete($enquiry);
            }
            $this->messageManager->addSuccessMessage(__($this->_successMessage, $collectionSize));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __($this->_errorMessage));
        }
        $redirectResult = $this->resultRedirectFactory->create();
        $redirectResult->setPath('enquirysaver/index');
        return $redirectResult;
    }
}

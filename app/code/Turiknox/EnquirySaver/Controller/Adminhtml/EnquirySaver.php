<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\EnquirySaver\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Turiknox\EnquirySaver\Api\EnquiryRepositoryInterface;

abstract class EnquirySaver extends Action
{
    /**
     * @var string
     */
    const ACTION_RESOURCE = 'Turiknox_EnquirySaver::contact_enquiries';

    /**
     * Enquiry repository
     *
     * @var EnquiryRepositoryInterface
     */
    protected $_enquiryRepository;

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * Result Page Factory
     *
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * Result Forward Factory
     *
     * @var ForwardFactory
     */
    protected $_resultForwardFactory;

    /**
     * EnquirySaver constructor.
     *
     * @param Registry $registry
     * @param EnquiryRepositoryInterface $enquiryRepository
     * @param PageFactory $resultPageFactory
     * @param ForwardFactory $resultForwardFactory
     * @param Context $context
     */
    public function __construct(
        Registry $registry,
        EnquiryRepositoryInterface $enquiryRepository,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Context $context

    ) {
        $this->_coreRegistry         = $registry;
        $this->_enquiryRepository    = $enquiryRepository;
        $this->_resultPageFactory    = $resultPageFactory;
        $this->_resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }
}
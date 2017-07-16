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

use Turiknox\EnquirySaver\Controller\Adminhtml\EnquirySaver;

class Edit extends EnquirySaver
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Turiknox_EnquirySaver::contact_enquiries')
            ->addBreadcrumb(__('Enquiries'), __('Enquiries'))
            ->addBreadcrumb(__('Manage Enquiries'), __('Manage Enquiries'));

        $resultPage->addBreadcrumb(__('Enquiry'), __(sprintf('Enquiry: #%s', $this->getRequest()->getParam('enquiry_id'))));
        $resultPage->getConfig()->getTitle()->prepend(__(sprintf('Enquiry: #%s', $this->getRequest()->getParam('enquiry_id'))));

        return $resultPage;
    }
}
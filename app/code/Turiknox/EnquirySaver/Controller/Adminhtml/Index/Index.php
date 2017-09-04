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

class Index extends EnquirySaver
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Turiknox_EnquirySaver::contact_enquiries');
        $resultPage->getConfig()->getTitle()->prepend(__('Contact Form Enquiries'));
        $resultPage->addBreadcrumb(__('Contact Form Enquiries'), __('Contact Form Enquiries'));
        return $resultPage;
    }
}

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

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Turiknox\EnquirySaver\Controller\Adminhtml\EnquirySaver;

class Delete extends EnquirySaver
{
    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $enquiryId = $this->getRequest()->getParam('enquiry_id');
        if ($enquiryId) {
            try {
                $this->enquiryRepository->deleteById($enquiryId);
                $this->messageManager->addSuccessMessage(__('The enquiry has been deleted.'));
                $resultRedirect->setPath('enquirysaver/index');
                return $resultRedirect;
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('The enquiry no longer exists.'));
                return $resultRedirect->setPath('enquirysaver/index');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('enquirysaver/index', ['enquiry_id' => $enquiryId]);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('There was a problem deleting the enquiry'));
                return $resultRedirect->setPath('enquirysaver/index', ['enquiry_id' => $enquiryId]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find the enquiry to delete.'));
        $resultRedirect->setPath('enquirysaver/index');
        return $resultRedirect;
    }
}

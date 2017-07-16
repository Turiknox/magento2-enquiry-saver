<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\EnquirySaver\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\ValidatorException;
use Magento\Framework\Exception\NoSuchEntityException;
use Turiknox\EnquirySaver\Api\EnquiryRepositoryInterface;
use Turiknox\EnquirySaver\Api\Data\EnquiryInterface;
use Turiknox\EnquirySaver\Api\Data\EnquiryInterfaceFactory;
use Turiknox\EnquirySaver\Model\ResourceModel\Enquiry as ResourceEnquiry;
use Turiknox\EnquirySaver\Model\ResourceModel\Enquiry\CollectionFactory as EnquiryCollectionFactory;

class EnquiryRepository implements EnquiryRepositoryInterface
{
    /**
     * @var array
     */
    protected $_instances = [];
    /**
     * @var ResourceEnquiry
     */
    protected $_resource;

    /**
     * @var EnquiryCollectionFactory
     */
    protected $_enquiryCollectionFactory;

    /**
     * @var EnquiryInterfaceFactory
     */
    protected $_enquiryInterfaceFactory;

    /**
     * @var DataObjectHelper
     */
    protected $_dataObjectHelper;

    public function __construct(
        ResourceEnquiry $resource,
        EnquiryCollectionFactory $enquiryCollectionFactory,
        EnquiryInterfaceFactory $enquiryInterfaceFactory,
        DataObjectHelper $dataObjectHelper
    )
    {
        $this->_resource = $resource;
        $this->_enquiryCollectionFactory = $enquiryCollectionFactory;
        $this->_enquiryInterfaceFactory = $enquiryInterfaceFactory;
        $this->_dataObjectHelper = $dataObjectHelper;
    }

    /**
     * @param EnquiryInterface $enquiry
     * @return EnquiryInterface
     * @throws CouldNotSaveException
     */
    public function save(EnquiryInterface $enquiry)
    {
        try {
            /** @var EnquiryInterface|\Magento\Framework\Model\AbstractModel $data */
            $this->_resource->save($enquiry);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the enquiry: %1',
                $exception->getMessage()
            ));
        }
        return $enquiry;
    }

    /**
     * Get enquiry record
     *
     * @param $enquiryId
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($enquiryId)
    {
        if (!isset($this->_instances[$enquiryId])) {
            /** @var \Turiknox\EnquirySaver\Api\Data\EnquiryInterface|\Magento\Framework\Model\AbstractModel $enquiry */
            $enquiry = $this->_enquiryInterfaceFactory->create();
            $this->_resource->load($enquiry, $enquiryId);
            if (!$enquiry->getId()) {
                throw new NoSuchEntityException(__('Requested enquiry doesn\'t exist'));
            }
            $this->_instances[$enquiryId] = $enquiry;
        }
        return $this->_instances[$enquiryId];
    }

    /**
     * @param EnquiryInterface $enquiry
     * @return bool
     * @throws CouldNotSaveException
     * @throws StateException
     */
    public function delete(EnquiryInterface $enquiry)
    {
        /** @var \Turiknox\EnquirySaver\Api\Data\EnquiryInterface|\Magento\Framework\Model\AbstractModel $enquiry */
        $id = $enquiry->getId();
        try {
            unset($this->_instances[$id]);
            $this->_resource->delete($enquiry);
        } catch (ValidatorException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new StateException(
                __('Unable to remove enquiry %1', $id)
            );
        }
        unset($this->_instances[$id]);
        return true;
    }

    /**
     * @param $enquiryId
     * @return bool
     */
    public function deleteById($enquiryId)
    {
        $enquiry = $this->getById($enquiryId);
        return $this->delete($enquiry);
    }
}
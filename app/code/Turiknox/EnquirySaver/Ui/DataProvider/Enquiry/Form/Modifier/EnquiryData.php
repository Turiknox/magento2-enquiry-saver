<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\EnquirySaver\Ui\DataProvider\Enquiry\Form\Modifier;

use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Turiknox\EnquirySaver\Model\ResourceModel\Enquiry\CollectionFactory;

class EnquiryData implements ModifierInterface
{
    /**
     * @var \Turiknox\EnquirySaver\Model\ResourceModel\Enquiry\Collection
     */
    protected $collection;

    /**
     * @param CollectionFactory $enquiryCollectionFactory
     */
    public function __construct(
        CollectionFactory $enquiryCollectionFactory
    ) {
        $this->collection = $enquiryCollectionFactory->create();
    }

    /**
     * @param array $meta
     * @return array
     */
    public function modifyMeta(array $meta)
    {
        return $meta;
    }

    /**
     * @param array $data
     * @return array|mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function modifyData(array $data)
    {
        $items = $this->collection->getItems();
        /** @var $enquiry \Turiknox\EnquirySaver\Model\Enquiry */
        foreach ($items as $enquiry) {
            $_data = $enquiry->getData();
            $enquiry->setData($_data);
            $data[$enquiry->getId()] = $_data;
        }
        return $data;
    }
}

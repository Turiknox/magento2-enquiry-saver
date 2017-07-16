<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\EnquirySaver\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Store\Model\StoreManagerInterface;

class Enquiry extends AbstractDb
{
    /**
     * @var DateTime
     */
    protected $_date;

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManagerInterface;

    /**
     * Enquiry constructor.
     * @param Context $context
     * @param DateTime $dateTime
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        DateTime $dateTime,
        StoreManagerInterface $storeManager
    ) {
        $this->_date = $dateTime;
        $this->_storeManagerInterface = $storeManager;
        parent::__construct($context);
    }

    /**
     * Resource initialisation
     */
    protected function _construct()
    {
        $this->_init('turiknox_enquirysaver_enquiries', 'enquiry_id');
    }

    /**
     * @param AbstractModel $object
     * @return $this
     */
    protected function _beforeSave(AbstractModel $object)
    {
        $object->setStoreId($this->_storeManagerInterface->getStore()->getId());
        if ($object->isObjectNew()) {
            $object->setCreatedAt($this->_date->gmtDate());
        }
        return parent::_beforeSave($object);
    }
}
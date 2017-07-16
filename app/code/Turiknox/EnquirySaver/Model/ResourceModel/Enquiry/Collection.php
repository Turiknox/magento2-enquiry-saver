<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\EnquirySaver\Model\ResourceModel\Enquiry;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'enquiry_id';

    /**
     * Collection initialisation
     */
    protected function _construct()
    {
        $this->_init(
            'Turiknox\EnquirySaver\Model\Enquiry',
            'Turiknox\EnquirySaver\Model\ResourceModel\Enquiry'
        );
    }
}
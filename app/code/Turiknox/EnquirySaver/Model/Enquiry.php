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

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Turiknox\EnquirySaver\Api\Data\EnquiryInterface;

class Enquiry extends AbstractModel implements EnquiryInterface
{

    /**
     * Cache tag
     */
    const CACHE_TAG = 'turiknox_enquirysaver_enquiries';

    /**
     * Sliders constructor.
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    )
    {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Initialise resource model
     */
    protected function _construct()
    {
        $this->_init('Turiknox\EnquirySaver\Model\ResourceModel\Enquiry');
    }

    /**
     * Get cache identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(EnquiryInterface::NAME);
    }

    /**
     * Set name
     *
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(EnquiryInterface::NAME, $name);
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(EnquiryInterface::EMAIL);
    }

    /**
     * Set email
     *
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        return $this->setData(EnquiryInterface::EMAIL, $email);
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->getData(EnquiryInterface::TELEPHONE);
    }

    /**
     * Set telephone
     *
     * @param $telephone
     * @return $this
     */
    public function setTelephone($telephone)
    {
        return $this->setData(EnquiryInterface::TELEPHONE, $telephone);
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->getData(EnquiryInterface::COMMENT);
    }

    /**
     * Set comment
     *
     * @param $comment
     * @return $this
     */
    public function setComment($comment)
    {
        return $this->setData(EnquiryInterface::COMMENT, $comment);
    }
}
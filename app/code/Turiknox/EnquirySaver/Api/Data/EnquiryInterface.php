<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\EnquirySaver\Api\Data;

/**
 * @api
 */
interface EnquiryInterface
{
    const ENQUIRY_ID    = 'enquiry_id';
    const NAME          = 'name';
    const EMAIL         = 'email';
    const TELEPHONE     = 'telephone';
    const COMMENT       = 'comment';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone();

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment();

    /**
     * Set ID
     *
     * @param $id
     * @return EnquiryInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param $name
     * @return EnquiryInterface
     */
    public function setName($name);

    /**
     * Set email
     *
     * @param $email
     * @return EnquiryInterface
     */
    public function setEmail($email);

    /**
     * Set telephone
     *
     * @param $telephone
     * @return EnquiryInterface
     */
    public function setTelephone($telephone);

    /**
     * Set comment
     *
     * @param $comment
     * @return EnquiryInterface
     */
    public function setComment($comment);
}

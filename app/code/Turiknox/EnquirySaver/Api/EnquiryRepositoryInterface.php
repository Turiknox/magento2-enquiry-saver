<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\EnquirySaver\Api;

use Turiknox\EnquirySaver\Api\Data\EnquiryInterface;

/**
 * @api
 */
interface EnquiryRepositoryInterface
{
    /**
     * Save enquiry.
     *
     * @param EnquiryInterface $enquiry
     * @return EnquiryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(EnquiryInterface $enquiry);

    /**
     * Retrieve enquiry.
     *
     * @param int $enquiryId
     * @return EnquiryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($enquiryId);

    /**
     * Delete enquiry.
     *
     * @param EnquiryInterface $enquiry
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(EnquiryInterface $enquiry);

    /**
     * Delete enquiry by ID.
     *
     * @param int $enquiryId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($enquiryId);
}
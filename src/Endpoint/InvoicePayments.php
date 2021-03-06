<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\DataObject\Collection\AbstractCollection;
use arueckauer\HarvestApi\DataObject\Collection\InvoicePayment as InvoicePaymentCollection;
use arueckauer\HarvestApi\DataObject\InvoicePayment as InvoicePaymentDataObject;
use GuzzleHttp\RequestOptions;

class InvoicePayments extends AbstractEndpoint
{
    private static $requiredCreateFields = [
        'amount' => 'amount',
    ];

    private static $optionalCreateFields = [
        'paid_at'   => 'paidAt',
        'paid_date' => 'paidDate',
        'notes'     => 'notes',
    ];

    /**
     * List all payments for an invoice
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-payments/#list-all-payments-for-an-invoice
     * @param int $invoiceId
     * @param array $options
     * @return AbstractCollection
     */
    public function all(int $invoiceId, array $options = []) : AbstractCollection
    {
        $uri      = sprintf('invoices/%s/payments', $invoiceId);
        $response = $this->getHttpClient()->get($uri, [RequestOptions::QUERY => $options]);
        return $this->getCollectionFromResponse(InvoicePaymentCollection::class, $response);
    }

    /**
     * Create an invoice payment
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-payments/#create-an-invoice-payment
     * @param int $invoiceId
     * @param InvoicePaymentDataObject $invoicePayment
     * @return AbstractDataObject
     */
    public function create(int $invoiceId, InvoicePaymentDataObject $invoicePayment) : AbstractDataObject
    {
        $data     = $this->addRequiredDataFromDataObject(static::$requiredCreateFields, [], $invoicePayment);
        $data     = $this->addOptionalDataFromDataObject(static::$optionalCreateFields, $data, $invoicePayment);
        $options  = [RequestOptions::JSON => $data];
        $uri      = sprintf('invoices/%s/payments', $invoiceId);
        $response = $this->getHttpClient()->post($uri, $options);

        return $this->getDataObjectFromResponse(InvoicePaymentDataObject::class, $response);
    }

    /**
     * Delete an invoice payment
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-payments/#delete-an-invoice-payment
     * @param int $invoiceId
     * @param int $invoicePaymentId
     * @return AbstractDataObject
     */
    public function delete(int $invoiceId, int $invoicePaymentId) : AbstractDataObject
    {
        $uri      = sprintf('invoices/%s/payments/%s', $invoiceId, $invoicePaymentId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->getDataObjectFromResponse(InvoicePaymentDataObject::class, $response);
    }
}

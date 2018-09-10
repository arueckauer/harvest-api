<?php

namespace arueckauer\Harvest\Endpoint;

use arueckauer\Harvest\Collection\AbstractCollection;
use arueckauer\Harvest\Collection\InvoicePayment as InvoicePaymentCollection;
use arueckauer\Harvest\Model\AbstractModel;
use arueckauer\Harvest\Model\InvoicePayment as InvoicePaymentModel;

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
    public function all(int $invoiceId, array $options = []): AbstractCollection
    {
        $uri      = sprintf('invoices/%s/payments', $invoiceId);
        $response = $this->getHttpClient()->get($uri, $options);
        return $this->collection(InvoicePaymentCollection::class, $response);
    }

    /**
     * Create an invoice payment
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-payments/#create-an-invoice-payment
     * @param int $invoiceId
     * @param InvoicePaymentModel $invoicePayment
     * @return AbstractModel
     */
    public function create(int $invoiceId, InvoicePaymentModel $invoicePayment): AbstractModel
    {
        $data     = $this->addRequiredDataFromModel(static::$requiredCreateFields, [], $invoicePayment);
        $data     = $this->addOptionalDataFromModel(static::$optionalCreateFields, $data, $invoicePayment);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $uri      = sprintf('invoices/%s/payments', $invoiceId);
        $response = $this->getHttpClient()->post($uri, $options);

        return $this->model(InvoicePaymentModel::class, $response);
    }

    /**
     * Delete an invoice payment
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-payments/#delete-an-invoice-payment
     * @param int $invoiceId
     * @param int $invoicePaymentId
     * @return \arueckauer\Harvest\Model\AbstractModel
     */
    public function delete(int $invoiceId, int $invoicePaymentId): AbstractModel
    {
        $uri      = sprintf('invoices/%s/payments/%s', $invoiceId, $invoicePaymentId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->model(InvoicePaymentModel::class, $response);
    }
}

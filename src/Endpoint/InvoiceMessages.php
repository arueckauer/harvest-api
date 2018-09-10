<?php

namespace arueckauer\Harvest\Endpoint;

use arueckauer\Harvest\Collection\AbstractCollection;
use arueckauer\Harvest\Collection\InvoiceMessage as InvoiceMessageCollection;
use arueckauer\Harvest\Model\AbstractModel;
use arueckauer\Harvest\Model\InvoiceMessage as InvoiceMessageModel;

class InvoiceMessages extends AbstractEndpoint
{
    private const EVENT_TYPE_SEND = 'send';

    private const EVENT_TYPE_CLOSE = 'close';

    private const EVENT_TYPE_RE_OPEN = 're-open';

    private const EVENT_TYPE_DRAFT = 'draft';

    private static $requiredCreateFields = [
        'recipients' => '',
    ];

    private static $optionalCreateFields = [
        'subject'                        => 'subject',
        'body'                           => 'body',
        'include_link_to_client_invoice' => 'includeLinkToClientInvoice',
        'attach_pdf'                     => 'attachPdf',
        'send_me_a_copy'                 => 'sendMeACopy',
        'thank_you'                      => 'thankYou',
        'event_type'                     => 'eventType',
    ];

    /**
     * List all messages for an invoice
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-messages/#list-all-messages-for-an-invoice
     * @param int $invoiceId
     * @param array $options
     * @return AbstractCollection
     */
    public function all(int $invoiceId, array $options = []): AbstractCollection
    {
        $uri      = sprintf('invoices/%s/messages', $invoiceId);
        $response = $this->getHttpClient()->get($uri, $options);
        return $this->collection(InvoiceMessageCollection::class, $response);
    }

    /**
     * Create an invoice message
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-messages/#create-an-invoice-message
     * @param int $invoiceId
     * @param InvoiceMessageModel $invoiceMessage
     * @return AbstractModel
     */
    public function create(int $invoiceId, InvoiceMessageModel $invoiceMessage): AbstractModel
    {
        $recipients = [];
        foreach ($invoiceMessage->recipients as $recipient) {
            $recipients[] = $recipient->toArray();
        }
        $data['recipients'] = $recipients;
        $data               = $this->addOptionalDataFromModel(static::$optionalCreateFields, $data, $invoiceMessage);
        $options            = [\GuzzleHttp\RequestOptions::JSON => $data];
        $uri                = sprintf('invoices/%s/messages', $invoiceId);
        $response           = $this->getHttpClient()->post($uri, $options);

        return $this->model(InvoiceMessageModel::class, $response);
    }

    /**
     * Delete an invoice message
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-messages/#delete-an-invoice-message
     * @param int $invoiceId
     * @param int $invoiceMessageId
     * @return \arueckauer\Harvest\Model\AbstractModel
     */
    public function delete(int $invoiceId, int $invoiceMessageId): AbstractModel
    {
        $uri      = sprintf('invoices/%s/messages/%s', $invoiceId, $invoiceMessageId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->model(InvoiceMessageModel::class, $response);
    }

    /**
     * Mark a draft invoice as sent
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-messages/#mark-a-draft-invoice-as-sent
     * @param int $invoiceId
     * @return AbstractModel
     */
    public function markDraftInvoiceAsSent(int $invoiceId): AbstractModel
    {
        return $this->updateEventType($invoiceId, self::EVENT_TYPE_SEND);
    }

    /**
     * Mark an open invoice as closed
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-messages/#mark-an-open-invoice-as-closed
     * @param int $invoiceId
     * @return AbstractModel
     */
    public function markOpenInvoiceAsClosed(int $invoiceId): AbstractModel
    {
        return $this->updateEventType($invoiceId, self::EVENT_TYPE_CLOSE);
    }

    /**
     * Re-open a closed invoice
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-messages/#re-open-a-closed-invoice
     * @param int $invoiceId
     * @return AbstractModel
     */
    public function reOpenClosedInvoice(int $invoiceId): AbstractModel
    {
        return $this->updateEventType($invoiceId, self::EVENT_TYPE_RE_OPEN);
    }

    /**
     * Mark an open invoice as a draft
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-messages/#mark-an-open-invoice-as-a-draft
     * @param int $invoiceId
     * @return AbstractModel
     */
    public function markOpenInvoiceAsDraft(int $invoiceId): AbstractModel
    {
        return $this->updateEventType($invoiceId, self::EVENT_TYPE_DRAFT);
    }

    private function updateEventType(int $invoiceId, string $eventType): AbstractModel
    {
        $options  = ['event_type' => $eventType];
        $uri      = sprintf('invoices/%s/messages', $invoiceId);
        $response = $this->getHttpClient()->post($uri, $options);

        return $this->model(InvoiceMessageModel::class, $response);
    }
}

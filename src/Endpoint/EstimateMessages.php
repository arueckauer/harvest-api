<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\DataObject\Collection\AbstractCollection;
use arueckauer\HarvestApi\DataObject\Collection\EstimateMessage as EstimateMessageCollection;
use arueckauer\HarvestApi\DataObject\EstimateMessage as EstimateMessageDataObject;

class EstimateMessages extends AbstractEndpoint
{
    private const EVENT_TYPE_SEND = 'send';

    private const EVENT_TYPE_ACCEPT = 'accept';

    private const EVENT_TYPE_DECLINE = 'decline';

    private const EVENT_TYPE_RE_OPEN = 're-open';

    private static $requiredCreateFields = [
        'recipients' => '',
    ];

    private static $optionalCreateFields = [
        'subject'        => 'subject',
        'body'           => 'body',
        'send_me_a_copy' => 'sendMeACopy',
        'event_type'     => 'eventType',
    ];

    /**
     * List all messages for an estimate
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-messages/#list-all-messages-for-an-estimate
     * @param int $estimateId
     * @param array $options
     * @return AbstractCollection
     */
    public function all(int $estimateId, array $options = []): AbstractCollection
    {
        $uri      = sprintf('estimates/%s/messages', $estimateId);
        $response = $this->getHttpClient()->get($uri, [\GuzzleHttp\RequestOptions::QUERY => $options]);
        return $this->getCollectionFromResponse(EstimateMessageCollection::class, $response);
    }

    /**
     * Create an estimate message
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-messages/#create-an-estimate-message
     * @param int $estimateId
     * @param EstimateMessageDataObject $estimateMessage
     * @return AbstractDataObject
     */
    public function create(int $estimateId, EstimateMessageDataObject $estimateMessage): AbstractDataObject
    {
        $recipients = [];
        foreach ($estimateMessage->recipients as $recipient) {
            $recipients[] = $recipient->toArray();
        }
        $data['recipients'] = $recipients;
        $data               = $this->addOptionalDataFromDataObject(
            static::$optionalCreateFields,
            $data,
            $estimateMessage
        );
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $uri      = sprintf('estimates/%s/messages', $estimateId);
        $response = $this->getHttpClient()->post($uri, $options);

        return $this->getDataObjectFromResponse(EstimateMessageDataObject::class, $response);
    }

    /**
     * Delete an estimate message
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-messages/#delete-an-estimate-message
     * @param int $estimateId
     * @param int $estimateMessageId
     * @return AbstractDataObject
     */
    public function delete(int $estimateId, int $estimateMessageId): AbstractDataObject
    {
        $uri      = sprintf('estimates/%s/messages/%s', $estimateId, $estimateMessageId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->getDataObjectFromResponse(EstimateMessageDataObject::class, $response);
    }

    /**
     * Mark a draft estimate as sent
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-messages/#mark-a-draft-estimate-as-sent
     * @param int $estimateId
     * @return AbstractDataObject
     */
    public function markDraftEstimateAsSent(int $estimateId): AbstractDataObject
    {
        return $this->updateEventType($estimateId, self::EVENT_TYPE_SEND);
    }

    /**
     * Mark an open estimate as accepted<
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-messages/#mark-an-open-estimate-as-accepted
     * @param int $estimateId
     * @return AbstractDataObject
     */
    public function markOpenEstimateAsAccepted(int $estimateId): AbstractDataObject
    {
        return $this->updateEventType($estimateId, self::EVENT_TYPE_ACCEPT);
    }

    /**
     * Mark an open estimate as declined
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-messages/#mark-an-open-estimate-as-declined
     * @param int $estimateId
     * @return AbstractDataObject
     */
    public function markOpenEstimateAsDeclined(int $estimateId): AbstractDataObject
    {
        return $this->updateEventType($estimateId, self::EVENT_TYPE_DECLINE);
    }

    /**
     * Re-open a closed estimate
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-messages/#re-open-a-closed-estimate
     * @param int $estimateId
     * @return AbstractDataObject
     */
    public function reOpenClosedEstimate(int $estimateId): AbstractDataObject
    {
        return $this->updateEventType($estimateId, self::EVENT_TYPE_RE_OPEN);
    }

    private function updateEventType(int $estimateId, string $eventType): AbstractDataObject
    {
        $options  = ['event_type' => $eventType];
        $uri      = sprintf('estimates/%s/messages', $estimateId);
        $response = $this->getHttpClient()->post($uri, $options);

        return $this->getDataObjectFromResponse(EstimateMessageDataObject::class, $response);
    }
}

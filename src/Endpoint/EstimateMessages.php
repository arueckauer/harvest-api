<?php

namespace arueckauer\Harvest\Endpoint;

use arueckauer\Harvest\Collection\AbstractCollection;
use arueckauer\Harvest\Collection\EstimateMessage as EstimateMessageCollection;
use arueckauer\Harvest\Model\AbstractModel;
use arueckauer\Harvest\Model\EstimateMessage as EstimateMessageModel;

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
        $response = $this->getHttpClient()->get($uri, $options);
        return $this->collection(EstimateMessageCollection::class, $response);
    }

    /**
     * Create an estimate message
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-messages/#create-an-estimate-message
     * @param int $estimateId
     * @param EstimateMessageModel $estimateMessage
     * @return AbstractModel
     */
    public function create(int $estimateId, EstimateMessageModel $estimateMessage): AbstractModel
    {
        $recipients = [];
        foreach ($estimateMessage->recipients as $recipient) {
            $recipients[] = $recipient->toArray();
        }
        $data['recipients'] = $recipients;
        $data               = $this->addOptionalDataFromModel(static::$optionalCreateFields, $data, $estimateMessage);
        $options            = [\GuzzleHttp\RequestOptions::JSON => $data];
        $uri                = sprintf('estimates/%s/messages', $estimateId);
        $response           = $this->getHttpClient()->post($uri, $options);

        return $this->model(EstimateMessageModel::class, $response);
    }

    /**
     * Delete an estimate message
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-messages/#delete-an-estimate-message
     * @param int $estimateId
     * @param int $estimateMessageId
     * @return AbstractModel
     */
    public function delete(int $estimateId, int $estimateMessageId): AbstractModel
    {
        $uri      = sprintf('estimates/%s/messages/%s', $estimateId, $estimateMessageId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->model(EstimateMessageModel::class, $response);
    }

    /**
     * Mark a draft estimate as sent
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-messages/#mark-a-draft-estimate-as-sent
     * @param int $estimateId
     * @return AbstractModel
     */
    public function markDraftEstimateAsSent(int $estimateId): AbstractModel
    {
        return $this->updateEventType($estimateId, self::EVENT_TYPE_SEND);
    }

    /**
     * Mark an open estimate as accepted<
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-messages/#mark-an-open-estimate-as-accepted
     * @param int $estimateId
     * @return AbstractModel
     */
    public function markOpenEstimateAsAccepted(int $estimateId): AbstractModel
    {
        return $this->updateEventType($estimateId, self::EVENT_TYPE_ACCEPT);
    }

    /**
     * Mark an open estimate as declined
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-messages/#mark-an-open-estimate-as-declined
     * @param int $estimateId
     * @return AbstractModel
     */
    public function markOpenEstimateAsDeclined(int $estimateId): AbstractModel
    {
        return $this->updateEventType($estimateId, self::EVENT_TYPE_DECLINE);
    }

    /**
     * Re-open a closed estimate
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-messages/#re-open-a-closed-estimate
     * @param int $estimateId
     * @return AbstractModel
     */
    public function reOpenClosedEstimate(int $estimateId): AbstractModel
    {
        return $this->updateEventType($estimateId, self::EVENT_TYPE_RE_OPEN);
    }

    private function updateEventType(int $estimateId, string $eventType): AbstractModel
    {
        $options  = ['event_type' => $eventType];
        $uri      = sprintf('estimates/%s/messages', $estimateId);
        $response = $this->getHttpClient()->post($uri, $options);

        return $this->model(EstimateMessageModel::class, $response);
    }
}

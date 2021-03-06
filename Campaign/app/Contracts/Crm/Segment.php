<?php

namespace App\Contracts\Crm;

use App\CampaignSegment;
use App\Contracts\SegmentContract;
use App\Contracts\SegmentException;
use App\Jobs\CacheSegmentJob;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Collection;

class Segment implements SegmentContract
{
    const PROVIDER_ALIAS = 'crm_segment';

    const ENDPOINT_LIST = 'user-segments/list';

    const ENDPOINT_CHECK = 'user-segments/check';

    const ENDPOINT_USERS = 'user-segments/users';

    private $client;

    private $providerData;

    private $redis;

    public function __construct(Client $client, \Predis\Client $redis)
    {
        $this->client = $client;
        $this->providerData = new \stdClass;
        $this->redis = $redis;
    }

    public function provider(): string
    {
        return static::PROVIDER_ALIAS;
    }

    /**
     * @return Collection
     * @throws SegmentException
     */
    public function list(): Collection
    {
        try {
            $response = $this->client->get(self::ENDPOINT_LIST);
        } catch (ConnectException $e) {
            throw new SegmentException("Could not connect to Segment:List endpoint: {$e->getMessage()}");
        }

        $list = json_decode($response->getBody());
        $campaignSegments = [];
        foreach ($list->segments as $item) {
            $cs = new CampaignSegment();
            $cs->name = $item->name;
            $cs->provider = self::PROVIDER_ALIAS;
            $cs->code = $item->code;
            $cs->group = $item->group;
            $campaignSegments[] = $cs;
        }
        $collection = collect($campaignSegments);
        return $collection;
    }

    /**
     * @param CampaignSegment $campaignSegment
     * @param string $userId
     * @return bool
     */
    public function checkUser(CampaignSegment $campaignSegment, string $userId): bool
    {
        $cacheJob = new CacheSegmentJob($campaignSegment);
        return $this->redis->sismember($cacheJob->key(), $userId);
    }

    /**
     * @param CampaignSegment $campaignSegment
     * @param string $browserId
     * @return bool
     */
    public function checkBrowser(CampaignSegment $campaignSegment, string $browserId): bool
    {
        // CRM segments don't support browser tracking
        return false;
    }

    /**
     * @param CampaignSegment $campaignSegment
     * @return Collection
     * @throws SegmentException
     */
    public function users(CampaignSegment $campaignSegment): Collection
    {
        try {
            $response = $this->client->get(self::ENDPOINT_USERS, [
                'query' => [
                    'code' => $campaignSegment->code,
                ],
            ]);
        } catch (ConnectException $e) {
            throw new SegmentException("Could not connect to Segment:Check endpoint: {$e->getMessage()}");
        }

        $list = json_decode($response->getBody());
        $collection = collect($list->users);
        return $collection;
    }

    public function cacheEnabled(CampaignSegment $campaignSegment): bool
    {
        return true;
    }

    public function setProviderData($providerData): void
    {
        $this->providerData = $providerData;
    }

    public function getProviderData()
    {
        return $this->providerData;
    }
}

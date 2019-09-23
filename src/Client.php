<?php
namespace Labizon;

use Mobizon\MobizonApi;

class Client implements MobizonClient
{
    /**
     * Native client
     *
     * @var \Mobizon\MobizonApi
     */
    protected $api;

    /**
     * Client constructor.
     *
     * @param string $key
     * @param string|null $domain
     *
     * @throws \Mobizon\Mobizon_ApiKey_Required
     * @throws \Mobizon\Mobizon_Curl_Required
     * @throws \Mobizon\Mobizon_Error
     * @throws \Mobizon\Mobizon_OpenSSL_Required
     */
    public function __construct(string $key, string $domain = null)
    {
        $this->api = new MobizonApi(['apiKey' => $key, 'apiServer' => $domain]);
    }

    /**
     * @inheritdoc
     *
     * @param MobizonMessage $message
     * @return mixed
     * @throws \Mobizon\Mobizon_Http_Error
     * @throws \Mobizon\Mobizon_Param_Required
     */
    public function send(MobizonMessage $message)
    {
        return $this->api->call('message', 'sendSMSMessage', $message->toArray());
    }

    /**
     * @inheritdoc
     *
     * @return int
     */
    public function code(): int
    {
        return $this->api->getCode();
    }

    /**
     * @inheritdoc
     *
     * @return array
     */
    public function data(): array
    {
        return $this->api->hasData() ? (array) $this->api->getData() : [];
    }

    /**
     * @inheritdoc
     *
     * @return string
     */
    public function message(): string
    {
        return $this->api->getMessage();
    }

    /**
     * Get response context
     *
     * @return array
     */
    public function context(): array
    {
        return [
            'code' => $this->code(),
            'data' => $this->data(),
            'message' => $this->message(),
        ];
    }
}
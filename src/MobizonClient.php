<?php
namespace Labizon;

interface MobizonClient
{
    /**
     * MobizonClient constructor.
     *
     * @param string $key
     * @param string|null $domain
     */
    public function __construct(string $key, string $domain = null);

    /**
     * Send message
     *
     * @param MobizonMessage $message
     * @return mixed
     */
    public function send(MobizonMessage $message);

    /**
     * Get api response code
     *
     * @return int
     */
    public function code(): int;

    /**
     * Get api response data
     *
     * @return array
     */
    public function data(): array;

    /**
     * Get api response string
     *
     * @return string
     */
    public function message(): string;
}
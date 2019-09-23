<?php
namespace Labizon;

class MobizonMessage
{
    /**
     * Message
     *
     * @var array
     */
    protected $message = [];

    /**
     * Phone number
     *
     * @var string
     */
    protected $recipient;

    /**
     * Message from
     *
     * @var string
     */
    protected $from;

    /**
     * Line of text
     *
     * @param string $line
     * @return $this
     */
    public function line(string $line)
    {
        $this->message[] = $line;
        $this->message[] = "\n";

        return $this;
    }

    public function from(string $from)
    {
        $this->from = $from;
    }

    /**
     * Determine if has recipient
     *
     * @return bool
     */
    public function hasRecipient(): bool
    {
        return !is_null($this->recipient);
    }

    /**
     * Set recipient
     *
     * @param string $phone
     * @return $this
     */
    public function to(string $phone)
    {
        // Todo: Phone validation
        $this->recipient = $phone;

        return $this;
    }

    /**
     * Object to array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'from' => $this->from,
            'recipient' => $this->recipient,
            'text' => implode('', $this->message),
        ];
    }
}
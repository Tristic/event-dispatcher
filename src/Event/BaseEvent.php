<?php

namespace App\Event;

use DateTimeInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BaseEvent extends Event
{

    private $id;
    private $version;
    private $time;
    private $type;

    private $subject;
    private $traceparent;
    private $tracestate;

    private $source;

    private $body;

    public const NAME = 'base.event';

    public function __construct($body, $type, $subject, $traceparent = NULL, $tracestate = NULL, $source = NULL)
    {
        $this->id = uniqid();
        $this->version = 0.1;
        $this->type = $type;
        $this->time = DateTimeInterface::COOKIE;
        $this->subject = $subject;
        $this->traceparent = $traceparent;
        $this->tracestate = $tracestate;

        $this->source = $source;

        $this->body = base64_encode(json_encode($body));
    }

    public function __serialize(): array
    {
        $vars = get_object_vars($this);
        return json_encode($vars);
    }

    public function getName()
    {
        return $this::NAME;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

}

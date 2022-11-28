<?php

namespace App\Models\Transactions;

use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

class Result implements Jsonable, JsonSerializable
{
    const STATUS_UNKNOW = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_WARNING = 2;
    const STATUS_ERROR = 3;
    const STATUS_NOT_FOUND = 4;
    const STATUS_TEXT = [
        self::STATUS_UNKNOW => 'unknow',
        self::STATUS_SUCCESS => 'success',
        self::STATUS_WARNING => 'warning',
        self::STATUS_ERROR => 'error',
        self::STATUS_NOT_FOUND => 'not found',
    ];

    protected $status = self::STATUS_UNKNOW;
    protected $message = null;
    protected $data = null;

    public function __construct(int $status = self::STATUS_UNKNOW, ?string $message = null, $data = null)
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }

    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize());
    }

    public function jsonSerialize(): array
    {
        return [
            'status' => $this->status,
            'status_text' => $this->getStatusText(),
            'message' => $this->message,
            'data' => $this->data,
            'is_success' => $this->isSuccess(),
            'is_warning' => $this->isWarning(),
            'is_error' => $this->isError(),
        ];
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatusText(): string
    {
        return self::STATUS_TEXT[$this->status] ?? self::STATUS_TEXT[self::STATUS_UNKNOW];
    }

    public function isSuccess(): bool
    {
        return $this->status == self::STATUS_SUCCESS;
    }

    public function isWarning(): bool
    {
        return $this->status == self::STATUS_WARNING
            || $this->status == self::STATUS_UNKNOW
            || $this->status == self::STATUS_NOT_FOUND;
    }

    public function isError(): bool
    {
        return $this->status == self::STATUS_ERROR;
    }

    /**
     * Get the value of message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}

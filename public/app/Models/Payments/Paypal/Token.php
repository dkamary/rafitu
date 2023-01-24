<?php

namespace App\Models\Payments\Paypal;

class Token {
    protected $scope;
    protected $access_token;
    protected $token_type;
    protected $app_id;
    protected $expires_in;
    protected $nonce;

    public function __construct(array $data = [])
    {
        $this->scope = $data['scope'] ?? null;
        $this->access_token = $data['access_token'] ?? null;
        $this->token_type = $data['token_type'] ?? null;
        $this->app_id = $data['app_id'] ?? null;
        $this->expires_in = $data['expires_in'] ?? null;
        $this->nonce = $data['nonce'] ?? null;
    }

    /**
     * Get the value of scope
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Get the value of access_token
     */
    public function getAccess_token()
    {
        return $this->access_token;
    }

    /**
     * Get the value of token_type
     */
    public function getToken_type()
    {
        return $this->token_type;
    }

    /**
     * Get the value of app_id
     */
    public function getApp_id()
    {
        return $this->app_id;
    }

    /**
     * Get the value of expires_in
     */
    public function getExpires_in()
    {
        return $this->expires_in;
    }

    /**
     * Get the value of nonce
     */
    public function getNonce()
    {
        return $this->nonce;
    }
}

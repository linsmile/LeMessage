<?php
namespace LeMessage;
use LeMessage\Http;

class IM {

    private $client;

    const API_DOMAIN = 'http://api.upush.aoidc.net';
    //const API_DOMAIN = 'http://pushapi1.lemajestic.com';

    public function __construct($client) {
        $this->client = Http::getInstance($client);
    }

    public function get($uri, array $query = []) {
        return $this->client->get($uri, $query);
    }

    public function post($uri, array $body = []) {
        return $this->client->post($uri, $body);
    }

    public function put($uri, array $body = []) {
        return $this->client->put($uri, $body);
    }

    public function del($uri, array $body = []) {
        return $this->client->delete($uri, $body);
    }

    protected function getClient() {
        return $this->client;
    }
}

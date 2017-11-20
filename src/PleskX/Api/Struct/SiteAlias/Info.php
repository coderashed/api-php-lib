<?php
// Copyright 1999-2016. Parallels IP Holdings GmbH.

namespace PleskX\Api\Struct\SiteAlias;

class Info extends \PleskX\Api\Struct implements \Iterator
{

    public $site_id;

    private $array = array();

    private $position = 0;

    public function __construct($apiResponse)
    {
        $json = json_encode($apiResponse);
        $responses = json_decode($json);

        $this->site_id = $responses[0]->id;

        foreach($responses as $response) {
            $this->array[] = array(
                'site-name' => $response->info->name,
                'ascii-name' => $response->info->{'ascii-name'}
                );
        }
    }

    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->array[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->array[$this->position]);
    }
}
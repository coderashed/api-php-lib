<?php
// Copyright 1999-2016. Parallels IP Holdings GmbH.

namespace PleskX\Api\Operator;

use PleskX\Api\Struct\SiteAlias as Struct;

class SiteAlias extends \PleskX\Api\Operator
{


    /**
     * @param array $properties
     * @param array $preferences
     * @return Struct\Info
     */
    public function create(array $properties, array $preferences = [])
    {
        $packet = $this->_client->getPacket();
        $info = $packet->addChild($this->_wrapperTag)->addChild('create');

        if (count($preferences) > 0) {
            $prefs = $info->addChild('pref');

            foreach ($preferences as $key => $value) {
                $prefs->addChild($key, is_bool($value) ? ($value ? 1 : 0) : $value);
            }
        }

        foreach($properties as $key => $val)
        {
            $info->addChild($key,$val);
        }

        $response = $this->_client->request($packet);
        return new Struct\Info($response);
    }

    public function get($site_id)
    {
        $packet = $this->_client->getPacket();

        $get = $packet->addChild($this->_wrapperTag)->addChild('get');

        $filter = $get->addChild('filter');
        $filter->addChild('site-id',$site_id);
        $response = $this->_client->request($packet);

        return new Struct\Info($response);
        //$packet->saveXML('/var/www/vagrant/ataama_development/application/logs/ataama/development/portal/xml');
        return $response;
    }

}

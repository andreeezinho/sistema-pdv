<?php

namespace App\Services\Xml;

class XmlService {

    public function generateXml($file){
        $xml = simplexml_load_file($file['tmp_name']);

        return $this->convertXml($xml);
    }

    private function convertXml($xml){
        $result = [];

        foreach ($xml as $key => $value) {
            $result[$key] = $value;

            if ($value->count() > 0) {
                $result[$key] = $this->convertXml($value);
            }
        }

        return $result;
    }

}
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
            $convertedValue = ($value->count() > 0) ? $this->convertXml($value) : (string) $value;

            if (!isset($result[$key])) {
                $result[$key] = $convertedValue;
                continue;
            }

            if (!is_array($result[$key]) || !array_is_list($result[$key])) {
                $result[$key] = [$result[$key]];
            }

            $result[$key][] = $convertedValue;
        }

        foreach ($xml->attributes() as $attrKey => $attrValue) {
            $result['@attributes'][$attrKey] = (string) $attrValue;
        }

        return $result;
    }

}
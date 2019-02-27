<?php

namespace App\Services;

use JMS\Serializer\SerializerBuilder;

class SerializerService
{
    /**
     * @param array $data
     * @param string $format
     * @return string
     */
    public function serialize(array $data, string $format = 'json'): string
    {
        $serializer = SerializerBuilder::create()->build();
        return $serializer->serialize($data, $format);
    }

    /**
     * @param string $data
     * @param string $type
     * @param string $format
     * @return string
     */
    public function deserialize(string $data, string $type = '', string $format = 'json'): string
    {
        $serializer = SerializerBuilder::create()->build();
        return $serializer->deserialize($data, $type, $format);
    }
}
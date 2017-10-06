<?php
/**
 * Fetching information from either key and value in the URL.
 * User: eboch
 * Date: 9/10/2017
 * Time: 3:35 PM
 */

namespace skillup\Core;


class FilteredMap
{
    private $map;

    public function __construct(array $baseMap) {
        $this->map = $baseMap;
    }

    public function has(string $name): bool {
        return isset($this->map[$name]);
    }

    public function get(string $name) {
        return $this->map[$name] ?? null;
    }

    public function getInt(string $name) {
        return (int) $this->get($name);
    }

    public function getNumber(string $name) {
        return (float) $this->get($name);
    }

    public function getString(string $name, bool $filter = true) {
        $value = (string) $this->get($name);
        return $filter ? addslashes($value): $value;
    }
}
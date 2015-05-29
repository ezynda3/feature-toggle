<?php namespace Ezynda3\FeatureToggle;

use Dotenv;

class Manager
{
    protected $feature = null;

    protected $enabled;

    public function __construct($rootDir = __DIR__)
    {
        if (file_exists("{$rootDir}/.env")) {
            Dotenv::load($rootDir);
        }
    }

    public function feature($name)
    {
        $name = strtoupper($name);
        $this->feature = $name;
        $this->enabled = (getenv("FEATURE_{$name}") === 'true') ? true : false;

        return $this;
    }

    public function isEnabled()
    {
        if (is_null($this->feature)) {
            throw new \BadMethodCallException('Feature name has not been set.');
        }

        return $this->enabled;
    }
}

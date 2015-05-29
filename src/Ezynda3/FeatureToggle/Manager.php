<?php namespace Ezynda3\FeatureToggle;

use Dotenv;

class Manager
{
    /**
     * @var null
     */
    protected $feature = null;

    /**
     * @var
     */
    protected $enabled;

    /**
     * Constructor
     * @param string $rootDir
     */
    public function __construct($rootDir = __DIR__)
    {
        if (file_exists("{$rootDir}/.env")) {
            Dotenv::load($rootDir);
        }
    }

    /**
     * Select a feature
     * @param $name
     * @return $this
     */
    public function feature($name)
    {
        $name = strtoupper($name);
        $this->feature = $name;
        $this->enabled = (getenv("FEATURE_{$name}") === 'true') ? true : false;

        return $this;
    }

    /**
     * Check that the feature is enabled
     * @return boolean
     */
    public function isEnabled()
    {
        if (is_null($this->feature)) {
            throw new \BadMethodCallException('Feature name has not been set.');
        }

        return $this->enabled;
    }
}

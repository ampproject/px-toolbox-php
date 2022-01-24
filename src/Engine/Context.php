<?php

namespace PageExperience\Engine;

use PageExperience\Engine\Exception\InvalidContextKey;

/**
 * Context of an analysis or optimization.
 *
 * This is used for storing intermediate state, like cross-tool communication or caching.
 *
 * @package ampproject/px-toolbox
 */
final class Context
{
    /**
     * Internal key-value store.
     *
     * @var array<mixed> Array of key-value pairs.
     */
    private $keyValueStore = [];

    /**
     * Replace the context internals with the internals of the provided Context object.
     *
     * @param Context $context Context object to use as new context internals.
     * @return void
     */
    public function replaceWith(Context $context)
    {
        // TODO: replace internals with the internals of the provided context.
    }

    /**
     * Add a value to the context.
     *
     * @param string $key   Key under which to add a value.
     * @param mixed  $value Value to add.
     * @return void
     */
    public function add($key, $value)
    {
        $this->keyValueStore[$key] = $value;
    }

    /**
     * Get a value from the context.
     *
     * @param string $key Key for which to retrieve the value.
     * @return mixed Value stored under the key.
     * @throws InvalidContextKey If the key is not known.
     */
    public function get($key)
    {
        if (! array_key_exists($key, $this->keyValueStore)) {
            throw InvalidContextKey::forContextKey($key);
        }

        return $this->keyValueStore[$key];
    }

    /**
     * Check if the context contains a value for a given key.
     *
     * @param string $key Key for which to check for a value.
     * @return bool Whether the context knows the provided key.
     */
    public function has($key)
    {
        return array_key_exists($key, $this->keyValueStore);
    }
}

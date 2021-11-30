<?php

namespace PageExperience\Engine\Exception;

use RuntimeException;

/**
 * Exception thrown when the tool stack configuration could not be validated.
 *
 * @package ampproject/px-toolbox
 */
final class InvalidToolStackConfiguration extends RuntimeException implements PxEngineException
{
}

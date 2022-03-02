<?php

namespace PageExperience\Engine\Dsl;

/**
 * Internal stack of the domain-specific language interpreter.
 *
 * @package ampproject/px-toolbox
 */
final class Stack
{
    /**
     * Input data of the current stack.
     *
     * @var array<string, mixed>
     */
    private $input = [];

    /**
     * Output data of the current stack.
     *
     * @var array<string, mixed>
     */
    private $output = [];

    /**
     * Get the input.
     *
     * @return array<string, mixed> Input data.
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Set the input.
     *
     * @param array<string, mixed> $data Data to set the input to.
     * @return void
     */
    public function setInput(array $data)
    {
        $this->input = $data;
    }

    /**
     * Add to the input.
     *
     * @param array<string, mixed> $data Data to add to the input.
     * @return void
     */
    public function addToInput(array $data)
    {
        $this->input = array_merge($this->input, $data);
    }


    /**
     * Get the output.
     *
     * @return array<string, mixed> Output data.
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Set the output.
     *
     * @param array<string, mixed> $data Data to set the output to.
     * @return void
     */
    public function setOutput(array $data)
    {
        $this->output = $data;
    }

    /**
     * Add to the output.
     *
     * @param array<string, mixed> $data Data to add to the output.
     * @return void
     */
    public function addToOutput(array $data)
    {
        $this->output = array_merge($this->output, $data);
    }
}

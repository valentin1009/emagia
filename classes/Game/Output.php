<?php

namespace Game;

class Output{
    public $stack = [];

    /**
     * @param array $stack
     */
    public function addMsg(string $msg): void
    {
        $this->stack[] = $msg;
    }

    public function displayAll() : void
    {
        if (!empty($this->stack)) {
            foreach ($this->stack as $item)
            {
                echo $item . PHP_EOL;
            }
        }
    }
}
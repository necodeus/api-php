<?php

abstract class BaseCommand
{
    protected $name;

    protected $description;

    abstract public function handle($arguments);

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
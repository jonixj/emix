<?php namespace Emix\Commands;


interface ICommand
{
    public static function getName();

    public static function getDescription();

    public function execute();
} 
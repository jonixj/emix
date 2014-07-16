<?php namespace Emix\Commands;


interface ICommand
{
    public static function getName();

    public static function getDescription();

    public function getType();

    public function execute();

    public function getNodeScript();

    public function getContainerScript();

    public static function getMeasure();

} 
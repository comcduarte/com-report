<?php
namespace Report;

class Module
{
    const TITLE = "Report Module";
    const VERSION = "v1.0.4";
    
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
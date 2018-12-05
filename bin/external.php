<?php
/**
 * Created by PhpStorm.
 * User: yuliusardian
 * Date: 12/3/18
 * Time: 2:32 PM
 */

include __DIR__ . "/../vendor/autoload.php";
\Pimcore\Bootstrap::setProjectRoot();

define('PIMCORE_CONSOLE', true);

/** @var \Pimcore\Kernel $kernel */
$kernel = \Pimcore\Bootstrap::startupCli();

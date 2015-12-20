<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 20.12.15
 * Time: 09:17
 */

use Magento\Framework\Component\ComponentRegistrar;

$name = implode('_', array_map(function ($part) {
    return implode(array_map('ucfirst', explode('-', $part)));
}, array_slice(explode(DIRECTORY_SEPARATOR, __DIR__), -2, 2)));
ComponentRegistrar::register(ComponentRegistrar::MODULE, $name, __DIR__);
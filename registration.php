<?php
/**
 * @copyright Roman Hutterer CopeX Gmbh
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

use Magento\Framework\Component\ComponentRegistrar;

$name = implode('_', array_map(function ($part) {
    return implode(array_map('ucfirst', explode('-', $part)));
}, array_slice(explode(DIRECTORY_SEPARATOR, __DIR__), -2, 2)));
ComponentRegistrar::register(ComponentRegistrar::MODULE, $name, __DIR__);
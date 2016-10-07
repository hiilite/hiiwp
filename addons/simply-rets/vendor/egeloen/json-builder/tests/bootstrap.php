<?php

/*
 * This file is part of the Ivory Jsn Builder package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

// Autoloads library.
$loader = require __DIR__.'/../vendor/autoload.php';

// Autoloads tests.
$loader->addPsr4('Ivory\\Tests\\JsonBuilder\\', __DIR__);

<?php declare(strict_types=1);
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoAdmin\Service
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoAdmin\Service;

use Zend\Navigation\Service\AbstractNavigationFactory;

/**
 * Class AdminNavigationFactory
 *
 * @package UthandoAdmin\Service
 */
class AdminNavigationFactory extends AbstractNavigationFactory
{
    protected function getName(): string
    {
        return 'admin';
    }
}

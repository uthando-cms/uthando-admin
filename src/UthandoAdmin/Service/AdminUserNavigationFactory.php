<?php declare(strict_types=1);
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 24/11/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoAdmin\Service;


use Zend\Navigation\Service\AbstractNavigationFactory;

class AdminUserNavigationFactory extends AbstractNavigationFactory
{
    protected function getName(): string
    {
        return 'admin-user';
    }
}

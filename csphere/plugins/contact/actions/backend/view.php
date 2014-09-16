<?php

/**
 * View action
 *
 * PHP Version 5
 *
 * @category  Plugins
 * @package   Contact
 * @author    Mathias Milus <contact@csphere.eu>
 * @copyright 2013 cSphere Team
 * @license   http://opensource.org/licenses/bsd-license Simplified BSD License
 * @link      http://www.csphere.eu
 **/

// Contact ID
$id = \csphere\core\http\Input::get('get', 'id');

// Add breadcrumb navigation
$bread = new \csphere\core\template\Breadcrumb('admin');
$bread->add('content');
$bread->plugin('contact', 'manage');
$bread->add('view', 'contact/view/id/' . $id);
$bread->trace();

 // Get RAD class for this action
$rad = new \csphere\core\rad\View('contact');

// Delegate action
$rad->delegate();

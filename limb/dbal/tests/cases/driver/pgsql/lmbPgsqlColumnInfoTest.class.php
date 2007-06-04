<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbPgsqlColumnInfoTest.class.php 5933 2007-06-04 13:06:23Z pachanga $
 * @package    $package$
 */
require_once(dirname(__FILE__) . '/../DriverColumnInfoTestBase.class.php');
require_once(dirname(__FILE__) . '/fixture.inc.php');

class lmbPgsqlColumnInfoTest extends DriverColumnInfoTestBase
{
  function setUp()
  {
    $this->connection = lmbToolkit :: instance()->getDefaultDbConnection();
    DriverPgsqlSetup($this->connection->getConnectionId());
    parent::setUp();
  }
}

?>

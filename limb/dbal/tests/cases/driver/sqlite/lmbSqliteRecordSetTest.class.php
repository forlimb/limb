<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id$
 * @package    $package$
 */

require_once(dirname(__FILE__) . '/../DriverRecordSetTestBase.class.php');
require_once(dirname(__FILE__) . '/fixture.inc.php');

class lmbSqliteRecordSetTest extends DriverRecordSetTestBase
{
  function lmbSqliteRecordSetTest()
  {
    parent :: DriverRecordSetTestBase('lmbSqliteRecord');
  }

  function setUp()
  {
    $this->connection = lmbToolkit :: instance()->getDefaultDbConnection();
    DriverSqliteSetup($this->connection->getConnectionId());
    parent::setUp();
  }
}

?>

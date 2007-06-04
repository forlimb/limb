<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: DriverTypeInfoTestBase.class.php 5933 2007-06-04 13:06:23Z pachanga $
 * @package    $package$
 */

abstract class DriverTypeInfoTestBase extends UnitTestCase
{
  var $typeInfo;
  var $columnList;
  var $queryStmtClass;
  var $recordClass;

  function DriverTypeInfoTestBase($queryStmtClass, $recordClass)
  {
    $this->queryStmtClass = $queryStmtClass;
    $this->recordClass = $recordClass;
  }

  function setUp()
  {
    $this->columnList = $this->typeInfo->getColumnTypeList();
  }

  function testGetColumnTypeAccessors()
  {
    $mapping = $this->typeInfo->getColumnTypeAccessors();
    foreach($this->columnList as $columnType)
    {
      $this->assertTrue(isset($mapping[$columnType]));
    }
    foreach($mapping as $col => $name)
    {
      $this->assertTrue(in_array($col, $this->columnList));
      $this->assertTrue(is_callable(array($this->queryStmtClass, $name)), "'$name' is not callable in {$this->queryStmtClass}");
    }
  }

  function testGetColumnTypeGetters()
  {
    $mapping = $this->typeInfo->getColumnTypeGetters();
    foreach($this->columnList as $columnType)
    {
      $this->assertTrue(isset($mapping[$columnType]));
    }
    foreach($mapping as $prop => $name)
    {
      $this->assertTrue(in_array($prop, $this->columnList));
      $this->assertTrue(is_callable(array($this->recordClass, $name)), "'$name' is not callable in {$this->recordClass}");
    }
  }
}

?>
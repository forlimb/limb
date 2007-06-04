<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbDbTableInfo.class.php 5933 2007-06-04 13:06:23Z pachanga $
 * @package    $package$
 */
lmb_require('limb/dbal/src/exception/lmbDbException.class.php');

abstract class lmbDbTableInfo
{
  protected $name;
  protected $columns = array();
  protected $canonicalHandler;
  protected $cached_columns = array();

  function __construct($name, $canonicalHandler = null)
  {
    $this->name = $this->canonicalizeIdentifier($name);

    if($canonicalHandler !== null &&
       $canonicalHandler != 'strtolower' &&
       $canonicalHandler != 'strtoupper')
    {
      throw new lmbDbException("Invalid identifier compatability function '$canonicalHandler'");
    }
    $this->canonicalHandler = $canonicalHandler;
  }

  function canonicalizeIdentifier($id)
  {
    if(!is_null($this->canonicalHandler))
      return $this->canonicalHandler($id);

    return $id;
  }

  function getCanonicalColumnName($name)
  {
    $name = $this->canonicalizeIdentifier($name);
    // quick check if they happen to use the same case.
    if(array_key_exists($name, $this->columns))
      return $name;

    // slow check
    foreach(array_keys($this->columns) as $key)
    {
      if(strcasecmp($name, $key) == 0)
        return $key;
    }
    return $name;
  }

  function getName()
  {
    return $this->name;
  }

  abstract function loadColumns();

  function hasColumn($name)
  {
    $old_name = $name;
    if(isset($this->cached_columns[$old_name]))
      return true;

    $this->loadColumns();
    $name = $this->getCanonicalColumnName($name);
    if(array_key_exists($name, $this->columns))
    {
      $this->cached_columns[$old_name] = $this->columns[$name];
      return true;
    }
    else
      return false;
  }

  function getColumn($name)
  {
    $old_name = $name;
    if(isset($this->cached_columns[$old_name]))
      return $this->cached_columns[$old_name];

    $this->loadColumns();
    $name = $this->getCanonicalColumnName($name);
    if(!array_key_exists($name, $this->columns))
    {
      throw new lmbDbException("Column '$name' does not exist");
    }

    $this->cached_columns[$old_name] = $this->columns[$name];
    return $this->cached_columns[$old_name];
  }

  function getColumnList()
  {
    $this->loadColumns();
    $result = array();
    foreach(array_keys($this->columns) as $name)
      $result[$name] = $name;
    return $result;
  }
}

?>

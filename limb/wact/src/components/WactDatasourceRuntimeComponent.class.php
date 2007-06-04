<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: WactDatasourceRuntimeComponent.class.php 5933 2007-06-04 13:06:23Z pachanga $
 * @package    $package$
 */

/**
* Base class for runtime components that hold data
*/
class WactDatasourceRuntimeComponent extends WactRuntimeComponent implements ArrayAccess
{
  protected $datasource;

  function __construct($id)
  {
    parent :: __construct($id);

    $this->datasource = new WactArrayObject(new ArrayObject());
  }

  function set($field, $value)
  {
    $this->datasource->set($field, $value);
  }

  function get($field)
  {
    return $this->datasource->get($field);
  }

  function getDatasourceComponent()
  {
    return $this;
  }

  function registerDataSource($datasource)
  {
    $this->datasource = new WactArrayObject($datasource);
  }

  function getDataSource()
  {
    return $this->datasource;
  }

  function offsetGet($offset)
  {
    return $this->get($offset);
  }

  function offsetSet($offset, $value)
  {
    $this->set($offset, $value);
  }

  function offsetExists($offset)
  {
    return isset($this->datasource[$offset]);
  }

  function offsetUnset($offset)
  {
    unset($this->datasource[$offset]);
  }
}

?>
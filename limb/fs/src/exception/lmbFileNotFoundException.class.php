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
lmb_require(dirname(__FILE__) . '/lmbFsException.class.php');

class lmbFileNotFoundException extends lmbFsException
{
  function __construct($file_path, $message = 'file not found', $params = array())
  {
    $this->_file_path = $file_path;

    $params['file_path'] = $file_path;

    parent :: __construct($file_path . ': ' . $message, $params);
  }

  function getFilePath()
  {
    return $this->_file_path;
  }
}

?>
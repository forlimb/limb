<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: WactTextNode.class.php 5933 2007-06-04 13:06:23Z pachanga $
 * @package    $package$
 */

class WactTextNode extends WactCompileTreeNode
{
  protected $contents;

  function __construct($location, $text)
  {
    parent :: __construct($location);

    $this->contents = $text;
  }

  function generate($code_writer)
  {
    $code_writer->writeHTML($this->contents);

    parent :: generate($code_writer);
  }

  function getText()
  {
    return $this->contents;
  }
}

?>
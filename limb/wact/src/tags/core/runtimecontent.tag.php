<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: runtimecontent.tag.php 5933 2007-06-04 13:06:23Z pachanga $
 * @package    $package$
 */

/**
 * Present a named location where content can be inserted at runtime
 * @tag core:RUNTIMECONTENT
 * @forbid_end_tag
 */
class WactCoreRuntimeContentTag extends WactRuntimeComponentTag
{
  /**
   * @param WactCodeWriter
   */
  function generate($code_writer)
  {
    // Perhaps the render() call should be in the generate() method?
    $code_writer->writePHP($this->getComponentRefCode() . '->render();');
  }
}

?>
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
/**
* @tag find:params
* @forbid_end_tag
* @parent_tag_class lmbActiveRecordFetchTag
*/
class lmbFindParametersTag extends WactCompilerTag
{
  function generateTagContent($code)
  {
    foreach(array_keys($this->attributeNodes) as $key)
    {
      $name = $this->attributeNodes[$key]->getName();

      $code->writePhp($this->parent->getComponentRefCode() .
                      '->addFindParam(');
      $this->attributeNodes[$key]->generateExpression($code);
      $code->writePhp(');' . "\n");
    }
  }
}

?>
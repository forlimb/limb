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

interface WactExpressionInterface
{
  function isConstant();
  function getValue();
  function generatePreStatement($code_writer);
  function generateExpression($code_writer);
  function generatePostStatement($code_writer);
}
?>
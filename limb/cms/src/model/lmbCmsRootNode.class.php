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
lmb_require('limb/cms/src/model/lmbCmsNode.class.php');

class lmbCmsRootNode extends lmbCmsNode
{
  protected function _createValidator()
  {
    $validator = new lmbValidator();
    return $validator;
  }

  protected function _insertDbRecord($values)
  {
    $root_id = $this->_tree->initTree();
    $this->_tree->updateNode($root_id, $values);
    return $root_id;
  }

  function getUrlPath()
  {
    return '/';
  }

  function getParents()
  {
    return new lmbCollection();
  }
}

?>

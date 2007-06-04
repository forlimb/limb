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

lmb_require('limb/active_record/src/lmbActiveRecord.class.php');

class lmbCmsDocument extends lmbActiveRecord
{
  protected $_db_table_name = 'document';

  protected $_lazy_attributes = array('content');

  protected $_has_one = array('node' => array('field' => 'node_id',
                                              'class' => 'lmbCmsNode'));

  function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('content');
    return $validator;
  }

  function findKidsForParent($parent_id)
  {
    if(!$parent_id)
      $parent_id = 0;

    $sql = 'SELECT document.* '.
           ' FROM document LEFT JOIN node ON node.id = document.node_id '.
           ' WHERE node.parent_id = '. $parent_id;

    return lmbActiveRecord :: findBySql('lmbCmsDocument', $sql);
  }

  function getPublishedKids()
  {
    $sql = 'SELECT document.* '.
           ' FROM document LEFT JOIN node ON node.object_id = document.id '.
           ' WHERE node.parent_id = '. $this->getNode()->id .
           ' AND document.is_published = 1';

    return lmbActiveRecord :: findBySql('lmbCmsDocument', $sql);
  }
}

?>

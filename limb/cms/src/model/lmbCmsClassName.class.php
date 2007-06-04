<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbCmsClassName.class.php 5933 2007-06-04 13:06:23Z pachanga $
 * @package    $package$
 */
lmb_require('limb/active_record/src/lmbActiveRecord.class.php');
lmb_require('limb/dbal/src/criteria/lmbSQLFieldCriteria.class.php');

class lmbCmsClassName extends lmbActiveRecord
{
  protected $_db_table_name = 'class_name';

  static function generateIdFor($object)
  {
    if(is_object($object))
      $title = get_class($object);
    else
      $title = $object;

    $criteria = new lmbSQLFieldCriteria('title', $title);
    if($obj = lmbActiveRecord :: findFirst('lmbCmsClassName', array('criteria' => $criteria)))
    {
      return $obj->id;
    }
    else
    {
      $class_name = new lmbCmsClassName();
      $class_name->title = $title;
      $class_name->save();
      return $class_name->id;
    }

  }
}

?>

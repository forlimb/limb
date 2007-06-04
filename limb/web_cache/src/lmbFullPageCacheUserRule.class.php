<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbFullPageCacheUserRule.class.php 5933 2007-06-04 13:06:23Z pachanga $
 * @package    $package$
 */

class lmbFullPageCacheUserRule
{
  protected $user_groups = array();

  function __construct($user_groups)
  {
    $this->user_groups = $user_groups;
  }

  function isSatisfiedBy($request)
  {
    $user = $request->getUser();

    $positive_groups = array();
    $negative_groups = array();

    foreach($this->user_groups as $group)
    {
      if($group{0} == '!')
        $negative_groups[] = substr($group, 1);
      else
        $positive_groups[] = $group;
    }

    $res = true;

    if($positive_groups)
      $res = (array_intersect($positive_groups, $user->getGroups()) == $positive_groups);

    if($res && $negative_groups)
      $res &= !(array_intersect($negative_groups, $user->getGroups()) == $negative_groups);

    return $res;
  }
}

?>

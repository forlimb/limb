<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbTimingFilter.class.php 5933 2007-06-04 13:06:23Z pachanga $
 * @package    $package$
 */
lmb_require('limb/filter_chain/src/lmbInterceptingFilter.interface.php');

class lmbTimingFilter implements lmbInterceptingFilter
{
  public function run($filter_chain)
  {
    $start_time = microtime(true);

    $filter_chain->next();

    echo '<small>' . round(microtime(true) - $start_time, 2) . '</small>';
  }
}

?>
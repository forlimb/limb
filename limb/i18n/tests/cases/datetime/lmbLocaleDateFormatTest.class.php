<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbLocaleDateFormatTest.class.php 5933 2007-06-04 13:06:23Z pachanga $
 * @package    $package$
 */
lmb_require('limb/i18n/src/datetime/lmbLocaleDate.class.php');
lmb_require('limb/i18n/toolkit.inc.php');

class lmbLocaleDateFormatTest extends UnitTestCase
{
  function testFormatWithoutLocale()
  {
    $date = new lmbLocaleDate('2005-01-02 23:05:03');
    $string = $date->localeStrftime('%C %d %D %e %E %H %I %j %m %M %n %R %S %U %y %Y %t %%');

    $this->assertEqual($string, "20 02 01/02/05 2 2453373 23 11 002 01 05 \n 23:05 03 1 05 2005 \t %");
  }

  function testLocalizedFormat()
  {
    $date = new lmbLocaleDate('2005-01-20 10:15:30');

    $locale = new lmbLocale('en', new lmbIni(dirname(__FILE__) . '/../en.ini'));

    $res = $date->localeStrftime($locale->getDateFormat(), $locale);

    $expected = 'Thursday 20 January 2005';
    $this->assertEqual($res, $expected);
  }
}
?>

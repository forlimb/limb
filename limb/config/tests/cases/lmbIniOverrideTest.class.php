<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbIniOverrideTest.class.php 5933 2007-06-04 13:06:23Z pachanga $
 * @package    $package$
 */
lmb_require('limb/config/src/lmbIni.class.php');

class lmbIniOverrideTest extends UnitTestCase
{
  function setUp()
  {
    lmbFs :: mkdir(LIMB_VAR_DIR . '/tmp_ini');
  }

  function tearDown()
  {
    lmbFs :: rm(LIMB_VAR_DIR . '/tmp_ini');
  }

  function _createIniFileNames()
  {
    $name = mt_rand();
    $file = LIMB_VAR_DIR . '/tmp_ini/' . $name . '.ini';
    $override_file = LIMB_VAR_DIR . '/tmp_ini/' . $name . '.override.ini';
    return array($file, $override_file);
  }

  function testOverride()
  {
    list($file, $override_file) = $this->_createIniFileNames();

    file_put_contents($file,
       '[Templates]
        conf = 1
        force_compile = 0
        path = design/templates/');

    file_put_contents($override_file,
       '[Templates]
        conf =
        force_compile = 1');

    $ini = new lmbIni($file);

    $this->assertEqual($ini->getOption('conf', 'Templates'), null);
    $this->assertEqual($ini->getOption('path', 'Templates'), 'design/templates/');
    $this->assertEqual($ini->getOption('force_compile', 'Templates'), 1);
  }
}

?>
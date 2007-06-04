<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbRequiredObjectRuleTest.class.php 5933 2007-06-04 13:06:23Z pachanga $
 * @package    $package$
 */
lmb_require(dirname(__FILE__) . '/lmbValidationRuleTestCase.class.php');
lmb_require('limb/validation/src/rule/lmbRequiredObjectRule.class.php');

class TestObjectForThisRule{}

class lmbRequiredObjectRuleTest extends lmbValidationRuleTestCase
{
  function testValid()
  {
    $rule = new lmbRequiredObjectRule('testfield');

    $dataspace = new lmbSet();
    $dataspace->set('testfield', new TestObjectForThisRule());

    $this->error_list->expectNever('addError');

    $rule->validate($dataspace, $this->error_list);
  }

  function testInvalidIfDataspaceIsEmpty()
  {
    $rule = new lmbRequiredObjectRule('testfield');

    $dataspace = new lmbSet();

    $this->error_list->expectOnce('addError', array(lmb_i18n('Object {Field} is required', 'validation'),
                                                         array('Field'=>'testfield')));

    $rule->validate($dataspace, $this->error_list);
  }

  function testInvalidIfFieldIsNotAnObject()
  {
    $rule = new lmbRequiredObjectRule('testfield');

    $dataspace = new lmbSet(array('testfield' => 'whatever_and_not_object'));

    $this->error_list->expectOnce('addError', array(lmb_i18n('Object {Field} is required', 'validation'),
                                                         array('Field'=>'testfield')));

    $rule->validate($dataspace, $this->error_list);
  }

  function testNotValidWithClassRestriction()
  {
    $rule = new lmbRequiredObjectRule('testfield', 'Foo');

    $dataspace = new lmbSet();
    $dataspace->set('testfield', new TestObjectForThisRule());

    $this->error_list->expectOnce('addError', array(lmb_i18n('Object {Field} is required', 'validation'),
                                                         array('Field'=>'testfield')));
    $rule->validate($dataspace, $this->error_list);
  }

  function testNotValidWithClassRestrictionWithCustomError()
  {
    $rule = new lmbRequiredObjectRule('testfield', 'Foo', 'Custom_Error');

    $dataspace = new lmbSet();
    $dataspace->set('testfield', new TestObjectForThisRule());

    $this->error_list->expectOnce('addError', array('Custom_Error',
                                                    array('Field'=>'testfield')));
    $rule->validate($dataspace, $this->error_list);
  }
}

?>
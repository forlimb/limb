<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbActiveRecordFetcherTest.class.php 5933 2007-06-04 13:06:23Z pachanga $
 * @package    $package$
 */
lmb_require('limb/web_app/tests/cases/lmbWebAppTestCase.class.php');
lmb_require('limb/active_record/src/lmbActiveRecord.class.php');
lmb_require('limb/web_app/src/fetcher/lmbActiveRecordFetcher.class.php');
require_once('limb/active_record/tests/cases/lmbActiveRecordOneToManyRelationsTest.class.php');

class CourseForFetcherTestVersion extends CourseForTest
{
  static function findSpecial()
  {
    return new lmbCollection(array(array('special' => 1)));
  }

  static function findSpecialById($id)
  {
    return new lmbSet(array('id' => $id));
  }

  static function findWithParams($param1, $param2)
  {
    return new lmbCollection(array(array('param' => $param1),
                                     array('param' => $param2)));
  }
}

class lmbActiveRecordFetcherTest extends lmbWebAppTestCase
{
  function setUp()
  {
    $this->_cleanUp();
  }

  function tearDown()
  {
    $this->_cleanUp();
  }

  function _cleanUp()
  {
    lmbActiveRecord :: delete('CourseForTest');
  }

  function _createCourse()
  {
    $course = new CourseForTest();
    $course->setTitle('General Course');
    $course->save();

    return $course;
  }

  function testThrowExceptionIfClassPathNotDefined()
  {
    $fetcher = new lmbActiveRecordFetcher();
    try
    {
      $fetcher->fetch();
      $this->assertTrue(false);
    }
    catch(lmbException $e){}
  }

  function testFetchAllObjectsIfNoParams()
  {
    $course1 = $this->_createCourse();
    $course2 = $this->_createCourse();

    $fetcher = new lmbActiveRecordFetcher();
    $fetcher->setClassPath('CourseForTest');

    $rs = $fetcher->fetch();
    $rs->rewind();
    $this->assertTrue($rs->valid());
    $this->assertEqual($rs->current()->getTitle(), $course1->getTitle());
    $rs->next();
    $this->assertTrue($rs->valid());
    $this->assertEqual($rs->current()->getTitle(), $course2->getTitle());
  }

  function testFetchWithSpecifiedFindMethod()
  {
    $fetcher = new lmbActiveRecordFetcher();
    $fetcher->setClassPath('CourseForFetcherTestVersion');
    $fetcher->setFind('special');
    $rs = $fetcher->fetch();
    $rs->rewind();
    $this->assertTrue($rs->valid());
    $this->assertEqual($rs->current()->get('special'), 1);
  }

  function testFetchWithStaticFindWithParams()
  {
    $fetcher = new lmbActiveRecordFetcher();
    $fetcher->setClassPath('CourseForFetcherTestVersion');
    $fetcher->setFind('with_params');
    $fetcher->addFindParam('Value1');
    $fetcher->addFindParam('Value2');
    $rs = $fetcher->fetch();
    $rs->rewind();
    $this->assertTrue($rs->valid());
    $this->assertEqual($rs->current()->get('param'), 'Value1');
    $rs->next();
    $this->assertEqual($rs->current()->get('param'), 'Value2');
  }

  function testFetchSingleIfFetchWithIdNotDefined()
  {
    $course1 = $this->_createCourse();
    $course2 = $this->_createCourse();

    $fetcher = new lmbActiveRecordFetcher();
    $fetcher->setClassPath('CourseForTest');
    $fetcher->setRecordId($course1->getId());

    $rs = $fetcher->fetch();
    $rs->rewind();
    $this->assertTrue($rs->valid());
    $this->assertEqual($rs->current()->get('id'), $course1->getId());
    $this->assertEqual($rs->current()->get('title'), $course1->getTitle());
    $rs->next();
    $this->assertFalse($rs->valid());
  }

  function testFetchSingleWithCustomFinder()
  {
    $course1 = $this->_createCourse();

    $fetcher = new lmbActiveRecordFetcher();
    $fetcher->setClassPath('CourseForFetcherTestVersion');
    $fetcher->setFind('special_by_id');
    $fetcher->setRecordId($course1->getId());

    $rs = $fetcher->fetch();
    $rs->rewind();
    $this->assertTrue($rs->valid());
    $this->assertEqual($rs->current()->get('id'), $course1->getId());
    $rs->next();
    $this->assertFalse($rs->valid());
  }

  function testFetchSingleReturnsNothingIfNoId()
  {
    $course1 = $this->_createCourse();
    $course2 = $this->_createCourse();

    $fetcher = new lmbActiveRecordFetcher();
    $fetcher->setClassPath('CourseForTest');
    $fetcher->setRecordId('');

    $rs = $fetcher->fetch();
    $rs->rewind();
    $this->assertFalse($rs->valid());
  }

  function testFetchByIdsReturnsNothingIfNoIds()
  {
    $course1 = $this->_createCourse();
    $course2 = $this->_createCourse();
    $course3 = $this->_createCourse();

    $fetcher = new lmbActiveRecordFetcher();
    $fetcher->setClassPath('CourseForTest');
    $fetcher->setRecordIds(null);

    $rs = $fetcher->fetch();
    $rs->rewind();
    $this->assertFalse($rs->valid());
  }

  function testFetchByIds()
  {
    $course1 = $this->_createCourse();
    $course2 = $this->_createCourse();
    $course3 = $this->_createCourse();

    $fetcher = new lmbActiveRecordFetcher();
    $fetcher->setClassPath('CourseForTest');
    $fetcher->setRecordIds(array($course1->getId(), $course3->getId()));

    $rs = $fetcher->fetch();
    $rs->rewind();
    $this->assertTrue($rs->valid());
    $this->assertEqual($rs->current()->get('id'), $course1->getId());
    $rs->next();
    $this->assertTrue($rs->valid());
    $this->assertEqual($rs->current()->get('id'), $course3->getId());
    $rs->next();
    $this->assertFalse($rs->valid());
  }
}
?>


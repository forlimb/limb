<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbCacheFilePersister.class.php 5933 2007-06-04 13:06:23Z pachanga $
 * @package    $package$
 */
lmb_require('limb/cache/src/lmbCachePersister.interface.php');
lmb_require('limb/core/src/lmbSerializable.class.php');
lmb_require('limb/fs/src/lmbFs.class.php', false);

@define('LIMB_CACHE_FILE_PREFIX', 'cache_');

class lmbCacheFilePersister implements lmbCachePersister
{
  protected $cache_dir;
  protected $id;

  function __construct($cache_dir, $id = 'cache')
  {
    $this->cache_dir = $cache_dir;
    $this->id = $id;
    lmbFs :: mkdir($this->cache_dir);
  }

  function getId()
  {
    return $this->id;
  }

  function getCacheDir()
  {
    return $this->cache_dir;
  }

  function put($key, $value, $group = 'default')
  {
    $file = $this->_getCacheFilePath($group, $key);

    $container = new lmbSerializable($value);
    lmbFs :: safeWrite($file, serialize($container));
  }

  function get($key, $group = 'default')
  {
    $file = $this->_getCacheFilePath($group, $key);

    if(!file_exists($file))
      return LIMB_CACHE_NULL_RESULT;

    $container = unserialize(file_get_contents($file));
    return $container->getSubject();
  }

  function flushValue($key, $group = 'default')
  {
    $this->_removeFileCache($group, $key);
  }

  function flushGroup($group)
  {
    $this->_removeFileCache($group);
  }

  function flushAll()
  {
    $this->_removeFileCache();
  }

  protected function _removeFileCache($group = false, $key = false)
  {
    if($key === false)
    {
      $files = lmbFs :: find($this->cache_dir, 'f', '~^' . preg_quote($this->_getCacheFilePrefix($group)) . '~');
      foreach($files as $file)
        @unlink($file);
    }
    else
      @unlink($this->_getCacheFilePath($group, $key));
  }

  protected function _getCacheFilePrefix($group = false)
  {
    return LIMB_CACHE_FILE_PREFIX . ($group ? $group : '');
  }

  protected function _getCacheFileName($group, $key)
  {
    return $this->_getCacheFilePrefix($group) . '_' . $key . '.cache';
  }

  protected function _getCacheFilePath($group, $key)
  {
    return $this->cache_dir . '/' . $this->_getCacheFileName($group, $key);
  }
}
?>

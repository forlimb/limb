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
lmb_require('limb/core/src/lmbObject.class.php');

class lmbUploadedFile extends lmbObject
{
  function getFilePath()
  {
    return $this->getTmpName();
  }

  function getMimeType()
  {
    return $this->getType();
  }

  function move($dest)
  {
    move_uploaded_file($this->getTmpName(), $dest);
  }

  function isUploaded()
  {
    return is_uploaded_file($this->getTmpName());
  }

  function isValid()
  {
    return $this->getError() == UPLOAD_ERR_OK;
  }

  function getContents()
  {
    return file_get_contents($this->getTmpName());
  }

  function destroy()
  {
    unlink($this->getTmpName());
  }
}

?>
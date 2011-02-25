<?php
namespace Base\File;

/**
 *
 * This FileObect represents a File
 * exists.
 * @author mikelohmann
 *
 */
class File
{

  /**
   *
   * Defines the file mode.
   * @var integer
   */
  private $permissionsMode = 0777;

  /**
   *
   * Contains the Filepath
   * @var String filePath
   */
  private $filePath;
  /**
   *
   * Creates a File Object
   * @param String $this->filePath
   * @param Integer $mode
   */

  private $content;

  public function __construct($filePath)
  {
    $this->setFilePath($filePath);
  }

  public function isWritable()
  {
    // @fixme check if dir most next to filePath is writeable
    return is_writable($this->filePath);
  }

  public function exists()
  {
    return file_exists($this->filePath);
  }

  public function remove()
  {
    $this->removeFile();
  }

  public function create()
  {
    $this->createFileIfNotExists();
  }

  public function save()
  {
    $this->createFileIfNotExists();
    file_put_contents($this->filePath, $this->content);
  }

  public function setFilePermission($mode = 0777)
  {
    $this->permissionsMode = $mode;
    $this->changeFilePermissions($this->filePath, $this->permissionsMode);
  }

  public function setContent( $content )
  {
    $this->content = $content;
  }

  private function setFilePath($filePath)
  {
    $this->filePath = $filePath;
  }

  private function changeFilePermissions($filePath, $mode)
  {
    if (true !== @chmod($filePath, $mode))
    {
      $tmpError = error_get_last();
      throw new Exception('File permissions for ' . $filePath . ' could not be changed. (' . $tmpError['message'] . ')');
    }
    else
    {
      return true;
    }
  }

  /**
   *
   * Checks if a File exists and create it otherwise.
   * @param String $this->filePath
   * @return Boolean true;
   */
  private function createFileIfNotExists()
  {

    if (false === $this->exists($this->filePath))
    {
      $this->createFileAndDir($this->filePath);
    }
    else
    {
      return true;
    }
  }

  /**
   *
   * Extracts dirname and filename from given filePath and handles
   * creation.
   * @param String $this->filePath
   * @return Boolean true;
   */
  private function createFileAndDir($filePath)
  {
    $dirPath = $this->getDirPath($filePath);
    $fileName = $this->getFilename($filePath);

    $this->createDir($dirPath);
    $this->createFile($dirPath . DIRECTORY_SEPARATOR . $fileName);

    return true;
  }

  private function getFilename($filePath)
  {
    $pathInfos = pathinfo($filePath);
    return $pathInfos['basename'];
  }

  private function getDirPath($filePath)
  {
    $pathInfos = pathinfo($filePath);
    return $pathInfos['dirname'];
  }

  /**
   *
   * Creates File.
   * @param String $fileName
   * @throws Base\File\CreatorException
   * @return Boolean true
   */
  private function createFile($fileName)
  {
    if (false === @touch($fileName))
    {
      $tmpError = error_get_last();
      throw new Exception('File ' . $fileName . ' could not be created: (' . $tmpError['message'] . ')');
    }
    else
    {
      return true;
    }
  }

  /**
   *
   * Creates Dir. Recursivly.
   * @param  String $dirPath
   * @throws Base\File\CreatorException
   * @return Boolean true
   */
  private function createDir($dirPath)
  {
    if (false === is_dir($dirPath))
    {
      if (false === @mkdir($dirPath, $this->permissionsMode, true))
      {
        $tmpError = error_get_last();
        throw new Exception('DirPath ' . $dirPath . ' could not be created: (' . $tmpError['message'] . ')');
      }
    }
    else
    {
      return true;
    }
  }

  private function removeFile()
  {

    if ($this->exists())
    {
      if (false === @unlink($this->filePath))
      {
        $tmpError = error_get_last();
        throw new Exception('File ' . $this->filePath . ' could not be deleted: (' . $tmpError['message'] . ')');
      }

    }
    else
    {
      return true;
    }
  }
}
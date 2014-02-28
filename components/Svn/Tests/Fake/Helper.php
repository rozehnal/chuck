<?php

namespace DixonsCz\Chuck\Svn\Tests\Fake;

class Helper implements \DixonsCz\Chuck\Svn\IHelper
{

    protected $svnLogFile;

    public function __construct()
    {
        $this->svnLogFile = __DIR__ . DIRECTORY_SEPARATOR . 'log.xml';
    }

    public function createTag($tagName, $tagMessage)
    {
        
    }

    public function getCurrentBranch()
    {
        return 'fake';
    }

    public function getInfo($project = null)
    {
        return array(
            'url' => 'http://really-fake-repo',
            'root' => 'fake-root',
        );
    }

    public function getLog($path = '/trunk', $offset = 0, $limit = 30)
    {
        $xmlLog = simplexml_load_file($this->svnLogFile);
        
        $output = array();
        foreach ($xmlLog as $log)
        {
            $output[(int) $log->attributes()->revision] = array(
                'revision' => (int) $log->attributes()->revision,
                'author' => (string) $log->author,
                'date' => (string) $log->date,
                'msg' => (string) $log->msg,
            );
        }
        
        return $output;
    }

    public function getLogSize()
    {
        return 30;
    }

    public function getTagList()
    {
        return array();
    }

    public function getTagLog($tagName, $limit = 30)
    {
        return $this->getLog();
    }

    public function startup($project)
    {
        
    }

    public function updateRepository()
    {
        
    }

}

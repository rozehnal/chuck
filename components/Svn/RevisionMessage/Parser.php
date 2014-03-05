<?php

namespace DixonsCz\Chuck\Svn\RevisionMessage;

class Parser implements IParser
{
    /**
     * 
     * @param string $message
     * @return \DixonsCz\Chuck\Svn\IRevisionMessage
     */
    public function parseFromString($message)
    {        
        $ticketNumber = null;
        
        // remove ticket number because it will be added manually from parsed number
        if (preg_match('~([A-Z]+[-][0-9]+)~s', $message, $matches))
        {
            $message = trim(str_replace(array("[{$matches[1]}]", $matches[1], "[]"), "", $message));
            $ticketNumber = $matches[1];
        }        
        
        return new \DixonsCz\Chuck\Svn\RevisionMessage($ticketNumber, $message);
    }
}
<?php

namespace DixonsCz\Chuck\Svn\RevisionMessage;

interface IParser
{
    /**
     * @param string $message
     * @return IRevisionMessage
     */
    function parseFromString($message);
}
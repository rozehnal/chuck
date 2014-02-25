<?php

interface IRevisionMessageParser
{
    /**
     * @param string $message
     * @return IRevisionMessage
     */
    function parseFromString($message);
}
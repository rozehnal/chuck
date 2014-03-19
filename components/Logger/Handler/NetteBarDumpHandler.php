<?php

namespace DixonsCz\Chuck\Logger\Handler;

use Monolog\Handler\AbstractHandler;
use Nette\Diagnostics\Debugger;

/**
 * Passes logs to Nette Debugger.
 */
class NetteBarDumpHandler extends AbstractHandler
{
    /**
     * {@inheritDoc}
     */
    public function handle(array $record)
    {
        Debugger::barDump($record, 'Monolog');
    }
}

<?php

namespace DixonsCz\Chuck\Log;

/**
 *
 * @author Michal Svec <michal.svec@dixonsretail.com>
 */
class Table extends \Nette\Application\UI\Control
{
    /**
     * Rendered columns
     * @var array
     */
    private $availableColumns = array(
        'revision', 'author', 'date', 'message'
    );

    /**
     * Selected column that will be displayed in table
     * @var array
     */
    private $selectedColumns = array();

    /**
     * @var array
     */
    private $log = array();

    /**
     * Selected logs that should be checked
     * @var array[integer]
     */
    private $selectedLogs = array();

    public function __construct($container, $name)
    {
        parent::__construct($container, $name);
        $this->selectedColumns = $this->availableColumns;
    }

    public function setLog(array $log)
    {
        $this->log = $log;
    }

    /**
     * Set logs that were selected
     *
     * @param   array [integer]  ID of selected logs
     */
    public function setSelectedLogs($logs)
    {
        $this->selectedLogs = $logs;
    }

    /**
     * Disable some columns in final render of table
     *
     * @param  string                   $colName
     * @throws \InvalidArgumentException
     */
    public function disableColumnRender($colName)
    {
        if (!in_array($colName, $this->availableColumns)) {
            throw new \InvalidArgumentException("{$colName} is not allowed to disable!");
        }

        if (in_array($colName, $this->selectedColumns)) {
            unset($this->selectedColumns[array_search($colName, $this->selectedColumns)]);
        }
    }

    public function render()
    {
        /** @var \stdClass $template */
        $template = $this->createTemplate();
        $template->setFile(__DIR__ . '/Table.latte');

        $template->selectedLogs = $this->selectedLogs;
        $template->selectedColumns = $this->selectedColumns;
        $template->jiraPath = $this->parent->context->parameters['jiraPath'];

        $template->log = $this->log;
        $template->render();
    }
}

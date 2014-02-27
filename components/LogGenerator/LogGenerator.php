<?php

/**
 *
 * @author Michal Svec <michal.svec@dixonsretail.com>
 */
class LogGenerator extends \Nette\Application\UI\Control
{

    const ORDER_PRIORITY = 'priority';
    const ORDER_ISSUETYPE = 'type';

    private $jiraHelper;
    
    /**
     *
     * @var IRevisionMessageParser
     */
    private $revisionMessageParser;

    /**
     * @param JiraWrapper $jiraHelper
     */
    function __construct(JiraWrapper $jiraHelper, IRevisionMessageParser $messageParser)
    {
        $this->jiraHelper = $jiraHelper;
        $this->revisionMessageParser = $messageParser;
    }

    /**
     * @param array $revisions
     * @param  string $orderBy
     * @return array
     */
    public function generateTicketLog($revisions, $orderBy = self::ORDER_ISSUETYPE)
    {
        $log = $this->getTicketInformation($revisions);

        switch ($orderBy)
        {
            case self::ORDER_PRIORITY:
                $log['ALL'] = $this->orderByPriority($log['ALL']);
                break;

            case self::ORDER_ISSUETYPE:
            default:
                $log['ALL'] = $this->orderByIssueType($log['ALL']);
                break;
        }

        return $log;
    }

    /**
     * Gets the array with all necessary information about tickets
     *
     * @param  array  $logList
     * @return array
     */
    protected function getTicketInformation($logList)
    {
        $ticketLog = array();
        $issues = array();
        foreach ($logList as $logLine)
        {
            $revisionMessage = $this->revisionMessageParser->parseFromString($logLine['msg']);
            $jiraIssue = $revisionMessage->findJiraIssue($this->jiraHelper);
            if ($jiraIssue != null)
            {
                $issues[] = $jiraIssue;
            }
            else
            {
                $ticketLog['ALL'][] = $revisionMessage->toArray();
                $ticketLog['OTHER'][] = $revisionMessage->toArray();
            }            
        }

        $ticketLog['RFC'] = array_filter($issues, function(IIssue $issue){
            return $issue->isRFC();
        });
        $ticketLog['BUG'] = array_filter($issues, function(IIssue $issue){
            return $issue->isBug();
        });
        $ticketLog['SUPPORT'] = array_filter($issues, function(IIssue $issue){
            return $issue->isSupportRequest();
        });
        $ticketLog['OTHER'] += array_filter($issues, function(IIssue $issue){
            return $issue->isOther();
        });
        $ticketLog['ALL'] += $issues;
        

        return $ticketLog;
    }

    /**
     * Orders that RFCs are 1st, bugfixes 2nd, support 3rd and the rest below
     *
     * @param  array $issues
     * @return array
     */
    private function orderByIssueType($issues)
    {
        trigger_error("Sorting not implemented!", E_USER_NOTICE);
        return $issues;
    }

    /**
     * P1 at the top, then P2, .....
     *
     * @param $issues
     * @return mixed
     */
    private function orderByPriority($issues)
    {
        trigger_error("Sorting not implemented!", E_USER_NOTICE);
        return $issues;
    }

    /**
     * @param $message
     * @return array
     */
    public function parseRevisionMessage($message)
    {
        preg_match('~([A-Z]+[-][0-9]+)~s', $message, $matches);

        // remove ticket number because it will be added manually from parsed number
        if (isset($matches[1]))
        {
            $message = str_replace(array("[{$matches[1]}]", $matches[1], "[]"), "", $message);
        }

        return array(
            'ticket' => isset($matches[1]) ? $matches[1] : "", // trim($matches[2], "[]"),
            'message' => $message
        );
    }

}

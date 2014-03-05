<?php

namespace DixonsCz\Chuck\Jira;

/**
 * Example: https://jira.example.com/rest/api/latest/issue/EXPVY-325
 *
 * @author Michal Svec <michal.svec@dixonsretail.com>
 */
class Wrapper extends \Nette\Object
{
    /**
     * @var Issue\IRepository
     */
    private $issuesRepository;

    /**
     * 
     * @param \DixonsCz\Chuck\Jira\Issue\IRepository $issuesRepository
     */
    public function __construct(Issue\IRepository $issuesRepository)
    {
        $this->issuesRepository = $issuesRepository;
    }

    /**
     * 
     * @param string $key
     * @return IIssue
     */
    public function getTicketInfo($key)
    {
        \Nette\Diagnostics\Debugger::barDump($key, "JIRA Request");
        $issue = $this->issuesRepository->findIssueByKey($key);
        \Nette\Diagnostics\Debugger::barDump($issue, "issue {$key}");
        \Nette\Diagnostics\Debugger::barDump($issue->toArray(), "Jira data for {$key}");
        
        return $issue;
    }

}

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
     * @var string
     */
    private $apiUrl;

    /**
     * @var
     */
    private $credentials;

    /**
     * @param string $apiUrl
     * @param array  $credentials
     */
    public function __construct($apiUrl, $credentials)
    {
        $this->apiUrl = (string) $apiUrl;
        $this->credentials = $credentials;
    }

    public function getTicketInfo($key)
    {
        \Nette\Diagnostics\Debugger::barDump($key, "JIRA Request");
        $issue = $this->issuesRepository->findIssueByKey($key);
        \Nette\Diagnostics\Debugger::barDump($issue, "issue {$key}");
        \Nette\Diagnostics\Debugger::barDump($issue->toArray(), "Jira data for {$key}");
    }

}

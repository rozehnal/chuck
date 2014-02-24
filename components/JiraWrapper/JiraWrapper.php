<?php

/**
 * Example: https://jira.example.com/rest/api/latest/issue/EXPVY-325
 *
 * @author Michal Svec <michal.svec@dixonsretail.com>
 */
class JiraWrapper extends \Nette\Object
{

    
        /**
         *
         * @var IJiraIssuesRepository
         */
        private $issuesRepository;
    	
        /**
         * 
         * @param IJiraIssuesRepository $repository
         */
        public function __construct(IJiraIssuesRepository $repository)
        {
            $this->issuesRepository = $repository;
        }
        
	public function getTicketInfo($key)
	{
		\Nette\Diagnostics\Debugger::barDump($path, "JIRA Request");		
                $issue = $this->issuesRepository->findIssueByKey($key);		               
		\Nette\Diagnostics\Debugger::barDump($issue, "issue {$key}");

		$finalResult = $issue->toArray();

		\Nette\Diagnostics\Debugger::barDump($finalResult, "Jira data for {$key}");

		return $finalResult;
	}
}


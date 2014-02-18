<?php

/**
 *
 * @author Michal Svec <michal.svec@dixonsretail.com>
 */
class LogGenerator extends \Nette\Application\UI\Control
{
	const ORDER_PRIORITY  = 'priority';
	const ORDER_ISSUETYPE = 'type';

	private $jiraHelper;

	/**
	 * @param JiraWrapper $jiraHelper
	 */
	function __construct(JiraWrapper $jiraHelper)
	{
		$this->jiraHelper = $jiraHelper;
	}

	/**
	 * @param array $revisions
	 * @return array
	 */
	public function generateTicketLog($revisions)
	{
		return $this->getTicketInformation($revisions);
	}

	/**
	 * Gets the array with all necessary information about tickets
	 *
	 * @param  array  $logList
	 * @param  string $orderBy
	 * @return array
	 */
	protected function getTicketInformation($logList, $orderBy = self::ORDER_ISSUETYPE)
	{
		$ticketLog = array();
		foreach ($logList as $logLine) {

			$data = $this->parseRevisionMessage($logLine['msg']);

			if (!empty($data)) {
				if (isset($data['ticket']) && !empty($data['ticket'])) {
					$data['jira'] = $this->jiraHelper->getTicketInfo($data['ticket']);
				}

				// 2 ways of getting the ticket
				// either by type (RFC|BUG|SUPPORT|OTHER)
				// or from ALL where all tickets are

				if(isset($data['jira']['typeName'])) {
					switch ($data['jira']['typeName']) {
						case "Technical task":
						case "RFC":
							$ticketLog['RFC'][$data['ticket']] = $data;
							break;
						case "Bug":
							$ticketLog['BUG'][$data['ticket']] = $data;
							break;
						case "Support Request":
							$ticketLog['SUPPORT'][$data['ticket']] = $data;
							break;
						default:
							$ticketLog['OTHER'][] = $data;
					}
					$ticketLog['ALL'][$data['ticket']] = $data;
				}
				else {
					$ticketLog['OTHER'][] = $data;
					$ticketLog['ALL'][] = $data;
				}
			}
		}

		switch($orderBy) {
			case self::ORDER_PRIORITY:
				$ticketLog['ALL'] = $this->orderByPriority($ticketLog['ALL']);
				break;

			case self::ORDER_ISSUETYPE:
			default:
				$ticketLog['ALL'] = $this->orderByIssueType($ticketLog['ALL']);
				break;
		}

		return $ticketLog;
	}


	private function orderByIssueType($issues)
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
		if(isset($matches[1])) {
			$message = str_replace(array("[{$matches[1]}]", $matches[1], "[]"), "", $message);
		}

		return array(
			'ticket' => isset($matches[1]) ? $matches[1] : "", // trim($matches[2], "[]"),
			'message' => $message
		);
	}

}

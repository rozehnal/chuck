<?php

interface ISingleIssueTransformer extends IJiraResponseTransformer
{
    /**
     * @reutrn JiraIssue
     */
    function createFromRawData($data);
}

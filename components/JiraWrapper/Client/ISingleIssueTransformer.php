<?php

interface ISingleIssueTransformer extends IJiraResponseTransformer
{
    /**
     * @return JiraIssue
     */
    function createFromRawData($data);
}

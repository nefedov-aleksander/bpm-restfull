<?php
namespace BpmRestfull\Definition\CaseDefinition;

use BpmRestfull\Definition\Arrayable;

class YouTrack implements Arrayable
{

    private $youTrackCreateUrl = '';

    private $youTrackUrl = '';

    private $newTaskUrl = '';

    private $youTrackIssue = '';

    private $youTrackIssueSubsystem = '';

    private $youTrackIssuePriority = '';

    private $youTrackIssueType = '';

    private $hasYouTrackIssue = false;

    public function getYouTrackCreateUrl(): string
    {
        return $this->youTrackCreateUrl;
    }

    public function setYouTrackCreateUrl(string $url)
    {
        $this->youTrackCreateUrl = $url;
    }

    public function getYouTrackUrl(): string
    {
        return $this->youTrackUrl;
    }

    public function setYouTrackUrl(string $url)
    {
        $this->youTrackUrl = $url;
    }

    public function getNewTaskUrl(): string
    {
        return $this->newTaskUrl;
    }

    public function setNewTaskUrl(string $url)
    {
        $this->newTaskUrl = $url;
    }

    public function getYouTrackIssue(): string
    {
        return $this->youTrackIssue;
    }

    public function setYouTrackIssue(string $issue)
    {
        $this->youTrackIssue = $issue;
    }

    public function getYouTrackIssueSubsystem(): string
    {
        return $this->youTrackIssueSubsystem;
    }

    public function setYouTrackIssueSubsystem(string $subsystem)
    {
        $this->youTrackIssueSubsystem = $subsystem;
    }

    public function getYouTrackIssuePriority(): string
    {
        return $this->youTrackIssuePriority;
    }

    public function setYouTrackIssuePriority(string $priority)
    {
        $this->youTrackIssuePriority = $priority;
    }

    public function getYouTrackIssueType(): string
    {
        return $this->youTrackIssueType;
    }

    public function setYouTrackIssueType(string $type)
    {
        $this->youTrackIssueType = $type;
    }

    public function isHasYouTrackIssue(): bool
    {
        return $this->hasYouTrackIssue;
    }

    public function setHasYouTrackIssue(bool $has)
    {
        $this->hasYouTrackIssue = $has;
    }
    
    public function toArray() : array
    {  
        return [
            'YouTrackCreateUrl' => $this->getYouTrackCreateUrl(),
            'YouTrackUrl' => $this->getYouTrackUrl(),
            'NewTaskUrl' => $this->getNewTaskUrl(),
            'YouTrackIssue' => $this->getYouTrackIssue(),
            'YouTrackIssueSubsystem' => $this->getYouTrackIssueSubsystem(),
            'YouTrackIssuePriority' => $this->getYouTrackIssuePriority(),
            'YouTrackIssueType' => $this->getYouTrackIssueType(),
            'HasYouTrackIssue' => $this->isHasYouTrackIssue()
        ];
    }
}
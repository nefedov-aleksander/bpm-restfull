<?php
namespace BpmRestfull\Definition;

class CaseDefinition implements Arrayable
{

    const CASE_TYPE_OUTSOURCING = 0;

    const CASE_TYPE_CONSULTING = 1;

    const CASE_TYPE_JURIDICAL_CONSULTING = 2;

    const CASE_TYPE_USER = 3;

    const CASE_TYPE_CONSULTATIONS = 4;

    const CASE_TYPE_TECHNICAL_SUPPORT = 5;

    const CASE_TYPE_REPORT = 6;

    const CASE_TYPE_ADMINISTRATION = 7;

    const CASE_TYPE_SERVICE = 8;

    const CASE_TYPE_SERVICE_ADMISSION = 9;

    const CASE_TYPE_MD_DEPARTMENTS = 10;

    const CASE_TYPE_UNSORT = 11;

    const CASE_TYPE_AUTO_ANSWER = 12;

    const CASE_TYPE_TRAINING = 13;

    const CASE_TYPE_EXIT_FIRST = 14;

    const CASE_TYPE_ONE_TIME = 15;

    const CASE_TYPE_SALARY = 16;

    const CASE_TYPE_BANK = 17;

    const CASE_TYPE_CACHIER = 18;

    const CASE_TYPE_SELLINGS = 19;

    const CASE_TYPE_HARD = 20;

    const CASE_TYPE_SALES = 21;

    const CASE_STATUS_OPEN_NEW = 1;

    const CASE_STATUS_OPEN_ASSIGNED = 2;

    const CASE_STATUS_CLOSED_CLOSED = 3;

    const CASE_STATUS_OPEN_PENDING_INPUT = 4;

    const CASE_STATUS_CLOSED_DUPLICATE = 5;

    const CASE_STATUS_CLOSED_REJECTED = 6;

    const CASE_STATUS_CLOSED_DUBLICATE = 7;

    const CASE_PRIORITY_HIGH = 1;

    const CASE_PRIORITY_MEDIUM = 2;

    const CASE_PRIORITY_LOW = 3;

    const CASE_STATE_OPEN = 1;

    const CASE_STATE_OPEN_AGAIN = 2;

    const CASE_STATE_ASSIGNED = 3;

    const CASE_STATE_IN_WORK = 4;

    const CASE_STATE_CONTACT_CLIENT = 5;

    const CASE_STATE_CLOSED = 6;

    const CASE_STATE_NOT_DELIVERED = 7;

    const CASE_STATE_NEW = 8;

    const CASE_STATE_KAYKO = 9;

    const CASE_STATE_ACCEPTED = 10;

    const CASE_CREATOR_TYPE_UNDEFINED = 0;

    const CASE_CREATOR_TYPE_API = 1;

    const CASE_CREATOR_TYPE_CHAT = 2;

    const CASE_CREATOR_TYPE_EMAIL = 3;

    const CASE_CREATOR_TYPE_EMPLOYEE = 4;

    public static $typeNamesMap = [
        'outsourcing' => CaseDefinition::CASE_TYPE_OUTSOURCING,
        'consulting' => CaseDefinition::CASE_TYPE_CONSULTING,
        'juridicalconsulting' => CaseDefinition::CASE_TYPE_JURIDICAL_CONSULTING,
        'user' => CaseDefinition::CASE_TYPE_USER,
        'consultations' => CaseDefinition::CASE_TYPE_CONSULTATIONS,
        'technical_support' => CaseDefinition::CASE_TYPE_TECHNICAL_SUPPORT,
        'report' => CaseDefinition::CASE_TYPE_REPORT,
        'administration' => CaseDefinition::CASE_TYPE_ADMINISTRATION,
        'service' => CaseDefinition::CASE_TYPE_SERVICE,
        'service_admission' => CaseDefinition::CASE_TYPE_SERVICE_ADMISSION,
        'mddepartments' => CaseDefinition::CASE_TYPE_MD_DEPARTMENTS,
        'unsort' => CaseDefinition::CASE_TYPE_UNSORT,
        'autoanswer' => CaseDefinition::CASE_TYPE_AUTO_ANSWER,
        'training' => CaseDefinition::CASE_TYPE_TRAINING,
        'exitfirst' => CaseDefinition::CASE_TYPE_EXIT_FIRST,
        'onetime' => CaseDefinition::CASE_TYPE_ONE_TIME,
        'salary' => CaseDefinition::CASE_TYPE_SALARY,
        'bank' => CaseDefinition::CASE_TYPE_BANK,
        'cachier' => CaseDefinition::CASE_TYPE_CACHIER,
        'sellings' => CaseDefinition::CASE_TYPE_SELLINGS,
        'hard' => CaseDefinition::CASE_TYPE_HARD,
        'sales' => CaseDefinition::CASE_TYPE_SALES
    ];
    
    public static $stateNamesMap = [
        'new' => self::CASE_STATE_NEW,
        'kayko' => self::CASE_STATE_KAYKO,
        'open' => self::CASE_STATE_OPEN,
        'openagain' => self::CASE_STATE_OPEN_AGAIN,
        'assigned' => self::CASE_STATE_ASSIGNED,
        'inwork' => self::CASE_STATE_IN_WORK,
        'accepted' => self::CASE_STATE_ACCEPTED,
        'contactclient' => self::CASE_STATE_CONTACT_CLIENT,
        'closed' => self::CASE_STATE_CLOSED,
        'notdelivered' => self::CASE_STATE_NOT_DELIVERED
    ];

    public static $priorityNamesMap = [
        'p1' => self::CASE_PRIORITY_HIGH,
        'p2' => self::CASE_PRIORITY_MEDIUM,
        'p3' => self::CASE_PRIORITY_LOW
    ];
    
    public static $statusNameMap = [
        'open_new' => CaseDefinition::CASE_STATUS_OPEN_NEW,
        'open_assigned' => CaseDefinition::CASE_STATUS_OPEN_ASSIGNED,
        'closed_closed' => CaseDefinition::CASE_STATUS_CLOSED_CLOSED,
        'open_pending input' => CaseDefinition::CASE_STATUS_OPEN_PENDING_INPUT,
        'closed_duplicate' => CaseDefinition::CASE_STATUS_CLOSED_DUPLICATE,
        'closed_rejected' => CaseDefinition::CASE_STATUS_CLOSED_REJECTED,
        'closed_duplicate_1' => CaseDefinition::CASE_STATUS_CLOSED_DUBLICATE
    ];
    
    public static $creatorTypeNameMap = [
        'api' => CaseDefinition::CASE_CREATOR_TYPE_API,
        'chat' => CaseDefinition::CASE_CREATOR_TYPE_CHAT,
        'email' => CaseDefinition::CASE_CREATOR_TYPE_EMAIL,
        'employee' => CaseDefinition::CASE_CREATOR_TYPE_EMPLOYEE
    ];

    private $dateFormat = 'Y-m-d\TH:m:s';

    private $id = null;

    private $caseNumber = null;

    private $subject = '';

    private $createDate = null;

    private $modifyDate = null;

    private $stopDate = null;

    private $lastReplyDate = null;

    private $createdByUserId = '';

    private $modifiedByUserId = '';

    private $ownerId = '';

    private $accountId = '';

    private $description = '';

    private $resolution = '';

    private $workLog = '';

    private $comments = '';

    private $deleted = false;

    private $type;

    private $status;

    private $priority;

    private $state;

    private $creatorType = self::CASE_CREATOR_TYPE_UNDEFINED;

    private $contactCreatorId = '';

    private $subcategory = '';

    private $category = '';

    private $isPush = false;

    private $addHistory = false;

    private $mdPaymentId;

    private $reportsCounter = 0;

    private $inboundEmailboxId = '';

    private $initialEmail = '';

    private $caseUpdateDraft = '';

    private $nextCaseId = '';

    private $sla;

    private $youTrack;

    public function __construct(string $dateFormat = 'Y-m-d\TH:i:s')
    {
        $this->dateFormat = $dateFormat;
        
        $this->sla = new CaseDefinition\Sla($dateFormat);
        $this->youTrack = new CaseDefinition\YouTrack($dateFormat);
    }

    public static function createFromArray(array $data, string $dateFormat = 'Y-m-d\TH:i:s'): CaseDefinition
    {
        $request = new self($dateFormat);
        
        if (isset($data['id'])) {
            $request->setId($data['id']);
        }
        
        if (isset($data['case_number'])) {
            $request->setCaseNumber($data['case_number']);
        }
        
        $request->setSubject($data['name'] ?? '');
        
        if (! empty($data['date_entered'])) {
            $request->setCreateDate(new \DateTime($data['date_entered']));
        }
        
        if (! empty($data['date_modified'])) {
            $request->setModifyDate(new \DateTime($data['date_modified']));
        }
        
        if (! empty($data['date_stop'])) {
            $request->setStopDate(new \DateTime($data['date_stop']));
        }
        
        if (! empty($data['last_reply_date'])) {
            $request->setLastReplyDate(new \DateTime($data['last_reply_date']));
        }
        
        $request->setModifiedByUserId($data['modified_user_id'] ?? '');
        $request->setCreatedByUserId($data['created_by'] ?? '');
        $request->setOwnerId($data['assigned_user_id'] ?? '');
        $request->setAccountId($data['account_id'] ?? '');
        $request->setContactCreatorId($data['contact_created_by_id'] ?? '');
        $request->setInboundEmailboxId($data['selected_inbound_emailbox_id'] ?? '');
        $request->setNextCaseId($data['next_case_id'] ?? '');
        
        $request->setDescription($data['description'] ?? '');
        $request->setResolution($data['resolution'] ?? '');
        $request->setWorkLog($data['work_log'] ?? '');
        $request->setComments($data['comments'] ?? '');
        $request->setSubcategory($data['subcategory_of_the_query'] ?? '');
        $request->setCategory($data['basic_request_category'] ?? '');
        $request->setReportsCounter($data['case_counter_line'] ?? 0);
        $request->setInitialEmail($data['initial_email'] ?? '');
        $request->setCaseUpdateDraft($data['case_update_draft'] ?? '');
        
        if (! empty($data['md_payment_id_c'])) {
            $request->setMdPaymentId($data['md_payment_id_c']);
        }
        
        if (isset($data['deleted']) && $data['deleted']) {
            $request->deleted();
        }
        
        if (isset($data['assigned_user_push']) && $data['assigned_user_push']) {
            $request->setIsPush(true);
        }
        
        if (isset($data['add_history']) && $data['add_history']) {
            $request->setAddHistory(true);
        }
        
        if (isset($data['type']) && isset(self::$typeNamesMap[strtolower($data['type'])])) {
            $request->setType(self::$typeNamesMap[strtolower($data['type'])]);
        }
        
        if (isset($data['state']) && isset(self::$stateNamesMap[strtolower($data['state'])])) {
            $request->setState(self::$stateNamesMap[strtolower($data['state'])]);
        }
        
        if (isset($data['priority']) && isset(self::$priorityNamesMap[strtolower($data['priority'])])) {
            $request->setPriority(self::$priorityNamesMap[strtolower($data['priority'])]);
        }
        
        if (isset($data['status']) && isset(self::$statusNameMap[strtolower($data['status'])])) {
            $request->setStatus(self::$statusNameMap[strtolower($data['status'])]);
        }
        
        if (isset($data['create_by_type']) && isset(self::$creatorTypeNameMap[strtolower($data['create_by_type'])])) {
            $request->setCreatorType(self::$creatorTypeNameMap[strtolower($data['create_by_type'])]);
        }
        
        $request->getSla()->setDescription($data['sla_description'] ?? '');
        $request->getSla()->setWorkHours($data['sla_work_hours'] ?? '');
        $request->getSla()->setDelay($data['sla_delay'] ?? 0);
        
        if (! empty($data['sla_date_start'])) {
            $request->getSla()->setStartDate(new \DateTime($data['sla_date_start']));
        }
        
        if (! empty($data['sla_date_end_plan'])) {
            $request->getSla()->setPlanEndDate(new \DateTime($data['sla_date_end_plan']));
        }
        
        if (! empty($data['sla_date_end_fact'])) {
            $request->getSla()->setFactEndDate(new \DateTime($data['sla_date_end_fact']));
        }
        
        $request->getYouTrack()->setYouTrackCreateUrl($data['youtrack_create'] ?? '');
        $request->getYouTrack()->setYouTrackUrl($data['youtrack_c'] ?? '');
        $request->getYouTrack()->setNewTaskUrl($data['new_ts_c'] ?? '');
        $request->getYouTrack()->setYouTrackIssue($data['youtrack_issue_c'] ?? '');
        $request->getYouTrack()->setYouTrackIssueSubsystem($data['youtrack_issue_subsystem_c'] ?? '');
        $request->getYouTrack()->setYouTrackIssuePriority($data['youtrack_issue_priority_c'] ?? '');
        $request->getYouTrack()->setYouTrackIssueType($data['youtrack_issue_type_c'] ?? '');
        
        if (isset($data['has_youtrack_issue_c']) && $data['has_youtrack_issue_c']) {
            $request->getYouTrack()->setHasYouTrackIssue(true);
        }
        
        return $request;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function getCaseNumber(): int
    {
        return $this->caseNumber;
    }

    public function setCaseNumber(int $caseNumber)
    {
        $this->caseNumber = $caseNumber;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject)
    {
        $this->subject = $subject;
    }

    public function isCreateDate(): bool
    {
        return $this->createDate != null;
    }

    public function getCreateDate(): ?\DateTime
    {
        return $this->createDate;
    }

    public function setCreateDate(\DateTime $createDate)
    {
        $this->createDate = $createDate;
    }

    public function isModifyDate(): bool
    {
        return $this->modifyDate != null;
    }

    public function getModifyDate(): ?\DateTime
    {
        return $this->modifyDate;
    }

    public function setModifyDate(\DateTime $modifyDate)
    {
        $this->modifyDate = $modifyDate;
    }

    public function isStopDate(): bool
    {
        return $this->stopDate != null;
    }

    public function getStopDate(): ?\DateTime
    {
        return $this->stopDate;
    }

    public function setStopDate(\DateTime $stopDate)
    {
        $this->stopDate = $stopDate;
    }

    public function isLastReplyDate(): bool
    {
        return $this->lastReplyDate != null;
    }

    public function getLastReplyDate(): ?\DateTime
    {
        return $this->lastReplyDate;
    }

    public function setLastReplyDate(\DateTime $lastReplyDate)
    {
        $this->lastReplyDate = $lastReplyDate;
    }

    public function getCreatedByUserId(): string
    {
        return $this->createdByUserId;
    }

    public function setCreatedByUserId(string $createdByUserId)
    {
        $this->createdByUserId = $createdByUserId;
    }

    public function getModifiedByUserId(): string
    {
        return $this->modifiedByUserId;
    }

    public function setModifiedByUserId(string $modifiedByUserId)
    {
        $this->modifiedByUserId = $modifiedByUserId;
    }

    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    public function setOwnerId(string $ownerId)
    {
        $this->ownerId = $ownerId;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function setAccountId(string $accountId)
    {
        $this->accountId = $accountId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    public function deleted()
    {
        $this->deleted = true;
    }

    public function restored()
    {
        $this->deleted = false;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type)
    {
        $this->type = $type;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setPriority(int $priority)
    {
        $this->priority = $priority;
    }

    public function getState(): int
    {
        return $this->state;
    }

    public function setState(int $state)
    {
        $this->state = $state;
    }

    public function getCreatorType(): int
    {
        return $this->creatorType;
    }

    public function setCreatorType(int $creatorType)
    {
        $this->creatorType = $creatorType;
    }

    public function getResolution(): string
    {
        return $this->resolution;
    }

    public function setResolution(string $resolution)
    {
        $this->resolution = $resolution;
    }

    public function getWorkLog(): string
    {
        return $this->workLog;
    }

    public function setWorkLog(string $workLog)
    {
        $this->workLog = $workLog;
    }

    public function getComments(): string
    {
        return $this->comments;
    }

    public function setComments(string $comments)
    {
        $this->comments = $comments;
    }

    public function getContactCreatorId(): string
    {
        return $this->contactCreatorId;
    }

    public function setContactCreatorId(string $contactCreatorId)
    {
        $this->contactCreatorId = $contactCreatorId;
    }

    public function getSubcategory(): string
    {
        return $this->subcategory;
    }

    public function setSubcategory(string $subcategory)
    {
        $this->subcategory = $subcategory;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category)
    {
        $this->category = $category;
    }

    public function isPush(): bool
    {
        return $this->isPush;
    }

    public function setIsPush(bool $push)
    {
        $this->isPush = $push;
    }

    public function isAddHistory(): bool
    {
        return $this->addHistory;
    }

    public function setAddHistory(bool $history)
    {
        $this->addHistory = $history;
    }

    public function getMdPaymentId(): int
    {
        return $this->mdPaymentId;
    }

    public function setMdPaymentId(int $mdPaymentId)
    {
        $this->mdPaymentId = $mdPaymentId;
    }

    public function getReportsCounter(): int
    {
        return $this->reportsCounter;
    }

    public function setReportsCounter(int $reportsCounter)
    {
        $this->reportsCounter = $reportsCounter;
    }

    public function getInboundEmailboxId(): string
    {
        return $this->inboundEmailboxId;
    }

    public function setInboundEmailboxId(string $inboundEmailboxId)
    {
        $this->inboundEmailboxId = $inboundEmailboxId;
    }

    public function getInitialEmail(): string
    {
        return $this->initialEmail;
    }

    public function setInitialEmail(string $initialEmail)
    {
        $this->initialEmail = $initialEmail;
    }

    public function getCaseUpdateDraft(): string
    {
        return $this->caseUpdateDraft;
    }

    public function setCaseUpdateDraft(string $caseUpdateDraft)
    {
        $this->caseUpdateDraft = $caseUpdateDraft;
    }

    public function getNextCaseId(): string
    {
        return $this->nextCaseId;
    }

    public function setNextCaseId(string $nextCaseId)
    {
        $this->nextCaseId = $nextCaseId;
    }

    public function getSla(): CaseDefinition\Sla
    {
        return $this->sla;
    }

    public function setSla(CaseDefinition\Sla $sla)
    {
        $this->sla = $sla;
    }

    public function getYouTrack(): CaseDefinition\YouTrack
    {
        return $this->youTrack;
    }

    public function setYouTrack(CaseDefinition\YouTrack $youTrack)
    {
        $this->youTrack = $youTrack;
    }

    public function toArray(): array
    {
        return [
            'Id' => $this->getId(),
            'Subject' => $this->getSubject(),
            'CreateDate' => $this->isCreateDate() ? $this->getCreateDate()->format($this->dateFormat) : null,
            'ModifyDate' => $this->isModifyDate() ? $this->getModifyDate()->format($this->dateFormat) : null,
            'StopDate' => $this->isStopDate() ? $this->getStopDate()->format($this->dateFormat) : null,
            'LastReplyDate' => $this->getLastReplyDate() ? $this->getLastReplyDate()->format($this->dateFormat) : null,
            'CreatedByUserId' => $this->getCreatedByUserId(),
            'ModifiedByUserId' => $this->getModifiedByUserId(),
            'OwnerId' => $this->getOwnerId(),
            'AccountId' => $this->getAccountId(),
            'Description' => $this->getDescription(),
            'Deleted' => $this->isDeleted(),
            'CaseNumber' => $this->getCaseNumber(),
            'Type' => $this->getType(),
            'Status' => $this->getStatus(),
            'Priority' => $this->getPriority(),
            'Resolution' => $this->getResolution(),
            'WorkLog' => $this->getWorkLog(),
            'State' => $this->getState(),
            'ContactCreatorId' => $this->getContactCreatorId(),
            'CreatorType' => $this->getCreatorType(),
            'Subcategory' => $this->getSubcategory(),
            'Category' => $this->getCategory(),
            'IsPush' => $this->isPush(),
            'AddHistory' => $this->isAddHistory(),
            'MdPaymentId' => $this->getMdPaymentId(),
            'Comments' => $this->getComments(),
            'ReportsCounter' => $this->getReportsCounter(),
            'InboundEmailboxId' => $this->getInboundEmailboxId(),
            'InitialEmail' => $this->getInitialEmail(),
            'CaseUpdateDraft' => $this->getCaseUpdateDraft(),
            'NextCaseId' => $this->getNextCaseId(),
            'Sla' => $this->sla->toArray(),
            'YouTrack' => $this->youTrack->toArray()
        ];
    }
}
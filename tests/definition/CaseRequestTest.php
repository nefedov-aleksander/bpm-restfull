<?php
namespace Tests\Definition;

use PHPUnit\Framework\TestCase;
use BpmRestfull\Definition\CaseDefinition;
use BpmRestfull\Definition\Arrayable;
use BpmRestfull\Definition\CaseDefinition\Sla;
use BpmRestfull\Definition\CaseDefinition\YouTrack;

class CaseDefinitionTest extends TestCase
{

    public function testRequestable()
    {
        $this->assertInstanceOf(Arrayable::class, new CaseDefinition());
        $this->assertInstanceOf(Arrayable::class, new Sla());
        $this->assertInstanceOf(Arrayable::class, new YouTrack());
    }

    public function testCaseDefinitionDefaultProperties()
    {
        $case = new CaseDefinition();
        $this->assertNull($case->getId());
        $this->assertFalse($case->isCreateDate());
        $this->assertFalse($case->isModifyDate());
        $this->assertFalse($case->isStopDate());
        $this->assertFalse($case->isLastReplyDate());
        $this->assertFalse($case->isDeleted());
    }

    public function testConsts()
    {
        $this->assertEquals(CaseDefinition::CASE_TYPE_OUTSOURCING, 0);
        $this->assertEquals(CaseDefinition::CASE_TYPE_CONSULTING, 1);
        $this->assertEquals(CaseDefinition::CASE_TYPE_JURIDICAL_CONSULTING, 2);
        $this->assertEquals(CaseDefinition::CASE_TYPE_USER, 3);
        $this->assertEquals(CaseDefinition::CASE_TYPE_CONSULTATIONS, 4);
        $this->assertEquals(CaseDefinition::CASE_TYPE_TECHNICAL_SUPPORT, 5);
        $this->assertEquals(CaseDefinition::CASE_TYPE_REPORT, 6);
        $this->assertEquals(CaseDefinition::CASE_TYPE_ADMINISTRATION, 7);
        $this->assertEquals(CaseDefinition::CASE_TYPE_SERVICE, 8);
        $this->assertEquals(CaseDefinition::CASE_TYPE_SERVICE_ADMISSION, 9);
        $this->assertEquals(CaseDefinition::CASE_TYPE_MD_DEPARTMENTS, 10);
        $this->assertEquals(CaseDefinition::CASE_TYPE_UNSORT, 11);
        $this->assertEquals(CaseDefinition::CASE_TYPE_AUTO_ANSWER, 12);
        $this->assertEquals(CaseDefinition::CASE_TYPE_TRAINING, 13);
        $this->assertEquals(CaseDefinition::CASE_TYPE_EXIT_FIRST, 14);
        $this->assertEquals(CaseDefinition::CASE_TYPE_ONE_TIME, 15);
        $this->assertEquals(CaseDefinition::CASE_TYPE_SALARY, 16);
        $this->assertEquals(CaseDefinition::CASE_TYPE_BANK, 17);
        $this->assertEquals(CaseDefinition::CASE_TYPE_CACHIER, 18);
        $this->assertEquals(CaseDefinition::CASE_TYPE_SELLINGS, 19);
        $this->assertEquals(CaseDefinition::CASE_TYPE_HARD, 20);
        $this->assertEquals(CaseDefinition::CASE_TYPE_SALES, 21);
        
        $this->assertEquals(CaseDefinition::CASE_STATUS_OPEN_NEW, 1);
        $this->assertEquals(CaseDefinition::CASE_STATUS_OPEN_ASSIGNED, 2);
        $this->assertEquals(CaseDefinition::CASE_STATUS_CLOSED_CLOSED, 3);
        $this->assertEquals(CaseDefinition::CASE_STATUS_OPEN_PENDING_INPUT, 4);
        $this->assertEquals(CaseDefinition::CASE_STATUS_CLOSED_DUPLICATE, 5);
        $this->assertEquals(CaseDefinition::CASE_STATUS_CLOSED_REJECTED, 6);
        $this->assertEquals(CaseDefinition::CASE_STATUS_CLOSED_DUBLICATE, 7);
        
        $this->assertEquals(CaseDefinition::CASE_PRIORITY_HIGH, 1);
        $this->assertEquals(CaseDefinition::CASE_PRIORITY_MEDIUM, 2);
        $this->assertEquals(CaseDefinition::CASE_PRIORITY_LOW, 3);
        
        $this->assertEquals(CaseDefinition::CASE_STATE_OPEN, 1);
        $this->assertEquals(CaseDefinition::CASE_STATE_OPEN_AGAIN, 2);
        $this->assertEquals(CaseDefinition::CASE_STATE_ASSIGNED, 3);
        $this->assertEquals(CaseDefinition::CASE_STATE_IN_WORK, 4);
        $this->assertEquals(CaseDefinition::CASE_STATE_CONTACT_CLIENT, 5);
        $this->assertEquals(CaseDefinition::CASE_STATE_CLOSED, 6);
        $this->assertEquals(CaseDefinition::CASE_STATE_NOT_DELIVERED, 7);
        $this->assertEquals(CaseDefinition::CASE_STATE_NEW, 8);
        $this->assertEquals(CaseDefinition::CASE_STATE_KAYKO, 9);
        $this->assertEquals(CaseDefinition::CASE_STATE_ACCEPTED, 10);
        
        $this->assertEquals(CaseDefinition::CASE_CREATOR_TYPE_UNDEFINED, 0);
        $this->assertEquals(CaseDefinition::CASE_CREATOR_TYPE_API, 1);
        $this->assertEquals(CaseDefinition::CASE_CREATOR_TYPE_CHAT, 2);
        $this->assertEquals(CaseDefinition::CASE_CREATOR_TYPE_EMAIL, 3);
        $this->assertEquals(CaseDefinition::CASE_CREATOR_TYPE_EMPLOYEE, 4);
    }

    public function testSlaCaseDefinition()
    {
        $startDate = new \DateTime('2013-06-05 15:22:00');
        $planEndDate = new \DateTime('2022-09-05 11:32:00');
        $factEndDate = new \DateTime('2021-03-05 05:52:00');
        
        $sla = new Sla();
        
        $this->assertFalse($sla->isStartDate());
        $this->assertFalse($sla->isPlanEndDate());
        $this->assertFalse($sla->isFactEndDate());
        
        $sla->setDescription('description');
        $sla->setStartDate($startDate);
        $sla->setPlanEndDate($planEndDate);
        $sla->setFactEndDate($factEndDate);
        $sla->setWorkHours('work-hours');
        $sla->setDelay(3.6);
        
        $this->assertEquals($sla->getDescription(), 'description');
        
        $this->assertTrue($sla->isStartDate());
        $this->assertEquals($sla->getStartDate()->getTimestamp(), $startDate->getTimestamp());
        $this->assertTrue($sla->isPlanEndDate());
        $this->assertEquals($sla->getPlanEndDate()->getTimestamp(), $planEndDate->getTimestamp());
        $this->assertTrue($sla->isFactEndDate());
        $this->assertEquals($sla->getFactEndDate()->getTimestamp(), $factEndDate->getTimestamp());
        $this->assertEquals($sla->getWorkHours(), 'work-hours');
        $this->assertEquals($sla->getDelay(), 3.6);
        
        
        $formater = new \BpmRestfull\Formater\Json();
        
        $this->assertEquals($formater->format($sla), '{"SlaDescription":"description","SlaStartDate":"2013-06-05T15:22:00","SlaPlanEndDate":"2022-09-05T11:32:00","SlaFactEndDate":"2021-03-05T05:52:00","SlaWorkHours":"work-hours","SlaDelay":3.6}');
        
        $sla = new Sla();
        $sla->setDescription('desc');
        $sla->setWorkHours('hours');
        $this->assertEquals($formater->format($sla), '{"SlaDescription":"desc","SlaStartDate":null,"SlaPlanEndDate":null,"SlaFactEndDate":null,"SlaWorkHours":"hours","SlaDelay":0}');
    }

    public function testYouTrackCaseDefinition()
    {
        $youTrack = new YouTrack();
        $youTrack->setYouTrackCreateUrl('http://create.url');
        $youTrack->setYouTrackUrl('http://track.url');
        $youTrack->setNewTaskUrl('http://task.url');
        $youTrack->setYouTrackIssue('issue');
        $youTrack->setYouTrackIssueSubsystem('subsystem');
        $youTrack->setYouTrackIssuePriority('priority');
        $youTrack->setYouTrackIssueType('type');
        $youTrack->setHasYouTrackIssue(true);
        
        $this->assertEquals($youTrack->getYouTrackCreateUrl(), 'http://create.url');
        $this->assertEquals($youTrack->getYouTrackUrl(), 'http://track.url');
        $this->assertEquals($youTrack->getNewTaskUrl(), 'http://task.url');
        $this->assertEquals($youTrack->getYouTrackIssue(), 'issue');
        $this->assertEquals($youTrack->getYouTrackIssueSubsystem(), 'subsystem');
        $this->assertEquals($youTrack->getYouTrackIssuePriority(), 'priority');
        $this->assertEquals($youTrack->getYouTrackIssueType(), 'type');
        $this->assertTrue($youTrack->isHasYouTrackIssue());
        
        $formater = new \BpmRestfull\Formater\Json();
        
        $this->assertEquals($formater->format($youTrack), '{"YouTrackCreateUrl":"http:\/\/create.url","YouTrackUrl":"http:\/\/track.url","NewTaskUrl":"http:\/\/task.url","YouTrackIssue":"issue","YouTrackIssueSubsystem":"subsystem","YouTrackIssuePriority":"priority","YouTrackIssueType":"type","HasYouTrackIssue":true}');
    }

    public function testCaseDefinition()
    {
        $createDate = new \DateTime('2000-01-01 00:12:56');
        $modifyDate = new \DateTime('2015-05-01 03:55:56');
        $stopDate = new \DateTime('2001-08-05 10:11:00');
        $lastReplyDate = new \DateTime('2011-08-05 15:22:00');
        
        
        $case = new CaseDefinition();
        $case->setId('test');
        $case->setSubject('subject');
        $case->setCaseNumber(123);
        $case->setCreateDate($createDate);
        $case->setModifyDate($modifyDate);
        $case->setStopDate($stopDate);
        $case->setLastReplyDate($lastReplyDate);
        $case->setCreatedByUserId('created-by-user-id');
        $case->setModifiedByUserId('modified-by-user-id');
        $case->setOwnerId('owner-id');
        $case->setAccountId('account-id');
        $case->setDescription('description');
        $case->setType(CaseDefinition::CASE_TYPE_HARD);
        $case->setStatus(CaseDefinition::CASE_STATUS_OPEN_ASSIGNED);
        $case->setPriority(CaseDefinition::CASE_PRIORITY_LOW);
        $case->setState(CaseDefinition::CASE_STATE_ACCEPTED);
        $case->setCreatorType(CaseDefinition::CASE_CREATOR_TYPE_API);
        $case->setResolution('resolution');
        $case->setWorkLog('work-log');
        $case->setComments('comments');
        $case->setContactCreatorId('contact-creator-id');
        $case->setSubcategory('12');
        $case->setCategory('3');
        $case->setMdPaymentId(35);
        $case->setReportsCounter(2);
        $case->setInboundEmailboxId('inbound-emailbox-id');
        $case->setInitialEmail('initial-email');
        $case->setCaseUpdateDraft('case-update-draft');
        $case->setNextCaseId('next-case-id');
        
        
        $this->assertEquals($case->getId(), 'test');
        $this->assertEquals($case->getCaseNumber(), 123);
        $this->assertEquals($case->getSubject(), 'subject');
        
        $this->assertTrue($case->isCreateDate());
        $this->assertEquals($case->getCreateDate()->getTimestamp(), $createDate->getTimestamp());
        
        $this->assertTrue($case->isModifyDate());
        $this->assertEquals($case->getModifyDate()->getTimestamp(), $modifyDate->getTimestamp());
        
        $this->assertTrue($case->isStopDate());
        $this->assertEquals($case->getStopDate()->getTimestamp(), $stopDate->getTimestamp());
        
        $this->assertTrue($case->isLastReplyDate());
        $this->assertEquals($case->getLastReplyDate()->getTimestamp(), $lastReplyDate->getTimestamp());
        
        $this->assertEquals($case->getCreatedByUserId(), 'created-by-user-id');
        $this->assertEquals($case->getModifiedByUserId(), 'modified-by-user-id');
        $this->assertEquals($case->getOwnerId(), 'owner-id');
        $this->assertEquals($case->getAccountId(), 'account-id');
        $this->assertEquals($case->getDescription(), 'description');
        $this->assertEquals($case->getType(), CaseDefinition::CASE_TYPE_HARD);
        $this->assertEquals($case->getStatus(), CaseDefinition::CASE_STATUS_OPEN_ASSIGNED);
        $this->assertEquals($case->getPriority(), CaseDefinition::CASE_PRIORITY_LOW);
        $this->assertEquals($case->getState(), CaseDefinition::CASE_STATE_ACCEPTED);
        $this->assertEquals($case->getCreatorType(), CaseDefinition::CASE_CREATOR_TYPE_API);
        $this->assertEquals($case->getResolution(), 'resolution');
        $this->assertEquals($case->getWorkLog(), 'work-log');
        $this->assertEquals($case->getComments(), 'comments');
        $this->assertEquals($case->getContactCreatorId(), 'contact-creator-id');
        $this->assertEquals($case->getSubcategory(), '12');
        $this->assertEquals($case->getCategory(), '3');
        $this->assertEquals($case->getMdPaymentId(), 35);
        $this->assertEquals($case->getReportsCounter(), 2);
        $this->assertEquals($case->getInboundEmailboxId(), 'inbound-emailbox-id');
        $this->assertEquals($case->getInitialEmail(), 'initial-email');
        $this->assertEquals($case->getCaseUpdateDraft(), 'case-update-draft');
        $this->assertEquals($case->getNextCaseId(), 'next-case-id');
        
        $case->deleted();
        $this->assertTrue($case->isDeleted());
        $case->restored();
        $this->assertFalse($case->isDeleted());
        
        $case->setIsPush(true);
        $this->assertTrue($case->isPush());
        $case->setIsPush(false);
        $this->assertFalse($case->isPush());
        
        $case->setAddHistory(true);
        $this->assertTrue($case->isAddHistory());
        $case->setAddHistory(false);
        $this->assertFalse($case->isAddHistory());
    }
    
    public function testCaseDefinitionFormater()
    {        
        $case = new CaseDefinition();
        $case->setId('test');
        $case->setSubject('subject');
        $case->setCaseNumber(123);
        $case->setCreateDate(new \DateTime('2000-01-01 00:12:56'));
        $case->setModifyDate(new \DateTime('2015-05-01 03:55:56'));
        $case->setStopDate(new \DateTime('2001-08-05 10:11:00'));
        $case->setLastReplyDate(new \DateTime('2011-08-05 15:22:00'));
        $case->setCreatedByUserId('created-by-user-id');
        $case->setModifiedByUserId('modified-by-user-id');
        $case->setOwnerId('owner-id');
        $case->setAccountId('account-id');
        $case->setDescription('description');
        $case->setType(CaseDefinition::CASE_TYPE_HARD);
        $case->setStatus(CaseDefinition::CASE_STATUS_OPEN_ASSIGNED);
        $case->setPriority(CaseDefinition::CASE_PRIORITY_LOW);
        $case->setState(CaseDefinition::CASE_STATE_ACCEPTED);
        $case->setCreatorType(CaseDefinition::CASE_CREATOR_TYPE_API);
        $case->setResolution('resolution');
        $case->setWorkLog('work-log');
        $case->setComments('comments');
        $case->setContactCreatorId('contact-creator-id');
        $case->setSubcategory('12');
        $case->setCategory('3');
        $case->setMdPaymentId(35);
        $case->setReportsCounter(2);
        $case->setInboundEmailboxId('inbound-emailbox-id');
        $case->setInitialEmail('initial-email');
        $case->setCaseUpdateDraft('case-update-draft');
        $case->setNextCaseId('next-case-id');
        
        $actual = [
            '"Id":"test"',
            '"Subject":"subject"',
            '"CreateDate":"2000-01-01T00:12:56"',
            '"ModifyDate":"2015-05-01T03:55:56"',
            '"StopDate":"2001-08-05T10:11:00"',
            '"LastReplyDate":"2011-08-05T15:22:00"',
            '"CreatedByUserId":"created-by-user-id"',
            '"ModifiedByUserId":"modified-by-user-id"',
            '"OwnerId":"owner-id"',
            '"AccountId":"account-id"',
            '"Description":"description"',
            '"Deleted":false',
            '"CaseNumber":123',
            '"Type":20',
            '"Status":2',
            '"Priority":3',
            '"Resolution":"resolution"',
            '"WorkLog":"work-log"',
            '"State":10',
            '"ContactCreatorId":"contact-creator-id"',
            '"CreatorType":1',
            '"Subcategory":"12"',
            '"Category":"3"',
            '"IsPush":false',
            '"AddHistory":false',
            '"MdPaymentId":35',
            '"Comments":"comments"',
            '"ReportsCounter":2',
            '"InboundEmailboxId":"inbound-emailbox-id"',
            '"InitialEmail":"initial-email"',
            '"CaseUpdateDraft":"case-update-draft"',
            '"NextCaseId":"next-case-id"',
            '"Sla":{"SlaDescription":"","SlaStartDate":null,"SlaPlanEndDate":null,"SlaFactEndDate":null,"SlaWorkHours":"","SlaDelay":0}',
            '"YouTrack":{"YouTrackCreateUrl":"","YouTrackUrl":"","NewTaskUrl":"","YouTrackIssue":"","YouTrackIssueSubsystem":"","YouTrackIssuePriority":"","YouTrackIssueType":"","HasYouTrackIssue":false}'
        ];
        
        $formater = new \BpmRestfull\Formater\Json();
        
        $this->assertEquals($formater->format($case), sprintf('{%s}', implode(',', $actual)));
        
        
        $sla = new Sla();
        $sla->setDescription('desc');
        $sla->setStartDate(new \DateTime('2013-06-05 15:22:00'));
        $sla->setPlanEndDate(new \DateTime('2022-09-05 11:32:00'));
        $sla->setFactEndDate(new \DateTime('2021-03-05 05:52:00'));
        $sla->setWorkHours('hours');
        $sla->setDelay(2.2);
        
        $case->setSla($sla);
        
        $youTrack = new YouTrack();
        $youTrack->setYouTrackCreateUrl('http://create.url');
        $youTrack->setYouTrackUrl('http://track.url');
        $youTrack->setNewTaskUrl('http://task.url');
        $youTrack->setYouTrackIssue('issue');
        $youTrack->setYouTrackIssueSubsystem('subsystem');
        $youTrack->setYouTrackIssuePriority('priority');
        $youTrack->setYouTrackIssueType('type');
        $youTrack->setHasYouTrackIssue(true);
        
        $case->setYouTrack($youTrack);
        
        $actual = [
            '"Id":"test"',
            '"Subject":"subject"',
            '"CreateDate":"2000-01-01T00:12:56"',
            '"ModifyDate":"2015-05-01T03:55:56"',
            '"StopDate":"2001-08-05T10:11:00"',
            '"LastReplyDate":"2011-08-05T15:22:00"',
            '"CreatedByUserId":"created-by-user-id"',
            '"ModifiedByUserId":"modified-by-user-id"',
            '"OwnerId":"owner-id"',
            '"AccountId":"account-id"',
            '"Description":"description"',
            '"Deleted":false',
            '"CaseNumber":123',
            '"Type":20',
            '"Status":2',
            '"Priority":3',
            '"Resolution":"resolution"',
            '"WorkLog":"work-log"',
            '"State":10',
            '"ContactCreatorId":"contact-creator-id"',
            '"CreatorType":1',
            '"Subcategory":"12"',
            '"Category":"3"',
            '"IsPush":false',
            '"AddHistory":false',
            '"MdPaymentId":35',
            '"Comments":"comments"',
            '"ReportsCounter":2',
            '"InboundEmailboxId":"inbound-emailbox-id"',
            '"InitialEmail":"initial-email"',
            '"CaseUpdateDraft":"case-update-draft"',
            '"NextCaseId":"next-case-id"',
            '"Sla":{"SlaDescription":"desc","SlaStartDate":"2013-06-05T15:22:00","SlaPlanEndDate":"2022-09-05T11:32:00","SlaFactEndDate":"2021-03-05T05:52:00","SlaWorkHours":"hours","SlaDelay":2.2}',
            '"YouTrack":{"YouTrackCreateUrl":"http:\/\/create.url","YouTrackUrl":"http:\/\/track.url","NewTaskUrl":"http:\/\/task.url","YouTrackIssue":"issue","YouTrackIssueSubsystem":"subsystem","YouTrackIssuePriority":"priority","YouTrackIssueType":"type","HasYouTrackIssue":true}'
        ];
        
        $formater = new \BpmRestfull\Formater\Json();
        
        $this->assertEquals($formater->format($case), sprintf('{%s}', implode(',', $actual)));
    }
    
    public function testLoadFromArray()
    {
        $case = CaseDefinition::createFromArray([
            'id' => '7c4f352b-02a7-6f82-d0a4-5cdad31bcb15'
        ]);
        $this->assertEquals($case->getId(), '7c4f352b-02a7-6f82-d0a4-5cdad31bcb15');
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getSubject(), '');
        $case = CaseDefinition::createFromArray([
            'name' => 'Subject'
        ]);
        $this->assertEquals($case->getSubject(), 'Subject');
        
        
        $this->assertFalse(CaseDefinition::createFromArray([])->isCreateDate());
        $case = CaseDefinition::createFromArray([
            'date_entered' => '2013-06-05 15:22:00'
        ]);
        $this->assertTrue($case->isCreateDate());
        $this->assertEquals($case->getCreateDate()->getTimestamp(), (new \DateTime('2013-06-05 15:22:00'))->getTimestamp());
        
        
        $this->assertFalse(CaseDefinition::createFromArray([])->isModifyDate());
        $case = CaseDefinition::createFromArray([
            'date_modified' => '2013-06-05 15:22:23'
        ]);
        $this->assertTrue($case->isModifyDate());
        $this->assertEquals($case->getModifyDate()->getTimestamp(), (new \DateTime('2013-06-05 15:22:23'))->getTimestamp());
        
        
        $this->assertFalse(CaseDefinition::createFromArray([])->isStopDate());
        $case = CaseDefinition::createFromArray([
            'date_stop' => '2011-02-05 15:10:23'
        ]);
        $this->assertTrue($case->isStopDate());
        $this->assertEquals($case->getStopDate()->getTimestamp(), (new \DateTime('2011-02-05 15:10:23'))->getTimestamp());
        
        
        $this->assertFalse(CaseDefinition::createFromArray([])->isLastReplyDate());
        $case = CaseDefinition::createFromArray([
            'last_reply_date' => '2001-02-09 00:10:23'
        ]);
        $this->assertTrue($case->isLastReplyDate());
        $this->assertEquals($case->getLastReplyDate()->getTimestamp(), (new \DateTime('2001-02-09 00:10:23'))->getTimestamp());
        
        
        
        
        
        
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getModifiedByUserId(), '');
        $case = CaseDefinition::createFromArray([
            'modified_user_id' => '7c4f352b-02a7-6f82-d0a4'
        ]);
        $this->assertEquals($case->getModifiedByUserId(), '7c4f352b-02a7-6f82-d0a4');
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getCreatedByUserId(), '');
        $case = CaseDefinition::createFromArray([
            'created_by' => '7c4f352b-02a7-6f82'
        ]);
        $this->assertEquals($case->getCreatedByUserId(), '7c4f352b-02a7-6f82');
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getDescription(), '');
        $case = CaseDefinition::createFromArray([
            'description' => 'description'
        ]);
        $this->assertEquals($case->getDescription(), 'description');
        
        
        
        $this->assertFalse(CaseDefinition::createFromArray([])->isDeleted());
        $case = CaseDefinition::createFromArray([
            'deleted' => false
        ]);
        $this->assertFalse($case->isDeleted());
        $case = CaseDefinition::createFromArray([
            'deleted' => true
        ]);
        $this->assertTrue($case->isDeleted());
        
        $this->assertFalse(CaseDefinition::createFromArray([])->isPush());
        $case = CaseDefinition::createFromArray([
            'assigned_user_push' => false
        ]);
        $this->assertFalse($case->isPush());
        $case = CaseDefinition::createFromArray([
            'assigned_user_push' => true
        ]);
        $this->assertTrue($case->isPush());
        
        $this->assertFalse(CaseDefinition::createFromArray([])->isAddHistory());
        $case = CaseDefinition::createFromArray([
            'add_history' => false
        ]);
        $this->assertFalse($case->isAddHistory());
        $case = CaseDefinition::createFromArray([
            'add_history' => true
        ]);
        $this->assertTrue($case->isAddHistory());
        
        
        
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getOwnerId(), '');
        $case = CaseDefinition::createFromArray([
            'assigned_user_id' => '7c4f352b-02a7'
        ]);
        $this->assertEquals($case->getOwnerId(), '7c4f352b-02a7');
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getAccountId(), '');
        $case = CaseDefinition::createFromArray([
            'account_id' => '7c4f352b-02a7-21434'
        ]);
        $this->assertEquals($case->getAccountId(), '7c4f352b-02a7-21434');
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getContactCreatorId(), '');
        $case = CaseDefinition::createFromArray([
            'contact_created_by_id' => '7c4f352b-02a7-21434-11111'
        ]);
        $this->assertEquals($case->getContactCreatorId(), '7c4f352b-02a7-21434-11111');
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getInboundEmailboxId(), '');
        $case = CaseDefinition::createFromArray([
            'selected_inbound_emailbox_id' => '7c4f352b-02a7-21434-11111-d443lk'
        ]);
        $this->assertEquals($case->getInboundEmailboxId(), '7c4f352b-02a7-21434-11111-d443lk');
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getNextCaseId(), '');
        $case = CaseDefinition::createFromArray([
            'next_case_id' => '7c4f352b-02a7-21434-11111-d443lk-7sdf'
        ]);
        $this->assertEquals($case->getNextCaseId(), '7c4f352b-02a7-21434-11111-d443lk-7sdf');
        
        
        $case = CaseDefinition::createFromArray([
            'case_number' => 654760
        ]);
        $this->assertEquals($case->getCaseNumber(), 654760);
        
        
        $types = [
            'outsourcing' => CaseDefinition::CASE_TYPE_OUTSOURCING,
            'consulting' => CaseDefinition::CASE_TYPE_CONSULTING,
            'JuridicalConsulting' => CaseDefinition::CASE_TYPE_JURIDICAL_CONSULTING,
            'User' => CaseDefinition::CASE_TYPE_USER,
            'Consultations' => CaseDefinition::CASE_TYPE_CONSULTATIONS,
            'technical_support' => CaseDefinition::CASE_TYPE_TECHNICAL_SUPPORT,
            'Report' => CaseDefinition::CASE_TYPE_REPORT,
            'Administration' => CaseDefinition::CASE_TYPE_ADMINISTRATION,
            'Service' => CaseDefinition::CASE_TYPE_SERVICE,
            'service_admission' => CaseDefinition::CASE_TYPE_SERVICE_ADMISSION,
            'MDDepartments' => CaseDefinition::CASE_TYPE_MD_DEPARTMENTS,
            'unsort' => CaseDefinition::CASE_TYPE_UNSORT,
            'AutoAnswer' => CaseDefinition::CASE_TYPE_AUTO_ANSWER,
            'Training' => CaseDefinition::CASE_TYPE_TRAINING,
            'exitfirst' => CaseDefinition::CASE_TYPE_EXIT_FIRST,
            'onetime' => CaseDefinition::CASE_TYPE_ONE_TIME,
            'salary' => CaseDefinition::CASE_TYPE_SALARY,
            'bank' => CaseDefinition::CASE_TYPE_BANK,
            'cachier' => CaseDefinition::CASE_TYPE_CACHIER,
            'sellings' => CaseDefinition::CASE_TYPE_SELLINGS,
            'hard' => CaseDefinition::CASE_TYPE_HARD,
            'Sales' => CaseDefinition::CASE_TYPE_SALES
        ];
        
        foreach ($types as $type => $actual) {
            $case = CaseDefinition::createFromArray([
                'type' => $type
            ]);
            $this->assertEquals($case->getType(), $actual);
        }

        
        $states = [
            'New' => CaseDefinition::CASE_STATE_NEW,
            'Kayko' => CaseDefinition::CASE_STATE_KAYKO,
            'Open' => CaseDefinition::CASE_STATE_OPEN,
            'OpenAgain' => CaseDefinition::CASE_STATE_OPEN_AGAIN,
            'Assigned' => CaseDefinition::CASE_STATE_ASSIGNED,
            'InWork' => CaseDefinition::CASE_STATE_IN_WORK,
            'Accepted' => CaseDefinition::CASE_STATE_ACCEPTED,
            'ContactClient' => CaseDefinition::CASE_STATE_CONTACT_CLIENT,
            'Closed' => CaseDefinition::CASE_STATE_CLOSED,
            'NotDelivered' => CaseDefinition::CASE_STATE_NOT_DELIVERED
        ];
        
        foreach ($states as $state => $actual) {
            $case = CaseDefinition::createFromArray([
                'state' => $state
            ]);
            
            $this->assertEquals($case->getState(), $actual);
        }
        
        $priorities = [
            'P1' => CaseDefinition::CASE_PRIORITY_HIGH,
            'P2' => CaseDefinition::CASE_PRIORITY_MEDIUM,
            'P3' => CaseDefinition::CASE_PRIORITY_LOW
        ];
        
        foreach ($priorities as $priority => $actual) {
            $case = CaseDefinition::createFromArray([
                'priority' => $priority
            ]);
            
            $this->assertEquals($case->getPriority(), $actual);
        }
        
        $statuses = [
            'Open_New' => CaseDefinition::CASE_STATUS_OPEN_NEW,
            'Open_Assigned' => CaseDefinition::CASE_STATUS_OPEN_ASSIGNED,
            'Closed_Closed' => CaseDefinition::CASE_STATUS_CLOSED_CLOSED,
            'Open_Pending Input' => CaseDefinition::CASE_STATUS_OPEN_PENDING_INPUT,
            'Closed_Duplicate' => CaseDefinition::CASE_STATUS_CLOSED_DUPLICATE,
            'Closed_Rejected' => CaseDefinition::CASE_STATUS_CLOSED_REJECTED,
            'Closed_Duplicate_1' => CaseDefinition::CASE_STATUS_CLOSED_DUBLICATE
        ];
        
        foreach ($statuses as $status => $actual) {
            $case = CaseDefinition::createFromArray([
                'status' => $status
            ]);
            
            $this->assertEquals($case->getStatus(), $actual);
        }
        
        
        $creatorTypes = [
            'API' => CaseDefinition::CASE_CREATOR_TYPE_API,
            'Chat' => CaseDefinition::CASE_CREATOR_TYPE_CHAT,
            'Email' => CaseDefinition::CASE_CREATOR_TYPE_EMAIL,
            'Employee' => CaseDefinition::CASE_CREATOR_TYPE_EMPLOYEE
        ];
        
        foreach ($creatorTypes as $type => $actual) {
            $case = CaseDefinition::createFromArray([
                'create_by_type' => $type
            ]);
            
            $this->assertEquals($case->getCreatorType(), $actual);
        }
        
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getResolution(), '');
        $case = CaseDefinition::createFromArray([
            'resolution' => 'resolution resolution'
        ]);
        $this->assertEquals($case->getResolution(), 'resolution resolution');
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getWorkLog(), '');
        $case = CaseDefinition::createFromArray([
            'work_log' => 'work_log work_log'
        ]);
        $this->assertEquals($case->getWorkLog(), 'work_log work_log');
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getComments(), '');
        $case = CaseDefinition::createFromArray([
            'comments' => 'comments comments'
        ]);
        $this->assertEquals($case->getComments(), 'comments comments');
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getSubcategory(), '');
        $case = CaseDefinition::createFromArray([
            'subcategory_of_the_query' => 'subcategory_of_the_query subcategory_of_the_query'
        ]);
        $this->assertEquals($case->getSubcategory(), 'subcategory_of_the_query subcategory_of_the_query');
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getCategory(), '');
        $case = CaseDefinition::createFromArray([
            'basic_request_category' => 'basic_request_category basic_request_category'
        ]);
        $this->assertEquals($case->getCategory(), 'basic_request_category basic_request_category');
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getInitialEmail(), '');
        $case = CaseDefinition::createFromArray([
            'initial_email' => 'initial_email@initial_email.ru'
        ]);
        $this->assertEquals($case->getInitialEmail(), 'initial_email@initial_email.ru');
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getCaseUpdateDraft(), '');
        $case = CaseDefinition::createFromArray([
            'case_update_draft' => 'case_update_draft case_update_draft'
        ]);
        $this->assertEquals($case->getCaseUpdateDraft(), 'case_update_draft case_update_draft');
        
        
        $case = CaseDefinition::createFromArray([
            'md_payment_id_c' => 46
        ]);
        $this->assertEquals($case->getMdPaymentId(), 46);
        
        
        $this->assertEquals(CaseDefinition::createFromArray([])->getReportsCounter(), 0);
        $case = CaseDefinition::createFromArray([
            'case_counter_line' => 7
        ]);
        $this->assertEquals($case->getReportsCounter(), 7);
        
        
        
        
        
        $case = CaseDefinition::createFromArray([
            'sla_description' => 'sla_description sla_description'
        ]);
        $this->assertEquals($case->getSla()->getDescription(), 'sla_description sla_description');
        
        $case = CaseDefinition::createFromArray([
            'sla_work_hours' => 'sla_work_hours sla_work_hours'
        ]);
        $this->assertEquals($case->getSla()->getWorkHours(), 'sla_work_hours sla_work_hours');
        
        $case = CaseDefinition::createFromArray([
            'sla_delay' => 4.7
        ]);
        $this->assertEquals($case->getSla()->getDelay(), 4.7);
        
        $case = CaseDefinition::createFromArray([
            'sla_date_start' => '2000-01-01 00:10:23'
        ]);
        $this->assertTrue($case->getSla()->isStartDate());
        $this->assertEquals($case->getSla()->getStartDate()->getTimestamp(), (new \DateTime('2000-01-01 00:10:23'))->getTimestamp());
        
        $case = CaseDefinition::createFromArray([
            'sla_date_end_plan' => '2000-01-01 00:00:00'
        ]);
        $this->assertTrue($case->getSla()->isPlanEndDate());
        $this->assertEquals($case->getSla()->getPlanEndDate()->getTimestamp(), (new \DateTime('2000-01-01 00:00:00'))->getTimestamp());

        $case = CaseDefinition::createFromArray([
            'sla_date_end_fact' => '2010-01-01 12:00:10'
        ]);
        $this->assertTrue($case->getSla()->isFactEndDate());
        $this->assertEquals($case->getSla()->getFactEndDate()->getTimestamp(), (new \DateTime('2010-01-01 12:00:10'))->getTimestamp());
        
        
        
        
        $case = CaseDefinition::createFromArray([
            'youtrack_create' => 'http://create.url'
        ]);
        $this->assertEquals($case->getYouTrack()->getYouTrackCreateUrl(), 'http://create.url');
        
        $case = CaseDefinition::createFromArray([
            'youtrack_c' => 'http://you.url'
        ]);
        $this->assertEquals($case->getYouTrack()->getYouTrackUrl(), 'http://you.url');
        
        $case = CaseDefinition::createFromArray([
            'new_ts_c' => 'http://new.url'
        ]);
        $this->assertEquals($case->getYouTrack()->getNewTaskUrl(), 'http://new.url');
        
        $case = CaseDefinition::createFromArray([
            'youtrack_issue_c' => 'issue'
        ]);
        $this->assertEquals($case->getYouTrack()->getYouTrackIssue(), 'issue');
        
        $case = CaseDefinition::createFromArray([
            'youtrack_issue_subsystem_c' => 'subsystem'
        ]);
        $this->assertEquals($case->getYouTrack()->getYouTrackIssueSubsystem(), 'subsystem');
        
        $case = CaseDefinition::createFromArray([
            'youtrack_issue_priority_c' => 'priority'
        ]);
        $this->assertEquals($case->getYouTrack()->getYouTrackIssuePriority(), 'priority');
        
        $case = CaseDefinition::createFromArray([
            'youtrack_issue_type_c' => 'type'
        ]);
        $this->assertEquals($case->getYouTrack()->getYouTrackIssueType(), 'type');
        
        $case = CaseDefinition::createFromArray([
            'has_youtrack_issue_c' => 1
        ]);
        $this->assertTrue($case->getYouTrack()->isHasYouTrackIssue());
        
        
        
        
        
        $case = CaseDefinition::createFromArray([
            'id' => '7c4f352b-02a7-6f82-d0a4-5cdad31bcb15',
            'name' => 'Subject',
            'date_entered' => '2013-06-05 15:22:00',
            'date_modified' => '2013-06-05 15:22:23',
            'date_stop' => '2011-02-05 15:10:23',
            'last_reply_date' => '2001-02-09 00:10:23',
            'modified_user_id' => '7c4f352b-02a7-6f82-d0a4',
            'created_by' => '7c4f352b-02a7-6f82',
            'description' => 'description',
            'deleted' => 1,
            'assigned_user_push' => 1,
            'add_history' => 1,
            'assigned_user_id' => '7c4f352b-02a7',
            'account_id' => '7c4f352b-02a7-21434',
            'contact_created_by_id' => '7c4f352b-02a7-21434-11111',
            'selected_inbound_emailbox_id' => '7c4f352b-02a7-21434-11111-d443lk',
            'next_case_id' => '7c4f352b-02a7-21434-11111-d443lk-7sdf',
            'case_number' => 654760,
            'resolution' => 'resolution resolution',
            'work_log' => 'work_log work_log',
            'comments' => 'comments comments',
            'subcategory_of_the_query' => 'subcategory_of_the_query subcategory_of_the_query',
            'basic_request_category' => 'basic_request_category basic_request_category',
            'initial_email' => 'initial_email@initial_email.ru',
            'case_update_draft' => 'case_update_draft case_update_draft',
            'md_payment_id_c' => 46,
            'case_counter_line' => 7,
            'sla_description' => 'sla_description sla_description',
            'sla_work_hours' => 'sla_work_hours sla_work_hours',
            'sla_delay' => 4.7,
            'sla_date_start' => '2000-01-01 00:10:23',
            'sla_date_end_plan' => '2000-01-01 00:00:00',
            'sla_date_end_fact' => '2010-01-01 12:00:10',
            'youtrack_create' => 'http://create.url',
            'youtrack_c' => 'http://you.url',
            'new_ts_c' => 'http://new.url',
            'youtrack_issue_c' => 'issue',
            'youtrack_issue_subsystem_c' => 'subsystem',
            'youtrack_issue_priority_c' => 'priority',
            'youtrack_issue_type_c' => 'type',
            'has_youtrack_issue_c' => 1
        ]);
        
        $this->assertEquals($case->getId(), '7c4f352b-02a7-6f82-d0a4-5cdad31bcb15');
        $this->assertEquals($case->getSubject(), 'Subject');
        $this->assertTrue($case->isCreateDate());
        $this->assertEquals($case->getCreateDate()->getTimestamp(), (new \DateTime('2013-06-05 15:22:00'))->getTimestamp());
        $this->assertTrue($case->isModifyDate());
        $this->assertEquals($case->getModifyDate()->getTimestamp(), (new \DateTime('2013-06-05 15:22:23'))->getTimestamp());
        $this->assertTrue($case->isStopDate());
        $this->assertEquals($case->getStopDate()->getTimestamp(), (new \DateTime('2011-02-05 15:10:23'))->getTimestamp());
        $this->assertTrue($case->isLastReplyDate());
        $this->assertEquals($case->getLastReplyDate()->getTimestamp(), (new \DateTime('2001-02-09 00:10:23'))->getTimestamp());
        $this->assertEquals($case->getModifiedByUserId(), '7c4f352b-02a7-6f82-d0a4');
        $this->assertEquals($case->getCreatedByUserId(), '7c4f352b-02a7-6f82');
        $this->assertEquals($case->getDescription(), 'description');
        $this->assertTrue($case->isDeleted());
        $this->assertTrue($case->isPush());
        $this->assertTrue($case->isAddHistory());
        $this->assertEquals($case->getOwnerId(), '7c4f352b-02a7');
        $this->assertEquals($case->getAccountId(), '7c4f352b-02a7-21434');
        $this->assertEquals($case->getContactCreatorId(), '7c4f352b-02a7-21434-11111');
        $this->assertEquals($case->getInboundEmailboxId(), '7c4f352b-02a7-21434-11111-d443lk');
        $this->assertEquals($case->getNextCaseId(), '7c4f352b-02a7-21434-11111-d443lk-7sdf');
        $this->assertEquals($case->getCaseNumber(), 654760);
        $this->assertEquals($case->getResolution(), 'resolution resolution');
        $this->assertEquals($case->getWorkLog(), 'work_log work_log');
        $this->assertEquals($case->getComments(), 'comments comments');
        $this->assertEquals($case->getSubcategory(), 'subcategory_of_the_query subcategory_of_the_query');
        $this->assertEquals($case->getCategory(), 'basic_request_category basic_request_category');
        $this->assertEquals($case->getInitialEmail(), 'initial_email@initial_email.ru');
        $this->assertEquals($case->getCaseUpdateDraft(), 'case_update_draft case_update_draft');
        $this->assertEquals($case->getMdPaymentId(), 46);
        $this->assertEquals($case->getReportsCounter(), 7);
        $this->assertEquals($case->getSla()->getDescription(), 'sla_description sla_description');
        $this->assertEquals($case->getSla()->getWorkHours(), 'sla_work_hours sla_work_hours');
        $this->assertEquals($case->getSla()->getDelay(), 4.7);
        $this->assertTrue($case->getSla()->isStartDate());
        $this->assertEquals($case->getSla()->getStartDate()->getTimestamp(), (new \DateTime('2000-01-01 00:10:23'))->getTimestamp());
        $this->assertTrue($case->getSla()->isPlanEndDate());
        $this->assertEquals($case->getSla()->getPlanEndDate()->getTimestamp(), (new \DateTime('2000-01-01 00:00:00'))->getTimestamp());
        $this->assertTrue($case->getSla()->isFactEndDate());
        $this->assertEquals($case->getSla()->getFactEndDate()->getTimestamp(), (new \DateTime('2010-01-01 12:00:10'))->getTimestamp());
        $this->assertEquals($case->getYouTrack()->getYouTrackCreateUrl(), 'http://create.url');
        $this->assertEquals($case->getYouTrack()->getYouTrackUrl(), 'http://you.url');
        $this->assertEquals($case->getYouTrack()->getNewTaskUrl(), 'http://new.url');
        $this->assertEquals($case->getYouTrack()->getYouTrackIssue(), 'issue');
        $this->assertEquals($case->getYouTrack()->getYouTrackIssueSubsystem(), 'subsystem');
        $this->assertEquals($case->getYouTrack()->getYouTrackIssuePriority(), 'priority');
        $this->assertEquals($case->getYouTrack()->getYouTrackIssueType(), 'type');
        $this->assertTrue($case->getYouTrack()->isHasYouTrackIssue());
        
    }
}
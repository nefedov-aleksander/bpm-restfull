<?php
namespace Tests\Client;

use PHPUnit\Framework\TestCase;
use BpmRestfull\Request\CaseCreateRequest;
use BpmRestfull\Formater\Json;
use BpmRestfull\Request\CaseUpdateRequest;
use BpmRestfull\Request\CaseGetRequest;
use BpmRestfull\Request\CaseDeleteRequest;

class CaseClientTest extends TestCase
{
    private function case() 
    {
        return \BpmRestfull\Definition\CaseDefinition::createFromArray([
            'id' => null,
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
            'next_case_id' => '7c4f352b-02a7-21434-11111',
            'case_number' => 654722,
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
            'has_youtrack_issue_c' => 1,
            'type' => 'service_admission',
            'state' => 'OpenAgain',
            'priority' => 'P2',
            'status' => 'Open_Assigned',
            'create_by_type' => 'API'
        ]);
    }
    
    public function testCreate()
    {        
        $request = new CaseCreateRequest('http://org.moedelo.bpm.casedocs:55591/bpm/casedocs/V2/Case', $this->case(), new Json());
        
        $this->assertEquals($request->getMethod(), 'POST');
        $this->assertEquals($request->getUri(), 'http://org.moedelo.bpm.casedocs:55591/bpm/casedocs/V2/Case');
        $this->assertEquals($request->getHeaderLine('Content-Type'), 'application/json');
        
        //         echo "\r\n";
        //         try {
        //             $client = new \GuzzleHttp\Client();
        //             $response = $client->send($request);
        
        //             echo $response->getStatusCode();
        //             echo "\r\n";
        //             echo $response->getBody()->getContents();
        //         } catch (\Exception $e) {
        //             echo $e->getMessage();
        //             echo "\r\n";
        //             echo $request->getBody();
        //         }
        
        
    }
    
    public function testUpdate()
    {
        $case = $this->case();
        $case->setId('d9a7117a-8acf-4bf1-ac41-8d6d2dc83b26');
        $case->setSubject('update');
        $request = new CaseUpdateRequest('http://org.moedelo.bpm.casedocs:55591/bpm/casedocs/V2/Case', $case, new Json());
        
        $this->assertEquals($request->getMethod(), 'PUT');
        $this->assertEquals($request->getUri(), 'http://org.moedelo.bpm.casedocs:55591/bpm/casedocs/V2/Case');
        $this->assertEquals($request->getHeaderLine('Content-Type'), 'application/json');
    }
    
    public function testGet()
    {
        $request = new CaseGetRequest('http://org.moedelo.bpm.casedocs:55591/bpm/casedocs/V2/Case', 'd9a7117a-8acf-4bf1-ac41-8d6d2dc83b26');
        
        $this->assertEquals($request->getMethod(), 'GET');
        $this->assertEquals($request->getUri(), 'http://org.moedelo.bpm.casedocs:55591/bpm/casedocs/V2/Case/d9a7117a-8acf-4bf1-ac41-8d6d2dc83b26');
    }
    
    public function testDelete()
    {
        $request = new CaseDeleteRequest('http://org.moedelo.bpm.casedocs:55591/bpm/casedocs/V2/Case', 'd9a7117a-8acf-4bf1-ac41-8d6d2dc83b26');
        
        $this->assertEquals($request->getMethod(), 'DELETE');
        $this->assertEquals($request->getUri(), 'http://org.moedelo.bpm.casedocs:55591/bpm/casedocs/V2/Case/d9a7117a-8acf-4bf1-ac41-8d6d2dc83b26');
    }
}
<?php

class ChecklistTest extends TestCase {
    //Test for Checklist [GET]

    public function testShouldReturnAllChecklist(){
        $this->get("checklist", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    'type',
                    'id',
                    'attributes' => [
                        'object_domain',
                        'object_id',
                        'task_id',
                        'description',
                        'is_completed',
                        'due',
                        'urgency',
                        'completed_at',
                        'last_update_by',
                        'update_at',
                        'created_at'
                    ],
                    'links' => [
                        'self'
                    ]
                ]
            ],
            'meta' => [
                '*' => [
                    'total',
                    'count',
                    'per_page',
                    'current_page',
                    'total_pages',
                    'links',
                ]
            ]
        ]);

    }

    public function testShouldReturnOneChecklist(){
        $faker = Faker\Factory::create();
        $randomId = $faker->numberBetween(0,9);

        $this->get("checklist/".$randomId, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    'object_domain',
                    'object_id',
                    'task_id',
                    'description',
                    'is_completed',
                    'due',
                    'urgency',
                    'completed_at',
                    'last_update_by',
                    'update_at',
                    'created_at'
                ],
                'links' => [
                    'self'
                ]
            ]
        ]);

    }

}
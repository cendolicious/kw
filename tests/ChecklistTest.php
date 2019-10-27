<?php

class ChecklistTest extends TestCase {
    //Test for Checklist [GET]

    public function testShouldReturnAllChecklist(){
        $method = 'GET';
        $url = 'checklist/';
        $data = [];
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => env('KW_ACCESS_TOKEN')
        ];

        $this->json($method, $url, $data, $headers)
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => ['*' =>
                    [
                        'type',
                        'id',
                        'attributes' => [
                            'object_domain',
                            'object_id',
                            'description',
                            'is_completed',
                            'due',
                            'urgency',
                            'completed_at',
                            'last_update_by',
                            'updated_at',
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

        $method = 'GET';
        $url = 'checklist/'.$randomId;
        $data = [];
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => env('KW_ACCESS_TOKEN')
        ];

        $this->json($method, $url, $data, $headers)
        ->seeStatusCode(200)
        ->seeJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    'object_domain',
                    'object_id',
                    'description',
                    'is_completed',
                    'due',
                    'urgency',
                    'completed_at',
                    'last_update_by',
                    'updated_at',
                    'created_at'
                ],
                'links' => [
                    'self'
                ]
            ]
        ]);

    }

    public function testShouldCreateOneChecklist(){
        $faker = Faker\Factory::create();
        $randomUrgency = $faker->numberBetween(0,9);

        $method = 'POST';
        $url = 'checklist/';
        $data = [
            "data" => [
                "attributes" => [
                    "object_domain" => $faker->word,
                    "object_id" => $faker->randomNumber(3),
                    "due" => $faker->date(),
                    "urgency" => $randomUrgency,
                    "description" => $faker->text,
                ],
                "task_id" => $faker->randomNumber(3),
            ]
        ];
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => env('KW_ACCESS_TOKEN')
        ];

        $this->json($method, $url, $data, $headers)
            ->seeStatusCode(200)
            ->seeJsonStructure([
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
                        'created_by',
                        'created_at',
                        'updated_by',
                        'updated_at'
                    ],
                    'links' => [
                        'self'
                    ]
                ]
            ]);

    }

    public function testShouldUpdateOneChecklist(){
        $faker = Faker\Factory::create();
        $randomId = $faker->numberBetween(0,9);

        $method = 'PATCH';
        $url = 'checklist/'.$randomId;
        $data = [
            "data" => [
                "type" => "checklists",
                "id" => $randomId,
                "attributes" => [
                    "object_domain" => $faker->word,
                    "object_id" => $faker->randomNumber(3),
                    "description" => $faker->text,
                    "is_completed" => $faker->boolean,
                    "completed_at" => $faker->date(),
                    "created_at" => $faker->date(),
                ],
                "links" => [
                    'self' => url().'/checklist/'.$randomId
                ],
            ]
        ];
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => env('KW_ACCESS_TOKEN')
        ];

        $this->json($method, $url, $data, $headers)
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [
                    'type',
                    'id',
                    'attributes' => [
                        'object_domain',
                        'object_id',
                        'description',
                        'is_completed',
                        'due',
                        'urgency',
                        'completed_at',
                        'created_at',
                        'last_update_by',
                        'updated_at'
                    ],
                    'links' => [
                        'self'
                    ]
                ]
            ]);

    }

    public function testShouldDeleteOneChecklist(){
        $faker = Faker\Factory::create();
        $randomId = $faker->numberBetween(0,9);

        $method = 'DELETE';
        $url = 'checklist/'.$randomId;
        $data = [];
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => env('KW_ACCESS_TOKEN')
        ];

        $this->json($method, $url, $data, $headers)
            ->seeStatusCode(204)
            ->seeJsonStructure();

    }

}
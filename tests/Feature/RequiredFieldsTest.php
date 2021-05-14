<?php

namespace Tests\Feature;

use App\Http\Requests\ContactFormRequest;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class RequiredFieldsTest extends TestCase
{

    /**
     * @var array|\string[][]
     */
    private $formRequest;
    /**
     * @var mixed
     */
    private $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = app()->get('validator');

        $this->formRequest = (new ContactFormRequest());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fields_except_file_upload_is_required()
    {
        $this->withoutExceptionHandling();

        $request = $this->formRequest;
        $rules = Arr::only($request->rules(), ['email', 'name', 'message', 'file']);
        $faker = Factory::create();
        $validator = Validator::make([
            'email' => $faker->email,
            'name' => $faker->name,
            'message' => $faker->text
        ], $rules);
        $passed = $validator->passes();
        self::assertTrue($passed);
    }
}

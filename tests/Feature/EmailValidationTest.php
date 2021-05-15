<?php

namespace Tests\Feature;

use App\Http\Requests\ContactFormRequest;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class EmailValidationTest extends TestCase
{
    private $formRequest;

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
    public function test_email_validation_with_bad_email(): void
    {
        $this->withoutExceptionHandling();

        $request = $this->formRequest;
        $rules = Arr::only($request->rules(), ['email']);
        $faker = Factory::create();
        $validator = Validator::make([
            'email' => $faker->email,
        ], $rules);
        $passed = $validator->passes();
        self::assertTrue($passed);
    }

    public function test_email_validation_with_wrong_email(): void
    {
        $this->withoutExceptionHandling();

        $request = $this->formRequest;
        $rules = Arr::only($request->rules(), ['email']);
        $validator = Validator::make([
            'email' => 'gibberish',
        ], $rules);
        $passed = $validator->passes();
        self::assertFalse($passed);
    }
}

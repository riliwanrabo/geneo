<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class FileMimeTypesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_file_upload_and_allowed_mimes(): void
    {
        $this->withoutExceptionHandling();
        Storage::fake('public');
        $file = UploadedFile::fake()->create(
            'document.pdf', 1, 'application/pdf'
        );

        $rules = [
            'file' => ['mimes:pdf,csv,xlsx,xls']
        ];

        $validator = Validator::make([
            'file' => $file
        ], $rules);

        $passed = $validator->passes();
        self::assertTrue($passed);
    }
}

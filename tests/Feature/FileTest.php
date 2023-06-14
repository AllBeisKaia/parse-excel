<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;

class FileTest extends BaseTest
{
    /**
     * A basic feature test example.
     */
    public function testUpload(): void
    {
        $this->withoutMiddleware(['csrf', 'hashFile']);

        Storage::fake('local');

        $file = UploadedFile::fake()->create('test.xlsx');

        $this->actingAs($this->findTestUser(), 'web');

        $response = $this->post('/parser/parseExcel', [
            'file' => $file,
        ]);

        $response->assertRedirectToRoute('parser.parserForm');

        Storage::disk('local')->assertExists($file->hashName());
    }
}

<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadSurveyQrCodeController extends Controller
{
    /**
     * @throws FileNotFoundException
     */
    public function __invoke(string $code): StreamedResponse
    {
        $directory = '/qr-codes';
        $path = "$directory/$code.png";

        // checking if generated qr-code is exists or not
        // if not generated and save it on default driver
        if (!Storage::exists($path)) {
            $this->storeGeneratedQrCode($code, $path);
        }

        return Storage::download($path, 'survey-qrcode-' . $code . '.png');
    }

    /**
     * Generated qr-code and save it on default filesystem driver
     *
     * @param string $code
     * @param string $path
     * @return void
     * @throws FileNotFoundException
     */
    protected function storeGeneratedQrCode(string $code, string $path): void
    {
        $publicStorage = Storage::drive('public');

        // checking if temp directory on public driver exist or not
        if (!$publicStorage->exists('/tmp')) {
            $publicStorage->makeDirectory('/tmp');
        }

        // store generated qr-code on tmp file
        $tmpPath = "./storage/tmp/$code.png";
        QrCode::format('png')
            ->size(600)
            ->margin(1)
            ->errorCorrection('H')
            ->generate(route('college.home', ['code' => $code]), $tmpPath);

        // store qr-code on default driver
        $qrCodeFile = $publicStorage->readStream("tmp/$code.png");
        Storage::put($path, $qrCodeFile);

        // delete temp generated qr-code
        $publicStorage->deleteDirectory('tmp/');
    }
}

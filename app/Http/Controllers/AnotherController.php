<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UploadInvoice;

class AnotherController extends Controller
{
    protected $uploadInvoice;

    public function __construct(UploadInvoice $uploadInvoice)
    {
        $this->uploadInvoice = $uploadInvoice;
    }

    public function showInvoice($requestId)
    {
        return $this->uploadInvoice->getInvoice($requestId);
    }
}

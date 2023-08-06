<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;

class PdfGeneratorController extends Controller
{
    public function index()
    {
        $data = [
            'imagePath'    => 'https://static.vecteezy.com/system/resources/previews/000/596/678/original/circle-line-logo-template-vector-icon.jpg',
            'name'         => 'John Doe',
            'address'      => 'USA',
            'mobileNumber' => '000000000',
            'email'        => 'john.doe@email.com'
        ];
        $pdf = PDF::loadView('documents.quotation-v1', $data);
        return $pdf->stream('quotation.pdf');
    }
}

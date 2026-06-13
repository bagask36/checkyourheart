<?php

namespace App\Http\Controllers;

use App\Services\ContentService;

class LandingController extends Controller
{
    public function __construct(private ContentService $content)
    {
    }

    public function index()
    {
        return view('landing.index', [
            'content' => $this->content->getLandingContent(),
        ]);
    }
}

<?php

namespace App\Services;

use App\Models\Slide;

class SlideService
{
    private $slide;

    public function __construct(Slide $slide)
    {
        $this->slide = $slide;
    }

    public function list()
    {
        return $this->slide->active()->orderBy('position', 'ASC')->get();
    }
}
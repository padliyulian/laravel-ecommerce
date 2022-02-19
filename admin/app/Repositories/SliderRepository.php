<?php

namespace App\Repositories;

use App\Models\Slide;
use Illuminate\Support\Facades\Storage;

class SliderRepository
{
    private $slide;

    public function __construct(Slide $slide)
    {
        $this->slide = $slide;
    }

    public function list($count)
    {
        return $this->slide->orderBy('position', 'ASC')->paginate($count);
    }

    public function moveUp($id)
	{
		$slide = $this->slide->findOrFail($id);

		if (!$slide->prevSlide()) {
			return 'invalid position';
		}

		return \DB::transaction(
			function () use ($slide) {
				$currentPosition = $slide->position;
				$prevPosition = $slide->prevSlide()->position;

				$prevSlide = $this->slide->find($slide->prevSlide()->id);
				$prevSlide->position = $currentPosition;
				$prevSlide->save();

				$slide->position = $prevPosition;
				$slide->save();
                return $slide;
			}
		);
	}

    public function moveDown($id)
	{
		$slide = $this->slide->findOrFail($id);

		if (!$slide->nextSlide()) {
			return 'invalid position';
		}

		return \DB::transaction(
			function () use ($slide) {
				$currentPosition = $slide->position;
				$nextPosition = $slide->nextSlide()->position;

				$nextSlide = $this->slide->find($slide->nextSlide()->id);
				$nextSlide->position = $currentPosition;
				$nextSlide->save();

				$slide->position = $nextPosition;
				$slide->save();
                return $slide;
			}
		);
	}

    public function delete($id)
	{
		$slide = $this->slide->findOrFail($id);
		if ($slide->delete()) {
			Storage::delete([
                'public/'.$slide->small,
                'public/'.$slide->original,
                'public/'.$slide->extra_large
            ]);
            return $slide;
		}
	}
}
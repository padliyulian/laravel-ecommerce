<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\SlideRequest;
use App\Repositories\SliderRepository;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
	private $slideRepo;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(SliderRepository $slideRepo)
	{
		parent::__construct();

		$this->data['currentAdminSubMenu1'] = 'settings';
        $this->data['currentAdminSubMenu2'] = 'generals';
        $this->data['currentAdminMenu'] = 'slide';

		$this->data['statuses'] = Slide::STATUSES;

		$this->slideRepo = $slideRepo;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->data['slides'] = $this->slideRepo->list(10);
		return view('pages.slides.index', $this->data);
	}

	/**
	 * Move up the slide position
	 *
	 * @param int $id slide ID
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function moveUp($id)
	{
		$slide = $this->slideRepo->moveUp($id);
		if ($slide == 'invalid position') {
			\Session::flash('error.message', 'Invalid position');
			return redirect('slides');
		}
		return redirect('slides');
	}

	/**
	 * Move down the slide position
	 *
	 * @param int $id slide ID
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function moveDown($id)
	{
		$slide = $this->slideRepo->moveDown($id);
		if ($slide == 'invalid position') {
			\Session::flash('error.message', 'Invalid position');
			return redirect('slides');
		}
		return redirect('slides');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data['slide'] = null;
		return view('pages.slides.form', $this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param SlideRequest $request request params
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(SlideRequest $request)
	{
		$params = $request->except('_token');

		$image = $request->file('image');
		$name = \Str::slug($params['title']) . '_' . time();
		$fileName = $name . '.' . $image->getClientOriginalExtension();

		$folder = env('URL_IMAGE_SLIDER');

		$filePath = $image->storeAs($folder . '/original', $fileName, 'public');

		$resizedImage = $this->_resizeImage($image, $fileName, $folder);

		$params['original'] = $filePath;
		$params['extra_large'] = $resizedImage['extra_large'];
		$params['small'] = $resizedImage['small'];
		$params['user_id'] = \Auth::user()->id;

		unset($params['image']);

		$params['position'] = Slide::max('position') + 1;

		if (Slide::create($params)) {
			\Session::flash('success.message', 'Slide has been created');
		} else {
			\Session::flash('error.message', 'Slide could not be created');
		}

		return redirect('slides');
	}

	/**
	 * Resize image
	 *
	 * @param file   $image    raw file
	 * @param string $fileName image file name
	 * @param string $folder   folder name
	 *
	 * @return Response
	 */
	private function _resizeImage($image, $fileName, $folder)
	{
		$resizedImage = [];

		$smallImageFilePath = $folder . '/small/' . $fileName;
		$size = explode('x', Slide::SMALL);
		list($width, $height) = $size;

		$smallImageFile = \Image::make($image)->fit($width, $height)->stream();
		if (\Storage::put('public/' . $smallImageFilePath, $smallImageFile)) {
			$resizedImage['small'] = $smallImageFilePath;
		}

		$extraLargeImageFilePath  = $folder . '/xlarge/' . $fileName;
		$size = explode('x', Slide::EXTRA_LARGE);
		list($width, $height) = $size;

		$extraLargeImageFile = \Image::make($image)->fit($width, $height)->stream();
		if (\Storage::put('public/' . $extraLargeImageFilePath, $extraLargeImageFile)) {
			$resizedImage['extra_large'] = $extraLargeImageFilePath;
		}

		return $resizedImage;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id slide ID
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$slide = Slide::findOrFail($id);
		$this->data['slide'] = $slide;
		return view('pages.slides.form', $this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param SlideRequest $request request params
	 * @param int          $id      slide ID
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(SlideRequest $request, $id)
	{
		$params = $request->except('_token');

		$slide = Slide::findOrFail($id);
		if ($slide->update($params)) {
			\Session::flash('success.message', 'Slide has been updated.');
		}

		return redirect('slides');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id slide ID
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$slide  = $this->slideRepo->delete($id);
		if ($slide) {
			\Session::flash('success.message', 'Slide has been deleted');
			return redirect('slides');
		}
	}
}

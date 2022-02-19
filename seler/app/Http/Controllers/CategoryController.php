<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->data['currentAdminSubMenu1'] = 'products';
        $this->data['currentAdminSubMenu2'] = '';
        $this->data['currentAdminMenu'] = 'category';

        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $this->data['categories'] = $this->categoryRepository->list($request);
        return view('pages.category.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $this->data['categories'] = $this->categoryRepository->listOf();
        return view('pages.category.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $this->categoryRepository->add($request);
        if ($data) {
            session()->flash('success.message', 'Success adding data');
            return redirect('/category');
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $this->data['categories'] = $this->categoryRepository->listOf();
        $this->data['category'] = $this->categoryRepository->detail($id);
        return view('pages.category.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $data = $this->categoryRepository->update($request, $id);
        if ($data) {
            session()->flash('success.message', 'Success updating data');
            return redirect('/category');
        } else {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $data = $this->categoryRepository->delete($id);
        if ($data) {
            session()->flash('success.message', 'Success deleting data');
            return redirect('/category');
        } else {
            return abort(404);
        }
    }
}

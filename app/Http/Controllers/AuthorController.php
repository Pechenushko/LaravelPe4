<?php

namespace App\Http\Controllers;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * The author repository instance.
     */
    protected $authors;

    /**
     * Create a new controller instance.
     *
     * @param  RepositoryInterface $authors
     */
    public function __construct(RepositoryInterface $authors)
    {
        $this->authors = $authors;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listOfAuthors = $this->authors->getList();
        return response()->json([
            'status' => 'success',
            'authors' => $listOfAuthors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $this->buildValidParams($request);
        $newId = $this->authors->store($params);
        return response()->json([
            'status' => 'success',
            'link_to_author' => route('profile', ['author_id' => $newId])
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = $this->authors->show($id);
        return response()->json([
            'status' => 'success',
            'author' => $author
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $params = $this->buildValidParams($request);
        $id = $this->authors->update($params, $id);
        return response()->json([
            'status' => 'success',
            'link_to_author' => route('profile', ['author_id' => $id])
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authors->destroy($id);
        return response('', 204);
    }

    /**
     * Validate and make array of params
     *
     * @param Request $request
     * @return array
     */
    private function buildValidParams(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:books,name|max:255',
        ]);
        return [
            'name' => $request->input('name'),
        ];
    }
}

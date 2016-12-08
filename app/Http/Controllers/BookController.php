<?php

namespace App\Http\Controllers;

use App\Repositories\RepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    /**
     * The book repository instance.
     */
    protected $books;

    /**
     * Create a new controller instance.
     *
     * @param  RepositoryInterface $books
     */
    public function __construct(RepositoryInterface $books)
    {
        $this->books = $books;
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $author_name
     * @return \Illuminate\Http\Response
     * @throws ValidationException
     */
    public function index($author_name = '')
    {
        $validator = Validator::make(['author_name' => $author_name], [
            'author_name' => 'sometimes|string|regex:/^([a-z0-9,.\s\']?+)+$/'
        ]);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        $listOfBooks = $this->books->getList($author_name);
        return response()->json([
            'status' => 'success',
            'books' => $listOfBooks
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
        $newId = $this->books->store($params);
        return response()->json([
            'status' => 'success',
            'link_to_book' => route('profile', ['book_id' => $newId])
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
        $book = $this->books->show($id);
        return response()->json([
            'status' => 'success',
            'book' => $book
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
        $id = $this->books->update($params, $id);
        return response()->json([
            'status' => 'success',
            'link_to_book' => route('profile', ['book_id' => $id])
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
        $this->books->destroy($id);
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
            'author_id' => 'required|integer',
        ]);
        return [
            'name' => $request->input('name'),
            'author_id' => $request->input('author_id'),
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookController extends Controller
{
    private BookRepositoryInterface $bookRepository;
    private UserRepositoryInterface $userRepository;
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(BookRepositoryInterface $bookRepository, CategoryRepositoryInterface $categoryRepository, UserRepositoryInterface $userRepository) 
    {
        $this->bookRepository = $bookRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->bookRepository->getBookIsNotSoftDelete();

        return view('pages.books.list-books')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAll();
        
        return view('pages.books.add-book')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $data = $request->validated();   
        
        $bookDetails = [
            'title' => $data['title'],
            'publisher' => $data['publisher'],
            'category_id' => $data['category'],
            'user_id' => Auth::user()->id,
            'quantity' => $data['quantity'],
            'price' => $data['price'],
        ];
        $this->bookRepository->store($bookDetails);

        return redirect()->route('book.create')->with('message', 'Create book success');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return $book->id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = $this->categoryRepository->getAll();

        return view('pages.books.update-book')->with(compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest $request
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book)
    {
        $data = $request->validated();
        $bookDetails = [
            'title' => $data['title'],
            'publisher' => $data['publisher'],
            'category_id' => $data['category'],
            'user_id' => Auth::user()->id,
            'quantity' => $request['quantity'],
            'price' => $request['price'],
        ];
        $this->bookRepository->update($bookDetails, $book->id);

        return redirect()->route('book.index')->with('message', 'Update book success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book = $this->bookRepository->getById($book->id);
        $this->bookRepository->deleteById($book->id);
        /**
         * Check admin deleter account
         * If correct, will send a message to email
         */
        if(Auth::user()->getRoleNames('admin')) {
            $user = $this->userRepository->getById($book->user_id);
            $email = $user['email'];
            $name = $user['name'];
            $data = [
                'id' => $book->id,
                'email' => $email,
                'name' => $name,
                'title' => $book->title,
            ];

            Mail::send('pages.sendMail', $data, function($message) use ($email, $name) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_USERNAME'));
                $message->to($email, $name);
                $message->subject('Notification!');
            });
        }
            
        return $book;
    }

    /**
     * Display a listing of the resource with search character.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if ($request->has('key')) {
            $data = $this->bookRepository->searchBook($request['key']);
        } else {
            $data = $this->bookRepository->getAll();
        }

        return  view('pages.books.list-books')->with(compact('data'));
    }

    /**
     * Show SoftDelete books
     *
     * @return \Illuminate\Http\Response
     */
    public function showSoftDelete()
    {
        $data = $this->bookRepository->getBookOnlySoftDelete();
        $isSoftDelete = true;

        return view('pages.books.list-books')->with(compact('data', 'isSoftDelete'));
    }

     /**
     * Recovery SoftDelete books
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $bookRestore = $this->bookRepository->restore($id);

        return $bookRestore;
    }
}

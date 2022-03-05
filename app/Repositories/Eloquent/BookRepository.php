<?php

namespace App\Repositories\Eloquent;

use App\Models\Book;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\BookRepositoryInterface;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    public function __construct(Book $book)
    {
        parent::__construct($book);
    }

    /**
     * list book function
     *
     * @return Object | Exception
     */
    public function getBookIsNotSoftDelete()
    {
        $data = Book::join('categories', 'books.category_id', 'categories.id')
            ->join('users', 'books.user_id', 'users.id')
            ->whereNull('categories.deleted_at')
            ->whereNull('users.deleted_at')
            ->select('books.*', 'categories.name as category_name', 'users.name as user_name')
            ->orderBy('created_at', 'DESC')
            ->paginate();

        return $data;
    }

    /**
     * list book is soft delete function
     *
     * @return Object | Exception
     */
    public function getBookOnlySoftDelete()
    {
        $data = $this->book->getModel()->onlyTrashed()
            ->join('categories', 'books.category_id', 'categories.id')
            ->join('users', 'books.user_id', 'users.id')
            ->select('books.*', 'categories.name as category_name', 'users.name as user_name')
            ->orderBy('created_at', 'DESC')->paginate();

        return $data;
    }

    /**
     * list book search function
     *
     * @return Object | Exception
     */
    public function searchBook($key)
    {
        $data = $this->book->getModel()->select('books.*', 'categories.name as category_name', 'users.name as user_name')
            ->join('categories', 'books.category_id', 'categories.id')
            ->join('users', 'books.user_id', 'users.id')
            ->whereNull('categories.deleted_at')
            ->whereNull('users.deleted_at')
            ->where('title', 'LIKE', '%' . $key . '%')
            ->orWhere('publisher', 'LIKE', '%' . $key . '%')
            ->orWhere('categories.name', 'LIKE', '%' . $key . '%')
            ->orWhere('users.name', 'LIKE', '%' . $key . '%')
            ->orWhere('quantity', 'LIKE', '%' . $key . '%')
            ->orWhere('price', 'LIKE', '%' . $key . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate();

        return $data;
    }
}

<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;

use Auth;
use App;

use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;

use App\Book;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

use Storage;

use Validator;

use Redirect;

use Log;

use DB;

class BooksController extends Controller
{	
	public function welcome()
	{
		$books = Book::orderBy('name', 'asc')->get();			

		return view("welcome", compact('books'));
	}

	public function create()
	{	
		return view("editbook");
	}

	public function store(Request $request)
	{ 
	  $validatedData = $request->validate([
		'name' => ['required', 'max:255'],
		'isbn' => ['required', 'max:20'],
		'genre' => ['required', 'max:30'],
		'abstract' => ['required'],
		'publicationdate' => ['required', 'date'],
		'email' => ['required', 'email'],
		'length' => ['required', 'numeric']
  		]);

		Book::create($validatedData);

		return redirect()->back()->with('message','Book added succesfully.');
	}
}

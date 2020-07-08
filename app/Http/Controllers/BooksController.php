<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\Storage;
use Image;

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
		'length' => ['required', 'numeric'],
		'image' => ['image','mimes:jpeg,png,jpg,gif','max:2048']
  		]);

		$book = Book::create($validatedData);

		if($request->hasFile('image'))
		{
			$image = Image::make($request->file('image'))
  			->resize(400, null, function ($constraint) { $constraint->aspectRatio(); } )
  			->encode('jpg',80);
			Storage::disk('public')->put($book->id.'.jpg', $image);
		}

		return redirect()->back()->with('success','Book added succesfully.');
	}
}

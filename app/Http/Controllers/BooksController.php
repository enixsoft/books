<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\Storage;
use Image;
use DateTime;

class BooksController extends Controller
{	
	public function show(Request $request)
	{
		$attribs = (new Book())->getFillable();
		
		$orderBy = 'name';
		$orderType = 'asc';		
		$searchedName = null;
		$minPublicationDate = null;
		$maxPublicationDate = null;
		$filters = [];
		
		if(in_array($request->query('orderBy'), $attribs) && ($request->query('orderType') == 'asc' || $request->query('orderType') == 'desc'))
		{
			$orderBy = $request->query('orderBy');
			$orderType = $request->query('orderType');
		}

		if(strtotime($request->query('minPublicationDate')))
		{			
			$minPublicationDate = $request->query('minPublicationDate');
			array_push($filters, ['publicationdate', '>=', $minPublicationDate]);
		}

		if(strtotime($request->query('maxPublicationDate')))
		{
			$maxPublicationDate = $request->query('maxPublicationDate');
			array_push($filters, ['publicationdate', '<=', $maxPublicationDate]);
		}

		if(is_string($request->query('searchedName')))
		{
			$searchedName = $request->query('searchedName');
			array_push($filters, ['name', 'like', '%'.$request->query('searchedName').'%']);
		}

		if(count($filters) > 0)
		{
			$books = Book::where($filters)->orderBy($orderBy, $orderType)->paginate(2);
		}
		else
		{
			$books = Book::orderBy($orderBy, $orderType)->paginate(2);
		}		

		return view("welcome", compact('books', 'orderBy', 'orderType', 'searchedName', 'minPublicationDate', 'maxPublicationDate'));
	}

	public function create()
	{	
		return view("editor");
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

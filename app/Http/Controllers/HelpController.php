<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HelpController extends Controller {

	/**
	 * Display help page.
	 * 
	 * @Get("/help", as="help.index")
	 * 
	 * @return Response
	 */
	public function index()
	{
		return view('pages.help');
	}

}

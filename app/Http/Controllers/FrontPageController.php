<?php

namespace App\Http\Controllers;

use Image;
use App\FrontPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FrontPageController extends Controller
{
    public function index()
    {
    	$frontPageInfos = FrontPage::first();

    	if (request()->expectsJson()) {
    		return response($frontPageInfos, 200);
    	}

    	return view('admin.frontPage', compact('frontPageInfos'));
    }

    public function store(Request $request)
    {
    	$frontPageInfo = FrontPage::first();

    	if ($frontPageInfo) {
    		$this->validateRequest();

    		try {
	    		$file = $frontPageInfo['image'];
	        	Storage::disk('custom')->delete($file);
    		} catch (\Exception $e) {
    			$e->getMessage();
    		}

        	$frontPageInfo->delete();

    		$this->createInfos($request);

    		return back()->with('success_message', 'Successfully updated.');

    	} else {
			$this->validateRequest();

	    	$this->createInfos($request);

	        return back()->with('success_message', 'Success');
    	}
    }

    protected function validateRequest()
    {
    	return request()->validate([
    		'title' => 'required|string',
    		'subtitle' => 'required|string',
    		'image' => 'required|image|mimes:jpg,jpeg,png,bmp'
    	]);
    }

    protected function createInfos(Request $request)
    {
    	$file = $request->file('image');

        $name = time() . $file->getClientOriginalName();
        $path = 'img/' . $name;
        $file = Image::make($file->getRealPath())->resize(800, 500)->save($path);

        $infos = new FrontPage();
        $infos->title = $request['title'];
        $infos->subtitle = $request['subtitle'];
        $infos->image = $path;
        return $infos->save();
    }
}

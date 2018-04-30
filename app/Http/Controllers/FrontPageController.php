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

        return view('admin.frontPage', compact('frontPageInfos'));
    }

    public function indexJson()
    {
        $frontPageInfos = FrontPage::first();

        if (request()->expectsJson()) {
            return response($frontPageInfos, 200);
        }

        return back()->with('error_message', 'Page Not Found');
    }

    public function store(Request $request)
    {
    	$frontPageInfo = FrontPage::first();

    	if ($frontPageInfo) {
    		$this->validateRequest();

    		try {
	        	Storage::disk('custom')->delete($frontPageInfo['image']);

            	$frontPageInfo->delete();

        		$this->createInfos($request);

        		return back()->with('success_message', 'Successfully updated.');

            } catch (\Exception $e) {
                $e->getMessage();
            }

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
    		'image' => 'nullable|image|mimes:jpg,jpeg,png,bmp',
            'color' => 'required|string',
            'background_color' => 'required|string',
            'well_color' => 'required|string',
            'categories_title_color' => 'required|string'
    	]);
    }

    protected function createInfos(Request $request)
    {
        // test without resizing images
    	$file = $request->file('image');

        $name = time() . $file->getClientOriginalName();
        $path = 'img/' . $name;
        $file = Image::make($file->getRealPath())->resize(800, 500)->save($path);

        $infos = new FrontPage();
        $infos->title = $request['title'];
        $infos->subtitle = $request['subtitle'];
        $infos->image = $path;
        $infos->color = $request['color'];
        $infos->background_color = $request['background_color'];
        $infos->well_color = $request['well_color'];
        $infos->categories_title_color = $request['categories_title_color'];
        return $infos->save();
    }
}

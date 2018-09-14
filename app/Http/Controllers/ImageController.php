<?php

namespace App\Http\Controllers;

use Debugbar;
use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as InterventionImage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check that PHP.ini-settings are set to recommended values
        $uploadMaxSize = $this->convertIniToMegaBytes(ini_get('upload_max_filesize'));
        $postMaxSize = $this->convertIniToMegaBytes(ini_get('post_max_size'));
        $recommendedValue = Config::get('constants.constants.constant_recommended_post_size');

        $images = DB::table('images')->orderByDesc('created_at')->simplePaginate(30);

        if ($uploadMaxSize < $recommendedValue || $postMaxSize < $recommendedValue) {
            DebugBar::addMessage("There are errors!");
            return view('backend.pages.image.index', ['images' => $images])->withErrors(
                ['ini_settings_error' => 'Your PHP.ini settings are below the recommended value. Please consider increasing both "upload_max_filesize" and "post_max_size" to at least ' . $recommendedValue . 'M.']
            );
        }

        return view('backend.pages.image.index', ['images' => $images]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [];

        for ($i = 0; $i < count($request->file('files')); $i++) {
            $rules['files.' . $i] = "image|mimes:jpeg,bmp,png|max:10000";
        }

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return url()->route('backend/image/index');
        }

        // TODO: Implement checks for all required input parameters
        foreach($request->file('files') as $file) {
            $filename = $file->store('uploads/images', 'public');

            $thumbnail = InterventionImage::make(public_path('storage/' . $filename))->resize(300, null, function($constraint) {
                $constraint->aspectRatio();
            });
            $fileExtension = pathinfo(public_path('storage/' . $filename), PATHINFO_EXTENSION);
            $thumbnail->save(public_path('storage/' . $filename . '-thumb' . '.' . $fileExtension));
            $image = new Image();
            $image->filename = $filename;
            $image->name = $file->getClientOriginalName();
            $image->filename_thumbnail = $filename . '-thumb' . '.' . $fileExtension;
            $image->save();
        }

        return url()->route('backend/image/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $img = Image::find($id);
        return redirect(asset('storage/' . $img->filename));
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $img = Image::find($id);
        // TODO this 'storage/' prepend should not be necessary
        // TODO display errors in view
        $imgPath = public_path('storage/' . $img->filename);
        File::delete($imgPath);
        if (File::exists($imgPath)) {
            return redirect()->route('backend/image/index')->withErrors(['not_deleted_error' => 'File ' . $img->name . ' could not be deleted! Please try again...']);
        }

        $thumbnailPath = public_path('storage/' . $img->filename_thumbnail);
        File::delete($thumbnailPath);
        if (File::exists($thumbnailPath)) {
            return redirect()->route('backend/image/index')->withErrors(['not_deleted_error' => 'File ' . $img->name . ' could not be deleted! Please try again...']);
        }

        Image::destroy($id);
        return redirect()->route('backend/image/index');
    }

    /**
     * Prepare an HTTP response based on the given image model. This method returns JSON if needed or an HTML view
     * otherwise.
     *
     * @param Image $img
     * @return \Illuminate\Http\Response
     */
    private function convertImageToRequest(Image $img)
    {

    }

    private function convertIniToMegaBytes(string $val)
    {
        $val = trim($val);
        $last = strtolower($val[strlen($val)-1]);
        $val = substr($val, 0, strlen($val) - 1);
        switch($last) {
            // The 'G' modifier is available since PHP 5.1.0
            case 'g':
                $val *= 1024;
                break;
            case 'k':
                $val /= 1024;
                break;
        }

        return $val;
    }
}

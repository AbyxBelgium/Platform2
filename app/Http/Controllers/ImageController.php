<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = DB::table('images')->orderByDesc('created_at')->simplePaginate(60);
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
        // TODO: Implement checks for all required input parameters
        foreach($request->file('files') as $file) {
            $filename = $file->store('uploads/images');
            $image = new Image();
            $image->name = $filename;
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
        // TODO implement correct!
        return view('backend.pages.image.index');
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

    }

    /**
     * Prepare an HTTP response based on the given image model. This method returns JSON if needed or an HTML view
     * otherwise.
     *
     * @param Image $img
     * @return \Illuminate\Http\Response
     */
    private function convertImageToRequest(Image $img) {

    }
}

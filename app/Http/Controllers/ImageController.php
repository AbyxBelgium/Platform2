<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Image;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = [];
        foreach (Image::all() as $img) {
            if (request()->wantsJson()) {
                array_push($images, $img->toJson());
            } else {
                // TODO fix for HTML view
            }
        }
        return Response($images);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required'
        ];

        $request->validate($rules);

        $img = new Image($request->all());
        $img->save();

        return $this->convertImageToRequest($img);
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
        if (request()->wantsJson()) {
            return Response($img->toJson());
        }

        return Response($img->name);
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
        $img = Image::find($id)->update($request->all());
        return $this->convertImageToRequest($img);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Image::destroy($id);
    }

    /**
     * Prepare an HTTP response based on the given image model. This method returns JSON if needed or an HTML view
     * otherwise.
     *
     * @param Image $img
     * @return \Illuminate\Http\Response
     */
    private function convertImageToRequest(Image $img) {
        if (request()->wantsJson()) {
            return Response($img->toJson());
        }
        return Response($img->name);
    }
}

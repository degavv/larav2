<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use Illuminate\Http\Request;
use App\Models\Photo;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        // $user = Auth::user();
        $photo = new Photo();
        $photos = $photo->orderBy('created_at', 'desc')->get();
        // dd($photos);
        return view(
            'index.index',
            [
                'photos' => $photos,
                'path' => 'storage/photos',
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('index.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhotoRequest $request)
    {
        $user = Auth::user();

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        // $uploadDir = storage_path('app/public/photos');
        $uploadDir = 'photos';
        $file->move($uploadDir, $fileName);

        $user->photos()->create([
            'name' => $fileName,
        ]);
        echo 'store';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

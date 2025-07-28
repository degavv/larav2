<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use Illuminate\Http\Request;
use App\Models\Photo;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        $photos = Photo::orderBy('created_at', 'desc')
            ->with([
                'user' => function ($query) {
                    $query->select('id', 'name');
                }
            ])
            ->get();

        return view(
            'index.index',
            [
                'photos' => $photos,
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
     * @param \App\Http\Requests\StorePhotoRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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

        return redirect('/')->with('success', 'Photo added');;
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\Photo $photo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Photo $photo)
    {
        $this->authorize('owner', $photo);
        return view('index.edit', [
            'photo' => $photo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Models\Photo $photo
     * @param \App\Http\Requests\StorePhotoRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Photo $photo, StorePhotoRequest $request)
    {
        $this->authorize('owner', $photo);
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $uploadDir = 'photos';
        $file->move($uploadDir, $fileName);

        $photo->update([
            'name' => $fileName,
        ]);

        return redirect('/')->with('success', 'Photo updated');;
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Photo $photo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Photo $photo)
    {
        $this->authorize('owner', $photo);
        $photo->delete();

        return redirect('/')
            ->with('success', 'Photo deleted');
    }
}

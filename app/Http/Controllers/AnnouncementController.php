<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AnnouncementRequest;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Auth;

class AnnouncementController extends Controller
{
	/**
	 * Protect route
	 */
	public function __construct(){
		$this->middleware('auth');
		$this->middleware('role:staff');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->get('q');

        $announcements = Announcement::where('user_id', Auth::user()->id)
                                    ->where(function($query) use ($q){
                                        $query->where('title', 'LIKE', '%' . $q . '%');
                                        $query->orWhere('content', 'LIKE', '%' . $q . '%');
                                    })
                                    ->orderBy('created_at', 'DESC')
                                    ->paginate(7);
        return view('announcements.index', compact('q', 'announcements'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $announcements = Announcement::orderBy('created_at', 'DESC')->paginate(7);
    	return view('announcements.create', compact( 'announcements' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnouncementRequest $request)
    {
    	$a = Announcement::create($request->all());
    	\Flash::success('Pengumuman tersimpan.');

        return redirect()->route('announcements.edit', [$a->id]);
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
        /* List of 7 latest announcements */
        $announcements = Announcement::orderBy('created_at', 'DESC')->paginate(7);

        /* Selected Announcement */
        $announcement = Announcement::findOrFail($id);
        return view('announcements.edit', compact('announcements', 'announcement'));
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
        $announcement = Announcement::findOrFail($id);
        $data = $request->all();
        $announcement->update($data);

        \Flash::success('Pengumuman diperbaharui.');
        return redirect()->route('announcements.edit', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Announcement::find($id)->delete();
        \Flash::success('Pengumuman terhapus.');

        return redirect()->route('announcements.index');
    }
}

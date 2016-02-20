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
        $announcements = Announcement::where('user_id', Auth::user()->id)
                                    ->where(function($query) use ($request){
                                        $query->where('title', 'LIKE', '%' . $request->get('q') . '%');
                                        $query->orWhere('content', 'LIKE', '%' . $request->get('q') . '%');
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
    	Announcement::create($request->all());
    	\Flash::success('Pengumuman tersimpan.');

        return redirect()->route('announcements.create');
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
        Announcement::find($id)->delete();
        \Flash::success('Pengumuman terhapus.');

        return redirect()->route('announcements.index');
    }
}

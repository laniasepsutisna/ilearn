<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Auth;

class AnnouncementController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
		$this->middleware('role:maddog,staff');
	}

    public function index(Request $request)
    {
        $q = $request->get('q');
        $announcements = Announcement::where('user_id', Auth::user()->id)
                                    ->where(function($query) use ($q){
                                        $query->where('title', 'LIKE', '%' . $q . '%');
                                        $query->orWhere('content', 'LIKE', '%' . $q . '%');
                                    })->orderBy('created_at', 'DESC')->paginate(7);

        $page_title = $request->has('q') ? 'Pencarian ' . $q : 'Pengumuman';

        return view('announcements.index', compact('q', 'announcements', 'page_title'));
    }

    public function create()
    {
        $announcements = Announcement::orderBy('created_at', 'DESC')->paginate(7);
        $page_title = 'Tambah Pengumuman';

    	return view('announcements.create', compact('announcements', 'page_title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100|unique:announcements',
            'status' => 'required',
            'user_id' => 'exists:users,id',
            'content' => 'required|string'
        ]);

        $a = Announcement::create($request->all());
        
        \Flash::success('Pengumuman tersimpan.');
        return redirect()->route('announcements.edit', [$a->id]);
    }

    public function edit($id)
    {
        $announcements = Announcement::orderBy('created_at', 'DESC')->paginate(7);

        $announcement = Announcement::findOrFail($id);
        $page_title = 'Edit Pengumuman';

        return view('announcements.edit', compact('announcements', 'announcement', 'page_title'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100|unique:announcements',
            'status' => 'required',
            'user_id' => 'exists:users,id',
            'content' => 'required|string'
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->update($request->all());

        \Flash::success('Pengumuman diperbaharui.');
        return redirect()->route('announcements.edit', [$id]);
    }

    
    public function destroy($id)
    {
        Announcement::find($id)->delete();

        \Flash::success('Pengumuman dipindahkan ke Tong Sampah.');
        return redirect()->route('announcements.index');
    }

    public function trash(Request $request)
    {
        $announcements = Announcement::onlyTrashed()->paginate(7);
        $page_title = 'Tong Sampah';
        
        return view('announcements.index', compact('announcements', 'page_title'));
    }

    public function restore($id)
    {
        Announcement::where('id', $id)->restore();

        \Flash::success('Data dikembalikan.');
        return redirect()->route('announcements.trash');
    }

    public function forceDelete($id)
    {
        Announcement::where('id', $id)->forceDelete();

        \Flash::success('Pengumuman terhapus.');
        return redirect()->route('announcements.trash');
    }
}

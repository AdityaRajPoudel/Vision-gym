<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private $default_pagination;

    public function __construct()
    {
        $this->default_pagination = 25;
    }

    public function index()
    {
        $announcements = Notification::orderBy("id", "ASC")->paginate(
            $this->default_pagination
        );
        return view("backend.notification.index", compact('announcements'));
    }

    public function create()
    {
        return view("backend.notification.create");
    }

    public function store(Request $request)
    {
        $notification = new Notification();
        $notification->title = $request->title;
        $notification->description = $request->description;
        $notification->save();

        return redirect()->route('announcement.index')->with('message', 'Announcement Created Successfully');
    }

    public function edit($id)
    {
        $announcement = Notification::where('id', $id)->first();
        return view("backend.notification.edit", compact('announcement'));
    }
    
    public function update(Request $request,$id)
    {
        $announcement = Notification::where('id', $id)->first();
        $announcement->title = $request->title;
        $announcement->description = $request->description;
        $announcement->update();

        return redirect()->route('announcement.index')->with('info', 'Announcement Updated Successfully');
    }

    public function delete(Request $request,$id)
    {
        $announcement = Notification::where('id', $id)->first();
        $announcement->delete();
        return redirect()->route('announcement.index')->with('error', 'Announcement Deleted Successfully');
    }

    public function publish(Request $request) {
        $announcement_id = $request->id;
        $announcement = Notification::find($announcement_id);
    
        if (!$announcement) {
            return response()->json(['success' => false, 'message' => 'Announcement not found.'], 404);
        }
    
        $announcement->is_published = 1;
        $announcement->publish_date = now()->toDateString();
        $announcement->save();
    
        return response()->json(['success' => true, 'message' => 'Announcement published successfully.']);
    }
    
    
    


}

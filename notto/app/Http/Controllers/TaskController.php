<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Submission;
use Carbon\Carbon;
use PHPUnit\Event\Telemetry\System;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Notifications\TaskDeadlineReminder;
use App\Models\Notification; 
use function Psy\debug;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();

        Task::where('status', 'pending')
            ->where('deadline', '<', $now)
            ->update(['status' => 'overdue']);
        $dueTasks = Task::where('deadline', '<=', Carbon::now()->addHours(2)) // Deadline trong vòng 2 giờ tới
            ->where('deadline', '>', Carbon::now()) // Deadline lớn hơn thời điểm hiện tại
            ->where('status', 'pending') // Chỉ lấy những task chưa hoàn thành
            ->where('uid', $request->user()->id) // Lọc theo user ID
            ->get();
            foreach ($dueTasks as $task) {
                // Kiểm tra xem thông báo đã được gửi cho task này chưa
                $notificationExists = Notification::where('notifiable_id', $request->user()->id)
                                                  ->where('data', 'LIKE', '%"task_id":'.$task->id.'%')
                                                  ->exists();
    
                if (!$notificationExists) {
                    // Tạo thông báo và lưu vào bảng notifications
                    Notification::create([
                        'type' => 'App\Notifications\TaskDeadlineReminder',
                        'notifiable_type' => 'App\Models\User',
                        'notifiable_id' => $request->user()->id,
                        'data' => json_encode([
                            'title' => 'Task Deadline Reminder',
                            'message' => "Task '{$task->title}' is due in less than 2 hours!",
                            'task_id' => $task->id,
                            'due_date' => $task->deadline, // Nếu deadline là datetime
                        ]),
                    ]);
                }
            }
        $date = $request->input('date', now()); 
        $currentDate = new Carbon($date);
        $startOfWeek = $currentDate->startOfWeek();
       
        $weekdays = [];
        for ($i = 0; $i < 7; $i++) {
            $day = clone $startOfWeek;
            $day->addDays($i);
            $weekdays[] = [
                'name' => $day->format('D'), // Tên ngày viết tắt
                'date' => $day->format('j'),  // Ngày trong tháng
                'fullDate' => $day->format('Y-m-d'), 
            ];
        }
    
        $user = Auth::user();
        $tasks = $user->tasksInWeek($startOfWeek)->groupBy(function($task) {
            return Carbon::parse($task->deadline)->format('Y-m-d'); // Group tasks by date
        });
    
        return view('home', compact('weekdays', 'tasks', 'currentDate'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        // Tạo task mới
        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->deadline = $request->input('deadline');
        $task->uid = Auth::id(); 

        $task->save();

        return redirect('/')->with('success', 'Task added successfully!');
    }
    public function showEditPage($id){
        
        $task = Task::find($id);
        if($task->assignee!= null && $task->uid!=Auth::user()->id)
            return redirect()->back()->with('error', 'permission denied');
        return view('editTask',compact('task'));
    }
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'status' => 'required|string|in:pending,completed', 
        ]);

        // Tìm task theo ID
        $task = Task::findOrFail($id);

        // Cập nhật dữ liệu task
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->deadline = $request->input('deadline');
        $task->status = $request->input('status');

        $task->save();
        return redirect()->back()->with('success', 'Task updated successfully');
    }
    public function delete($id){

        $task = Task::find($id);
        if($task->assignee!= null && $task->uid!=Auth::user()->id)
            return redirect()->back()->with('error', 'permission denied');
        $task->delete();
        return redirect()->back()->with('success', 'Task delete successfully');
    }

    public function showList(){
        $user = Auth::user();
        $tasks = $user->allTasks();
        $tasksFromOther = $user->taskFromOther();
        $completedTasks = $user->completedTasks();
        $incompletedTasks = $user->incompletedTasks();
        $overdueTasks = $user->overDueTasks();
        $tasksToOther = $user->taskToOther();
        return view('tasks', compact('tasks','completedTasks','incompletedTasks','overdueTasks','tasksToOther','tasksFromOther'));
    }
    public function markAsDone($id){
        $task = Task::find($id);
        if($task->assignee==null){
            if ($task->markAsDone()) {
                return redirect()->back()->with('success', 'Task marked as done successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to mark task as done.');
            }
        }else{
            return redirect('/submit/'. $id);
        }
    }
    public function markAsUnfinished($id){
        $task = Task::find($id);
        if ($task->markAsUnfinished()) {
            return redirect()->back()->with('success', 'Task marked as unfinished successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to mark task as unfinished.');
        }
    } 

    //đang phát triển
    public function showCreateAppointment(){
        return redirect()->back()->with('success', 'Feature under development');
    }
    public function showCreateEvent(){
        return redirect()->back()->with('success', 'Feature under development');
    }

    public function search(Request $request){
        $user = Auth::user();
        $keyword = $request->input('keyword');
        if (!$keyword) {
            $result = $user->allTasks();
        } else {
            $result = Task::where('uid', $user->id) 
            ->where(function($query) use ($keyword) {
                $query->where('title', 'LIKE', "%{$keyword}%")
                      ->orWhere('description', 'LIKE', "%{$keyword}%");
            })
            ->get();
        }
        return redirect('/')->with(['result'=> $result,'keyword'=>$keyword]);
    }
// task for others
    public function showAssignTaskPage(){
        
        return view('taskForOthers');
    }
    public function showSubmitPage($id){
        $task = Task::find($id);
        $links = $task->submissions;
        return view('/submit',compact('task','links'));
    }
    public function submit($id,Request $request){
        $task = Task::find($id);
        $links = $request->input('links');
        if ($links && is_array($links)) {
            // Duyệt qua từng link và lưu vào bảng submissions
            foreach ($links as $link) {
                $submission = new Submission();
                $submission->taskid = $task->id; 
                $submission->link = $link; 
                $submission->save(); 
            }
        }
    
        if ($task->markAsDone()) {
            return redirect('/')->with('success', 'Submitted successfully!');
        } else {
            return redirect('/')->back()->with('error', 'Failed to submit');
        }
    }
    public function assignTask(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'email'=>'required|email',
        ]);
        if ($request->input('email') === Auth::user()->email) {
            return redirect()->back()->withErrors(['email' => 'You cannot assign tasks to yourself!']);
        }
        $assignee = User::where('email', $request->input('email'))->first();
        if (!$assignee) {
            return redirect()->back()->withErrors(['email' => 'The email provided does not exist in our system!']);
        }
        // Tạo task mới
        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->deadline = $request->input('deadline');
        $task->uid = Auth::id(); 
        $task->assignee = $request->input('email'); 

        $task->save();
        return redirect()->back()->withSuccess('task has been sent successfully!');
    }
    public function back(){
        return redirect()->back();
    }

}

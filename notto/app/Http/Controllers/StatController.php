<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index(){
        $user = Auth::user();
        $completedTasks = $user->completedTasks();
        $overdueTasks = $user->overDueTasks();
        $total = count($user->tasks);
        $completed = count($completedTasks);
        $overdue = count($overdueTasks);
        $lated = count($user->latedTasks());
        $ontime = count($user->completedOntimeTasks());
        $pending = count($user->pendingTasks());
        return view('statistics',compact('total','completed','overdue','lated','ontime','pending'));
    }
}

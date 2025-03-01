<?php

namespace App\Http\Controllers;

use App\Models\CommonLetterLog;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard(Request $request)
    {
        $user = auth()->user();

        if ($user->hasRole("admin")) {
            return $this->adminDashboard();
        } else {
            return $this->userDashboard($request);
        }
    }

    protected function adminDashboard()
    {
        $users = User::role("user")->limit(10)->get();
        $totalUser = User::role("user")->count();
        $activeUser = User::role("user")->where("active", 1)->count();
        $inActiveUser = User::role("user")->where("active", 0)->count();

        return view('admin.dashboard.index', [
            "users" => $users,
            "totalUser" => $totalUser,
            "activeUser" => $activeUser,
            "inActiveUser" => $inActiveUser,
        ]);
    }

    protected function userDashboard(Request $request)
    {
        $letters = config("central.letter_types");
        $commonLetterLogs = CommonLetterLog::search($request->query("search"))
            ->published($request->query("published"))
            ->paginate(10);

        return view('user.dashboard.index', [
            "letters" => $letters,
            "commonLogs" => $commonLetterLogs,
        ]);
    }
}

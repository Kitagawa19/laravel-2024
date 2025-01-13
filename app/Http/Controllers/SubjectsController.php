<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\registration;
use App\Models\subject;

class SubjectsController extends Controller
{
    public function store(Request $request)
{
    $userId = Auth::id();
    $data = $request->input('schedule');

    if (empty($data)) {
        return back()->withErrors(['error' => '履修する科目を選択してください']);
    }

    try {
        DB::transaction(function () use ($data, $userId) {
            foreach ($data as $day => $periods) {
                $registeredSubjects = []; // 登録済み科目を追跡する配列

                foreach ($periods as $period => $subjectId) {
                    if (empty($subjectId)) {
                        continue;
                    }
                    if (isset($registeredSubjects[$subjectId])) {
                        $registeredSubjects[$subjectId]['end_period'] = $period;
                    } else {
                        $registeredSubjects[$subjectId] = [
                            'user_id' => $userId,
                            'subject_id' => $subjectId,
                            'start_period' => $period,
                            'end_period' => $period,
                        ];
                    }
                }

                foreach ($registeredSubjects as $subject) {
                    Registration::create($subject);
                }
            }
        });

        return redirect()->route('dashboard')->with('success', '履修登録が完了しました！');
    } catch (\Exception $e) {
        \Log::error('登録処理中にエラーが発生しました:', [
            'message' => $e->getMessage(),
            'user_id' => $userId,
            'data' => $data,
        ]);
        return back()->withErrors(['error' => '登録中にエラーが発生しました。']);
    }
}

}

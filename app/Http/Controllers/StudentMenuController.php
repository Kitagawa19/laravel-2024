<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CourseFilterRequest;

class StudentMenuController extends Controller{
    //全てのページを表示。必要に応じてフィルターを適用する。
    public function show(CourseFilterRequest $request){
        //データベースから取得
        /**
        * データベース完成後追加
         */
        $courses = [
            ['code' => 'CS101', 'name' => 'コンピュータサイエンス', 'teacher' => '田中太郎', 'term' => '前期', 'day' => '月', 'period' => '1', 'credits' => 2, 'status' => '登録済'],
            ['code' => 'MATH202', 'name' => '数学', 'teacher' => '佐藤花子', 'term' => '後期', 'day' => '水', 'period' => '2', 'credits' => 3, 'status' => '登録済'],
            ['code' => 'ENG303', 'name' => '英語', 'teacher' => '山田一郎', 'term' => '前期', 'day' => '金', 'period' => '1', 'credits' => 2, 'status' => '未登録'],
        ];

        //フィルタリング用のパラメータを取得
        $term = $request->input('term');
        $day = $request->input('day');
        $period = $request->input('period');
        $search = $request->input('search');

        // 初期状態で全ての授業を表示
        $filteredCourses = $courses;

        // フィルタリング処理
        if ($term) {
            $filteredCourses = array_filter($filteredCourses, fn($course) => $course['term'] == $term);
        }

        if ($day) {
            $filteredCourses = array_filter($filteredCourses, fn($course) => $course['day'] == $day);
        }

        if ($period) {
            $filteredCourses = array_filter($filteredCourses, fn($course) => $course['period'] == $period);
        }

        if ($search) {
            $filteredCourses = array_filter($filteredCourses, fn($course) => strpos($course['name'], $search) !== false);
        }

        // 合計単位数と登録科目数の計算
        $totalCredits = array_sum(array_column($filteredCourses, 'credits'));
        $totalCourses = count($filteredCourses);

        return view('studentMenu', [
            'courses' => $filteredCourses,
            'totalCredits' => $totalCredits,
            'totalCourses' => $totalCourses,
            'term' => $term,
            'day' => $day,
            'period' => $period,
            'search' => $search,
        ]);
    }
}
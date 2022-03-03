<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use App\Models\Student;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $student = Student::join('user', 'idStudent', '=', 'user.idUser')->where('idStudent', $id)->first()->toArray();
            if ($student != null) {
                $marks = Mark::where('Student', $id)->get();
                $total = 0;
                foreach ($marks as $mark) {
                    $total += $mark->Grade;
                }
                $average = $total / count($marks);
                return response()->json([
                    'idUser' => $student['idStudent'],
                    'Full_name' => $student['Full_name'],
                    'Average' => $average
                ]);
            } else
                return response()->json('El usuario no existe');
        } catch
        (\Exception $exception) {
            return response()->json($exception);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function markLower()
    {
        try {
            $students = Student::join('user', 'idStudent', '=', 'user.idUser')->join('mark', 'mark.Student', '=', 'student.idStudent')->where('Grade', '<=', '3')->get()->toArray();
            if ($students != null) {
                $studentsMap = [];
                foreach ($students as $student) {
                    $marks = Mark::select('idSubject', 'Name', 'Grade')->join('subject', 'Subject', '=', 'idSubject')->where('Grade', '<=', '3')->where('Student', $student['idStudent'])->get()->toArray();
                    $data = [
                        'user' => [
                            'idUser' => $student['idStudent'],
                            'Full_name' => $student['Full_name']
                        ],
                        'subjects' => $marks
                    ];
                    $studentsMap[] = $data;
                }

                return response()->json($studentsMap);
            } else
                return response()->json('El usuario no existe');
        } catch
        (\Exception $exception) {
            return response()->json($exception);
        }
    }

    public function order()
    {
        $array = [23, 10, 45, -3];
        $arrayOrder = $this->recursiveOrder($array);
        return response()->json($arrayOrder);
    }

    public function recursiveOrder(&$array)
    {
        if (is_array($array)) {

        }
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::join('user', 'idStudent', '=', 'user.idUser')->get();
        return response()->json($students);
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
        try {
            $request->validate([
                'idStudent' => 'required',
                'Course' => 'required'
            ]);

            $student = Student::create([
                'idStudent' => $request->get('idStudent'),
                'Course' => $request->get('Course'),
            ]);
            return response()->json($student);
        } catch (\Exception $exception) {
            return response()->json($exception);
        }
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
            $student = Student::join('user', 'idStudent', '=', 'user.idUser')->where('idStudent', $id)->get()->toArray();
            if ($student != null) {
                return response()->json($student);
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
        try {
            $user = User::where('idUser', $id)->get()->toArray();
            if ($user != null) {
                $request->validate([
                    'Full_name' => 'required',
                    'email' => 'required',
                    'Course' => 'required'
                ]);
                User::where('idUser', $id)->update([
                    'email' => $request->email,
                    'Full_name' => $request->Full_name
                ]);

                Student::where('idStudent', $id)->update([
                    'Course' => $request->Course,
                ]);

                return response()->json(Student::join('user', 'idStudent', '=', 'user.idUser')->where('idStudent', $id)->get());
            } else
                return response()->json('El usuario no existe');
        } catch (\Exception $exception) {
            return response()->json($exception);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::where('idUser', $id)->get()->toArray();
            if ($user != null) {
                Student::where('idStudent', $id)->delete();
                User::where('idUser', $id)->delete();
                return response()->json('true');
            } else
                return response()->json('El usuario no existe');

        } catch (\Exception $exception) {
            return response()->json($exception);
        }
    }
}

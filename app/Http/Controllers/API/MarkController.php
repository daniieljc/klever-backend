<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marks = Mark::select('idSubject', 'name', 'Student', 'Full_name', 'Grade')->join('user', 'Student', '=', 'user.idUser')->join('subject', 'idSubject', '=', 'Subject')->get();
        return response()->json($marks);
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
                'Grade' => 'required',
                'Student' => 'required',
                'Subject' => 'required'
            ]);

            $mark = Mark::create([
                'Subject' => $request->get('Subject'),
                'Student' => $request->get('Student'),
                'Grade' => $request->get('Grade'),
            ]);

            return response()->json($mark);
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
            $mark = Mark::select('idSubject', 'name', 'Student', 'Full_name', 'Grade')->join('user', 'Student', '=', 'user.idUser')->join('subject', 'idSubject', '=', 'Subject')->where('Student', $id)->get()->toArray();
            if ($mark != null) {
                return response()->json($mark);
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
            $mark = Mark::select('idSubject', 'name', 'Student', 'Full_name', 'Grade')->join('user', 'Student', '=', 'user.idUser')->join('subject', 'idSubject', '=', 'Subject')->where('Student', $id)->get()->toArray();
            if ($mark != null) {
                $request->validate([
                    'Grade' => 'required',
                    'Subject' => 'required'
                ]);

                $mark = Mark::where('Student', $id)->where('Subject', $request->get('Subject'))->update([
                    'Grade' => $request->Grade,
                ]);

                return response()->json($mark);
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
    public function destroy(Request $request, $id)
    {
        try {
            $mark = Mark::select('idSubject', 'name', 'Student', 'Full_name', 'Grade')->join('user', 'Student', '=', 'user.idUser')->join('subject', 'idSubject', '=', 'Subject')->where('Student', $id)->where('Subject', $request->get('Subject'))->get()->toArray();
            if ($mark != null) {
                Mark::where('Student', $id)->where('Subject', $request->get('Subject'))->delete();
                return response()->json('true');
            } else
                return response()->json('El usuario no existe');

        } catch (\Exception $exception) {
            return response()->json($exception);
        }
    }
}

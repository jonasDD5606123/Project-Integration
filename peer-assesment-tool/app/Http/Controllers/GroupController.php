<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display the groups management page.
     */
    public function index()
    {
        $groups = Group::with('students')->get();
        $available_students = Student::whereDoesntHave('group')->get();
        
        return view('docent.groupen-beheer', compact('groups', 'available_students'));
    }

    /**
     * Store a newly created group.
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_naam' => 'required|string|max:255'
        ]);

        Groep::create([
            'naam' => $request->group_naam
        ]);

        return redirect()->back()->with('success', 'Groep succesvol toegevoegd');
    }

    /**
     * Update the specified group.
     */
    public function update(Request $request, Groep $group)
    {
        $request->validate([
            'group_naam' => 'required|string|max:255'
        ]);

        $group->update([
            'naam' => $request->group_naam
        ]);

        return redirect()->back()->with('success', 'Groep succesvol bijgewerkt');
    }

    /**
     * Remove the specified group.
     */
    public function destroy(Group $group)
    {
        $group->students()->update(['group_id' => null]);
        $group->delete();

        return redirect()->back()->with('success', 'Groep succesvol verwijderd');
    }

    /**
     * Add a student to the group.
     */
    public function addStudent(Request $request, Group $group)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id'
        ]);

        $student = Student::findOrFail($request->student_id);
        $student->update(['group_id' => $group->id]);

        return redirect()->back()->with('success', 'Student succesvol toegevoegd aan groep');
    }

    /**
     * Remove a student from the group.
     */
    public function removeStudent(Group $group, Student $student)
    {
        $student->update(['group_id' => null]);

        return redirect()->back()->with('success', 'Student succesvol verwijderd uit groep');
    }
}
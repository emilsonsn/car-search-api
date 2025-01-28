<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(): array {
        return [
            'status' => true,
            'data' => Group::orderBy("id", "desc")->get()
        ];
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'group_id' => 'required|string',
        ]);

        $group = Group::create($request->all());

        return view('groups');

    }

    public function update(Request $request, $id) {
        $group = Group::find($id);

        if (!$group) {
            return ['status' => false, 'data' => 'Grupo não encontrado'];
        }

        $request->validate([
            'name' => 'sometimes|string',
            'group_id' => 'sometimes|string',
        ]);

        $group->update($request->all());

        return view('groups');
    }

    public function destroy($id) {
        $group = Group::find($id);
        
        if (!$group) {
            return ['status' => false, 'data' => 'Grupo não encontrado'];
        }
        
        $group->delete();

        return view('groups');
    }
}

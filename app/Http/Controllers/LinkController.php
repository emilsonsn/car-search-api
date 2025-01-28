<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index() {
        return response()->json([
            'status' => true,
            'data' => Link::orderBy("id", "desc")->get()
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'description' => 'required|string',
            'site' => 'required|string',
            'url' => 'required|string',
            'groups' => 'required|array',
        ]);

        $requestData = $request->all();
        $requestData['groups'] = json_encode($request->groups);

        $link = Link::create($requestData);

        return view('links');

    }

    public function update(Request $request, $id) {
        $link = Link::find($id);

        if (!$link) {
            return ['status' => false, 'data' => 'Link não encontrado'];
        }

        $request->validate([
            'description' => 'sometimes|string',
            'site' => 'sometimes|string',
            'url' => 'sometimes|string',
            'groups' => 'sometimes|array',
        ]);

        $requestData = $request->all();
        if ($request->has('groups')) {
            $requestData['groups'] = json_encode($request->groups);
        }

        $link->update($requestData);

        return view('links');
    }

    public function destroy($id) {
        $link = Link::find($id);
        
        if (!$link) {
            return ['status' => false, 'data' => 'Link não encontrado'];
        }
        
        $link->delete();

        return view('links');
    }
}

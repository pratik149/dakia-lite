<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;

class FieldController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return Field::select('id', 'title', 'type')->get();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required',
			'type' => 'required',
		]);

		$field = new Field;
		$field->title = $request->input('title');
		$field->type = $request->input('type');
		$field->save();
		return $field;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return Field::findorFail($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'title' => 'required',
			'type' => 'required',
		]);

		$field = Field::findorFail($id);
		$field->title = $request->input('title');
		$field->type = $request->input('type');
		$field->save();
		return $field;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$field = Field::findorFail($id);
		if ($field->delete()) {
			return 'deleted successfully';
		}
	}
}

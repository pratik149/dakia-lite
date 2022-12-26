<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

use App\Enums\SubscriberState;
use App\Enums\FieldType;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return Subscriber::select('id', 'name', 'email', 'state', 'created_at')
			->with('fields:id,title,type')
			->orderBy('created_at', 'DESC')
			->paginate(10);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$success = false;

		$this->validate($request, [
			'name' => ['required', 'string'],
			'email' => ['required', 'email:rfc,dns'],
			// 'state' => ['required', [new Enum(SubscriberState::class)]],
			'fields' => ['present', 'array'],
			'fields.*.id' => ['required', 'integer'],
			'fields.*.title' => ['required', 'string'],
			// 'fields.*.type' => ['required', [new Enum(FieldType::class)]],
		]);

		$subscriber = new Subscriber;
		$subscriber->name = $request->input('name');
		$subscriber->email = $request->input('email');
		$subscriber->state = $request->input('state');

		if ($subscriber->save()) {
			$fieldValuesToAttach = [];
			$fields = $request->input('fields');

			foreach ($fields as $field) {
				$fieldValues = [
					'text_value' => null,
					'number_value' => null,
					'date_value' => null,
					'boolean_value' => null,
				];
				if ($field['type'] === FieldType::Text->value) {
					$fieldValues['text_value'] = $field['value'];
				} else if ($field['type'] === FieldType::Number->value) {
					$fieldValues['number_value'] = $field['value'];
				} else if ($field['type'] === FieldType::Date->value) {
					$fieldValues['date_value'] = $field['value'];
				} else if ($field['type'] === FieldType::Boolean->value) {
					$fieldValues['boolean_value'] = $field['value'];
				}
				$fieldValuesToAttach[$field['id']] =  $fieldValues;
			}

			$subscriber->fields()->attach($fieldValuesToAttach);
			$success = true;
		}

		if (!$success) {
			return [
				'success' => false,
				'message' => 'Failed to save',
				'data' => null,
			];
		}
		return [
			'success' => true,
			'message' => 'Saved successfully',
			'data' => $subscriber,
		];
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return Subscriber::select('id', 'name', 'email', 'state', 'created_at')
			->with('fields:id,title,type')
			->findOrFail($id);
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
		$success = false;

		$this->validate($request, [
			'name' => ['required', 'string'],
			'email' => ['required', 'email:rfc,dns'],
			// 'state' => ['required', [new Enum(SubscriberState::class)]],
			'fields' => ['present', 'array'],
			'fields.*.id' => ['required', 'integer'],
			'fields.*.title' => ['required', 'string'],
			// 'fields.*.type' => ['required', [new Enum(FieldType::class)]],
		]);

		$subscriber = Subscriber::findorFail($id);
		$subscriber->name = $request->input('name');
		$subscriber->email = $request->input('email');
		$subscriber->state = $request->input('state');

		if ($subscriber->save()) {
			$fieldValuesToAttach = [];
			$fields = $request->input('fields');

			foreach ($fields as $field) {
				$fieldValues = [
					'text_value' => null,
					'number_value' => null,
					'date_value' => null,
					'boolean_value' => null,
				];
				if ($field['type'] === FieldType::Text->value) {
					$fieldValues['text_value'] = $field['value'];
				} else if ($field['type'] === FieldType::Number->value) {
					$fieldValues['number_value'] = $field['value'];
				} else if ($field['type'] === FieldType::Date->value) {
					$fieldValues['date_value'] = $field['value'];
				} else if ($field['type'] === FieldType::Boolean->value) {
					$fieldValues['boolean_value'] = $field['value'];
				}
				$fieldValuesToAttach[$field['id']] =  $fieldValues;
			}

			$subscriber->fields()->sync($fieldValuesToAttach);
			$success = true;
		}

		if (!$success) {
			return [
				'success' => false,
				'message' => 'Failed to update',
				'data' => null,
			];
		}
		return [
			'success' => true,
			'message' => 'Updated successfully',
			'data' => $subscriber,
		];
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$subscriber = Subscriber::findorFail($id); //searching for object in database using ID

		if (!$subscriber->delete()) {
			return [
				'success' => false,
				'message' => 'Failed to delete'
			];
		}

		return [
			'success' => true,
			'message' => 'Deleted Successfully'
		];
	}
}

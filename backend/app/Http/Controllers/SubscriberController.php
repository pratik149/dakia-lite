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
		$subscribers = Subscriber::select('id', 'name', 'email', 'state', 'created_at')
			->with('fields:id,title,type')
			->orderBy('created_at', 'DESC')
			->paginate(10);

		return $subscribers;
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
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'email:rfc,dns', 'max:255'],
			'state' => ['required', new Enum(SubscriberState::class)],
			'fields' => ['required', 'array'],
			'fields.*.id' => ['required', 'integer'],
			'fields.*.title' => ['required', 'string'],
			'fields.*.type' => ['required', new Enum(FieldType::class)],
			'fields.*.value' => ['present'],
		]);

		$subscriber = new Subscriber;
		$subscriber->name = $request->input('name');
		$subscriber->email = $request->input('email');
		$subscriber->state = $request->enum('state', SubscriberState::class);

		$success = false;
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
		$subscriber = Subscriber::select('id', 'name', 'email', 'state', 'created_at')
			->with('fields:id,title,type')
			->findOrFail($id);

		return $subscriber;
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
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'email:rfc,dns', 'max:255'],
			'state' => ['required', new Enum(SubscriberState::class)],
			'fields' => ['required', 'array'],
			'fields.*.id' => ['required', 'integer'],
			'fields.*.title' => ['required', 'string'],
			'fields.*.type' => ['required', new Enum(FieldType::class)],
			'fields.*.value' => ['present'],
		]);

		$subscriber = Subscriber::findOrFail($id);
		$subscriber->name = $request->input('name');
		$subscriber->email = $request->input('email');
		$subscriber->state = $request->enum('state', SubscriberState::class);

		$success = false;
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
		$subscriber = Subscriber::findOrFail($id); //searching for object in database using ID

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

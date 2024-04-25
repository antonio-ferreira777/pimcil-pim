<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFieldRequest;
use App\Http\Requests\UpdateFieldRequest;
use App\Http\Resources\Admin\FieldResource;
use App\Models\Field;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FieldsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('field_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FieldResource(Field::with(['form_blocs', 'taxonomies', 'channels', 'languages', 'countries', 'entities', 'status'])->get());
    }

    public function store(StoreFieldRequest $request)
    {
        $field = Field::create($request->all());
        $field->form_blocs()->sync($request->input('form_blocs', []));
        $field->taxonomies()->sync($request->input('taxonomies', []));
        $field->channels()->sync($request->input('channels', []));
        $field->languages()->sync($request->input('languages', []));
        $field->countries()->sync($request->input('countries', []));
        $field->entities()->sync($request->input('entities', []));

        return (new FieldResource($field))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Field $field)
    {
        abort_if(Gate::denies('field_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FieldResource($field->load(['form_blocs', 'taxonomies', 'channels', 'languages', 'countries', 'entities', 'status']));
    }

    public function update(UpdateFieldRequest $request, Field $field)
    {
        $field->update($request->all());
        $field->form_blocs()->sync($request->input('form_blocs', []));
        $field->taxonomies()->sync($request->input('taxonomies', []));
        $field->channels()->sync($request->input('channels', []));
        $field->languages()->sync($request->input('languages', []));
        $field->countries()->sync($request->input('countries', []));
        $field->entities()->sync($request->input('entities', []));

        return (new FieldResource($field))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Field $field)
    {
        abort_if(Gate::denies('field_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

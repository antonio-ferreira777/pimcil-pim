<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormBlocRequest;
use App\Http\Requests\UpdateFormBlocRequest;
use App\Http\Resources\Admin\FormBlocResource;
use App\Models\FormBloc;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormBlocsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('form_bloc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FormBlocResource(FormBloc::with(['status'])->get());
    }

    public function store(StoreFormBlocRequest $request)
    {
        $formBloc = FormBloc::create($request->all());

        return (new FormBlocResource($formBloc))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FormBloc $formBloc)
    {
        abort_if(Gate::denies('form_bloc_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FormBlocResource($formBloc->load(['status']));
    }

    public function update(UpdateFormBlocRequest $request, FormBloc $formBloc)
    {
        $formBloc->update($request->all());

        return (new FormBlocResource($formBloc))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FormBloc $formBloc)
    {
        abort_if(Gate::denies('form_bloc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formBloc->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

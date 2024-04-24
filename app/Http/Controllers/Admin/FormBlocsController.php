<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFormBlocRequest;
use App\Http\Requests\StoreFormBlocRequest;
use App\Http\Requests\UpdateFormBlocRequest;
use App\Models\FormBloc;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FormBlocsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('form_bloc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FormBloc::with(['status'])->select(sprintf('%s.*', (new FormBloc)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'form_bloc_show';
                $editGate      = 'form_bloc_edit';
                $deleteGate    = 'form_bloc_delete';
                $crudRoutePart = 'form-blocs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('display_order', function ($row) {
                return $row->display_order ? $row->display_order : '';
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'status']);

            return $table->make(true);
        }

        return view('admin.formBlocs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('form_bloc_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.formBlocs.create', compact('statuses'));
    }

    public function store(StoreFormBlocRequest $request)
    {
        $formBloc = FormBloc::create($request->all());

        return redirect()->route('admin.form-blocs.index');
    }

    public function edit(FormBloc $formBloc)
    {
        abort_if(Gate::denies('form_bloc_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $formBloc->load('status');

        return view('admin.formBlocs.edit', compact('formBloc', 'statuses'));
    }

    public function update(UpdateFormBlocRequest $request, FormBloc $formBloc)
    {
        $formBloc->update($request->all());

        return redirect()->route('admin.form-blocs.index');
    }

    public function show(FormBloc $formBloc)
    {
        abort_if(Gate::denies('form_bloc_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formBloc->load('status', 'formBlocFields');

        return view('admin.formBlocs.show', compact('formBloc'));
    }

    public function destroy(FormBloc $formBloc)
    {
        abort_if(Gate::denies('form_bloc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formBloc->delete();

        return back();
    }

    public function massDestroy(MassDestroyFormBlocRequest $request)
    {
        $formBlocs = FormBloc::find(request('ids'));

        foreach ($formBlocs as $formBloc) {
            $formBloc->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

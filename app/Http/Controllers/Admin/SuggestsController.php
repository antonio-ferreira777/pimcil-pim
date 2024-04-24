<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySuggestRequest;
use App\Http\Requests\StoreSuggestRequest;
use App\Http\Requests\UpdateSuggestRequest;
use App\Models\Status;
use App\Models\Suggest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SuggestsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('suggest_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Suggest::with(['status'])->select(sprintf('%s.*', (new Suggest)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'suggest_show';
                $editGate      = 'suggest_edit';
                $deleteGate    = 'suggest_delete';
                $crudRoutePart = 'suggests';

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
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });
            $table->editColumn('editable', function ($row) {
                return $row->editable ? $row->editable : '';
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'status']);

            return $table->make(true);
        }

        return view('admin.suggests.index');
    }

    public function create()
    {
        abort_if(Gate::denies('suggest_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.suggests.create', compact('statuses'));
    }

    public function store(StoreSuggestRequest $request)
    {
        $suggest = Suggest::create($request->all());

        return redirect()->route('admin.suggests.index');
    }

    public function edit(Suggest $suggest)
    {
        abort_if(Gate::denies('suggest_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suggest->load('status');

        return view('admin.suggests.edit', compact('statuses', 'suggest'));
    }

    public function update(UpdateSuggestRequest $request, Suggest $suggest)
    {
        $suggest->update($request->all());

        return redirect()->route('admin.suggests.index');
    }

    public function show(Suggest $suggest)
    {
        abort_if(Gate::denies('suggest_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suggest->load('status');

        return view('admin.suggests.show', compact('suggest'));
    }

    public function destroy(Suggest $suggest)
    {
        abort_if(Gate::denies('suggest_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suggest->delete();

        return back();
    }

    public function massDestroy(MassDestroySuggestRequest $request)
    {
        $suggests = Suggest::find(request('ids'));

        foreach ($suggests as $suggest) {
            $suggest->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

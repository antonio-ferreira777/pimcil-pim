<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySuggestsValueRequest;
use App\Http\Requests\StoreSuggestsValueRequest;
use App\Http\Requests\UpdateSuggestsValueRequest;
use App\Models\Language;
use App\Models\Suggest;
use App\Models\SuggestsValue;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SuggestsValuesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('suggests_value_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SuggestsValue::with(['suggest', 'language'])->select(sprintf('%s.*', (new SuggestsValue)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'suggests_value_show';
                $editGate      = 'suggests_value_edit';
                $deleteGate    = 'suggests_value_delete';
                $crudRoutePart = 'suggests-values';

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
            $table->addColumn('suggest_name', function ($row) {
                return $row->suggest ? $row->suggest->name : '';
            });

            $table->editColumn('value', function ($row) {
                return $row->value ? $row->value : '';
            });
            $table->addColumn('language_name', function ($row) {
                return $row->language ? $row->language->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'suggest', 'language']);

            return $table->make(true);
        }

        return view('admin.suggestsValues.index');
    }

    public function create()
    {
        abort_if(Gate::denies('suggests_value_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suggests = Suggest::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.suggestsValues.create', compact('languages', 'suggests'));
    }

    public function store(StoreSuggestsValueRequest $request)
    {
        $suggestsValue = SuggestsValue::create($request->all());

        return redirect()->route('admin.suggests-values.index');
    }

    public function edit(SuggestsValue $suggestsValue)
    {
        abort_if(Gate::denies('suggests_value_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suggests = Suggest::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suggestsValue->load('suggest', 'language');

        return view('admin.suggestsValues.edit', compact('languages', 'suggests', 'suggestsValue'));
    }

    public function update(UpdateSuggestsValueRequest $request, SuggestsValue $suggestsValue)
    {
        $suggestsValue->update($request->all());

        return redirect()->route('admin.suggests-values.index');
    }

    public function show(SuggestsValue $suggestsValue)
    {
        abort_if(Gate::denies('suggests_value_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suggestsValue->load('suggest', 'language');

        return view('admin.suggestsValues.show', compact('suggestsValue'));
    }

    public function destroy(SuggestsValue $suggestsValue)
    {
        abort_if(Gate::denies('suggests_value_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suggestsValue->delete();

        return back();
    }

    public function massDestroy(MassDestroySuggestsValueRequest $request)
    {
        $suggestsValues = SuggestsValue::find(request('ids'));

        foreach ($suggestsValues as $suggestsValue) {
            $suggestsValue->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

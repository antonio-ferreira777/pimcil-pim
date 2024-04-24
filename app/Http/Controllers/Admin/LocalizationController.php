<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLocalizationRequest;
use App\Http\Requests\StoreLocalizationRequest;
use App\Http\Requests\UpdateLocalizationRequest;
use App\Models\Language;
use App\Models\Localization;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LocalizationController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('localization_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Localization::with(['language'])->select(sprintf('%s.*', (new Localization)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'localization_show';
                $editGate      = 'localization_edit';
                $deleteGate    = 'localization_delete';
                $crudRoutePart = 'localizations';

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
            $table->editColumn('data_table', function ($row) {
                return $row->data_table ? $row->data_table : '';
            });
            $table->editColumn('data', function ($row) {
                return $row->data ? $row->data : '';
            });
            $table->editColumn('data_value', function ($row) {
                return $row->data_value ? $row->data_value : '';
            });
            $table->addColumn('language_name', function ($row) {
                return $row->language ? $row->language->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'language']);

            return $table->make(true);
        }

        return view('admin.localizations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('localization_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $languages = Language::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.localizations.create', compact('languages'));
    }

    public function store(StoreLocalizationRequest $request)
    {
        $localization = Localization::create($request->all());

        return redirect()->route('admin.localizations.index');
    }

    public function edit(Localization $localization)
    {
        abort_if(Gate::denies('localization_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $languages = Language::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $localization->load('language');

        return view('admin.localizations.edit', compact('languages', 'localization'));
    }

    public function update(UpdateLocalizationRequest $request, Localization $localization)
    {
        $localization->update($request->all());

        return redirect()->route('admin.localizations.index');
    }

    public function show(Localization $localization)
    {
        abort_if(Gate::denies('localization_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $localization->load('language');

        return view('admin.localizations.show', compact('localization'));
    }

    public function destroy(Localization $localization)
    {
        abort_if(Gate::denies('localization_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $localization->delete();

        return back();
    }

    public function massDestroy(MassDestroyLocalizationRequest $request)
    {
        $localizations = Localization::find(request('ids'));

        foreach ($localizations as $localization) {
            $localization->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

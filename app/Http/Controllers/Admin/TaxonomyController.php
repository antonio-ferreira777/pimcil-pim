<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTaxonomyRequest;
use App\Http\Requests\StoreTaxonomyRequest;
use App\Http\Requests\UpdateTaxonomyRequest;
use App\Models\Status;
use App\Models\Taxonomy;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TaxonomyController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('taxonomy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Taxonomy::with(['status'])->select(sprintf('%s.*', (new Taxonomy)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'taxonomy_show';
                $editGate      = 'taxonomy_edit';
                $deleteGate    = 'taxonomy_delete';
                $crudRoutePart = 'taxonomies';

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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'status']);

            return $table->make(true);
        }

        return view('admin.taxonomies.index');
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.taxonomies.create', compact('statuses'));
    }

    public function store(StoreTaxonomyRequest $request)
    {
        $taxonomy = Taxonomy::create($request->all());

        return redirect()->route('admin.taxonomies.index');
    }

    public function edit(Taxonomy $taxonomy)
    {
        abort_if(Gate::denies('taxonomy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $taxonomy->load('status');

        return view('admin.taxonomies.edit', compact('statuses', 'taxonomy'));
    }

    public function update(UpdateTaxonomyRequest $request, Taxonomy $taxonomy)
    {
        $taxonomy->update($request->all());

        return redirect()->route('admin.taxonomies.index');
    }

    public function show(Taxonomy $taxonomy)
    {
        abort_if(Gate::denies('taxonomy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomy->load('status');

        return view('admin.taxonomies.show', compact('taxonomy'));
    }

    public function destroy(Taxonomy $taxonomy)
    {
        abort_if(Gate::denies('taxonomy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomy->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyRequest $request)
    {
        $taxonomies = Taxonomy::find(request('ids'));

        foreach ($taxonomies as $taxonomy) {
            $taxonomy->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

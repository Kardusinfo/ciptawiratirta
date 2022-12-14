@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.departure.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.departures.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.departure.fields.id') }}
                        </th>
                        <td>
                            {{ $departure->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.departure.fields.departure_date') }}
                        </th>
                        <td>
                            {{ $departure->departure_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.departure.fields.procedure') }}
                        </th>
                        <td>
                            {{ $departure->procedure }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.departure.fields.candidate') }}
                        </th>
                        <td>
                            {{ $departure->candidate->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.departures.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
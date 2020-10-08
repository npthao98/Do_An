@extends('admin_master')

@section('content')
<br>
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ trans('text.product') }}</h1>
        </div>
    </div>

    <table id="example" class="table table-striped table-bordered table-width">
        <thead>
            <tr>
                <th>{{ trans('text.name') }}</th>
                <th>{{ trans('text.phone') }}</th>
                <th>{{ trans('text.email') }}</th>
                <th>{{ trans('text.street_address') }}</th>
                <th>{{ trans('text.role') }}</th>
                <th>{{ trans('text.options') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name ?? '' }}</td>
                    <td>{{ $user->phone ?? '' }}</td>
                    <td>{{ $user->email ?? '' }}</td>
                    <td>{{ $user->address ?? '' }}</td>
                    <td>
                        @if ($user->role == config('user.admin'))
                            {{ trans('header.admin') }}
                        @else
                            {{ trans('text.user') }}
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.change_role', $user->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success">{{ trans('text.change_role') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>{{ trans('text.name') }}</th>
                <th>{{ trans('text.phone') }}</th>
                <th>{{ trans('text.email') }}</th>
                <th>{{ trans('text.street_address') }}</th>
                <th>{{ trans('text.role') }}</th>
                <th>{{ trans('text.options') }}</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

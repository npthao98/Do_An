@extends('admin_master')

@section('content')
<br>
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ trans('text.user') }}</h1>
        </div>
    </div>cch

    <table id="example" class="table table-striped table-bordered table-width">
        <thead>
            <tr>
                <th>{{ trans('text.name') }}</th>
                <th>{{ trans('text.email') }}</th>
                <th>{{ trans('text.address') }}</th>
                <th>{{ trans('text.role') }}</th>
                <th>{{ trans('text.options') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->first_name . ' ' . $user->midd_name . ' ' . $user->last_name }}</td>
                    <td>
                        @if (isset($user->employee))
                            {{ $user->employee->internal_mail }}
                        @else
                            {{ $user->customer->email }}
                        @endif
                    </td>
                    <td>{{ $user->apartment_number . ' - ' . $user->street . ' - ' . $user->district . ' - ' . $user->city }}</td>
                    <td>
                        @if (isset($user->employee))
                            {{ trans('header.admin') }}
                        @else
                            {{ trans('text.user') }}
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="">
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
                <th>{{ trans('text.email') }}</th>
                <th>{{ trans('text.address') }}</th>
                <th>{{ trans('text.role') }}</th>
                <th>{{ trans('text.options') }}</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

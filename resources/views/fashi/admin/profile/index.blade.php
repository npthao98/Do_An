@extends('admin_master')

@section('content')
<br>
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ trans('text.user') }}</h1>
        </div>
    </div>

    <table id="example" class="table table-striped table-bordered table-width">
        <thead>
            <tr>
                <th>{{ trans('text.name') }}</th>
                <th>{{ trans('text.email') }}</th>
                <th>{{ trans('text.address') }}</th>
                <th>{{ trans('text.role') }}</th>
                <th>{{ trans('text.status') }}</th>
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
                            <p class="badge badge-primary">{{ trans('header.admin') }}</p>
                        @else
                            <p class="badge badge-info">{{ trans('text.user') }}</p>
                        @endif
                    </td>
                    <td>
                        @if ($user->deleted_at == null)
                            <p class="badge badge-success">{{ trans('text.active') }}</p>
                        @else
                            <p class="badge badge-danger">{{ trans('text.unactive') }}</p>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" name="changePW" class="btn btn-primary" onclick="return confirm_reset()">
                                {{ trans('text.reset_password') }}
                            </button>
                            @if ($user->deleted_at == null)
                                <button type="submit" name="lock" class="btn btn-danger" onclick="return confirm_lock()">
                                    {{ trans('text.lock_account') }}
                                </button>
                            @else
                                <button type="submit" name="unlock" class="btn btn-warning" onclick="return confirm_unlock()">
                                    {{ trans('text.unlock_account') }}
                                </button>
                            @endif
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

@section('js')
    <script>
        function confirm_reset() {
            return confirm('Do you want to reset password?');
        }
        function confirm_lock() {
            return confirm('Do you want to lock this account?');
        }

        function confirm_unlock() {
            return confirm('Do you want to unlock this account?');
        }
    </script>
@endsection

@extends('admin_master')

@section('content')
    <br>
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ trans('text.import') }}</h1>
            </div>
        </div>
        <div>
            <div class="float-left">
                <a href="{{ route('admin.imports.create') }}"><button class="btn btn-primary">{{ trans('text.create_import') }}</button></a>
            </div>
            <div class="float-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newSupplier">{{ trans('text.create_supplier') }}</button>

                <div class="modal fade" id="newSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ trans('text.create_supplier') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.suppliers.store') }}" method="post">
                                @csrf
                                <div class="p-3">
                                    <div class="form-group">
                                        <label for="name">@lang('text.name')</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="@lang('text.name')" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">@lang('text.address')</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="@lang('text.address')" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">@lang('text.description')</label>
                                        <textarea required type="text" class="form-control" id="description" name="description" placeholder="@lang('text.description')"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-primary" value="{{ trans('text.submit') }}">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('text.cancel') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
        </div>

        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <table id="example" class="table table-striped table-bordered table-width">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th>{{ trans('text.supplier') }}</th>
                <th>{{ trans('text.date') }}</th>
                <th>{{ trans('text.employee') }}</th>
                <th>{{ trans('text.total_price') }}</th>
                <th>{{ trans('text.options') }}</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($imports as $index => $import)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $import->supplier->name ?? '' }}</td>
                        <td>{{ $import->date ?? '' }}</td>
                        <td>
                            {{ $import->employee->person->first_name . ' ' . $import->employee->person->last_name }}
                        </td>
                        <td>
                            ${{ number_format($import->total_price) ?? ''}}
                        </td>
                        <td>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalDelete-{{ $import->id }}">{{ trans('text.show') }}</button>

                            <div class="modal fade" id="exampleModalDelete-{{ $import->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ trans('text.details') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">{{ trans('text.details') }}</th>
                                                    <th scope="col">{{ trans('text.total_price') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $count = 1 @endphp
                                                @foreach ($import->itemImports as $item)
                                                    <tr>
                                                        <th scope="row">{{ $count++ }}</th>
                                                        <td>{{  $item->productInfor->product->name }} x {{ $item->quantity }} ({{ $item->productInfor->color }} - {{ $item->productInfor->size }})</td>
                                                        <td>${{ number_format($item->quantity * $item->productInfor->product->price_import ) }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('text.close') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

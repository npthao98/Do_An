@extends('admin_master')

@section('content')
<br>
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ trans('text.category') }}</h1>
        </div>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCreate">{{ trans('text.create_category') }}</button>
    <br><br>

    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif

    @error('name')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror

    <div class="modal fade" id="exampleModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('text.new_category') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">{{ trans('text.name') }}:</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required="">
                        </div>

                        <div class="form-group">
                            <label for="parent_id" class="col-form-label">{{ trans('text.parent') }}:</label>
                            <select class="form-control" name="parent_id" id="parent_id" value="{{ old('parent_id') }}">
                                <option value="">{{ trans('text.select_parent') }}</option>
                                @foreach ($categories as $category)
                                    @if ($category->parent_id == null)
                                        <option
                                          value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">{{ trans('text.close') }}</button>
                            <button class="btn btn-primary">{{ trans('text.create_category') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table id="example" class="table table-striped table-bordered table-width">
        <thead>
            <tr>
                <th>{{ trans('text.name') }}</th>
                <th>{{ trans('text.parent') }}</th>
                <th>{{ trans('text.options') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name ?? ''}}</td>
                    <td><b>{{ $category->parent->name ?? ''}}</b></td>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalEdit-{{ $category->id }}">{{ trans('text.edit') }}</button>

                        <div class="modal fade" id="exampleModalEdit-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('text.edit') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="name" class="col-form-label">{{ trans('text.name') }}:</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required="" value="{{ $category->name }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="parent_id" class="col-form-label">{{ trans('text.parent') }}:</label>
                                                <select class="form-control" name="parent_id" id="parent_id">
                                                    <option value="">{{ trans('text.select_parent') }}</option>
                                                    @foreach ($categories as $cate)
                                                        @if($cate->parent_id == null)
                                                            <option
                                                            value="{{ $cate->id }}" {{ (isset($category->parent) && $cate->id == $category->parent->id) || ($cate->id == old('parent_id')) ? 'selected' : '' }}>
                                                            {{ $cate->name }}

                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">{{ trans('text.close') }}</button>
                                                <button class="btn btn-primary">{{ trans('text.create_category') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalDelete-{{ $category->id }}">{{ trans('text.delete') }}</button>

                        <div class="modal fade" id="exampleModalDelete-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('text.delete_category') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        {{ trans('text.are_you_sure') }}
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('text.close') }}</button>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary">{{ trans('text.yes') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>{{ trans('text.name') }}</th>
                <th>{{ trans('text.parent') }}</th>
                <th>{{ trans('text.options') }}</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

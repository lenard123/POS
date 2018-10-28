@extends('template.main')

@section('title', 'Category')

@section('nav')

    @include('template.header')
    @include('template.adminnav', ['active'=>'category'])

@endsection

@section('body')

<h1 id="title">New Category</h1>
<hr/>

@include('template.errors')
@include('template.success')

<form method="POST" action="{{ route('category') }}" id="category-form">
    @csrf
    <input type="hidden" name="_method" value="POST" id="method">
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" value="{{ old('name') }}" id="name" name="name" class="form-control" required>
    </div>

    <div class="form-group">
        <input type="submit" id="submit" class="btn btn-primary" value="Submit"/>
        <input type="button" id="cancel" value="Cancel" class="btn btn-outline-secondary d-none" onclick="window.cancel()" />
    </div>
</form>

<h1>Category List</h1>
<hr/>
<div class="table-responsive">

<table class="table table-striped table-hover">
    <tr>
        <th>ID</th>
        <th>DATE/TIME ADDED</th>
        <th>NAME</th>
        @if (request()->user()->type == $conf::ROLE_ADMIN)
        <th>ACTION</th>
        @endif
    </tr>

    @if ($categories->count() <= 0)
    <tr>
        <td colspan="4" class="text-center">No Category</td>
    </tr>
    @endif

    @foreach ($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->created_at }}</td>
        <td>{{ $category->name }}</td>
        @if (request()->user()->type == $conf::ROLE_ADMIN)
        <td>
            <button class="px-1 pt-1 pb-1 btn btn-primary" onclick="update('{{ $category->name }}', '{{ $category->id }}')">Edit</button>
            <button class="px-1 pt-1 pb-1 btn btn-danger delete" id="{{ $category->id }}">Delete</button>
        </td>
        @endif
    </tr>
    @endforeach
</table>

</div>

@component('template.modal', ['id'=>'delete_modal'])

    @slot('header')
        Delete Category?
    @endslot

    Are you sure to delete this category?

    <form id="delete_form" method="POST">
        @method('DELETE')
        @csrf
        <div class="form-group">
            <label for="password">
                <strong>For security reason</strong>
            </label>
            <input type="password" name="password" class="form-control" id="password" required placeholder="Enter your password">
        </div>
        <input type="submit" class="d-none">
    </form>


    @slot('footer')
        <button class="btn btn-danger" onclick="$('#delete_form').submit()">Delete</button>
        <button class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
    @endslot
@endcomponent
 
@endsection


@if (request()->user()->type == $conf::ROLE_ADMIN)
@section('script')
<script>

$('.delete').click(function () {
    var action = "{{ route('category') }}"+"/"+this.id;
    $('#delete_form').attr('action', action);
    $('#delete_modal').modal();
});

var update = function (name, id) {
   var form = $('#category-form');
   $('#title').html('Update Category');
   form.attr('action', '{{ route("category") }}'+'/'+id);
   $('#method').val('PUT');
   $('#name').val(name);
   $('#cancel').removeClass('d-none');
   $('#submit').val('Update');
}

var cancel = function() {
    var form = $('#category-form');
    $('#title').html('New Category');
    form.attr('action', '{{ route("category") }}');
    $('#method').val('POST');
    $('#name').val('');
    $('#cancel').addClass('d-none');
    $('#submit').val('Submit');
}

</script>
@endsection
@endif
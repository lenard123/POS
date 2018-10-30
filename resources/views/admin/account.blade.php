@extends('template.main')


@section('title', 'Manage Account')


@section('nav')
    @include('template.header')
    @include('template.adminnav', ['active'=>'account'])
@endsection


@section('body')
    <div class="row">
        <div class="col-md-5" id="addaccount">
            <h1>Add Account</h1>

            @include('template.success')
            @include('template.errors')

            <hr/>

            <form method="POST">

                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="type">Account Type</label>
                    <select name="type" name="type" id="type" class="form-control">
                        <option value="4" selected disabled>-- Select Account Type --</option>
                        @foreach ($util::getTypes() as $type_id => $type_value)
                        <option value="{{ $type_id }}" {{ old('type') === $type_id ? 'selected':''}}>{{ $type_value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-info">Add Account</button>
                    <button type="button" class="btn btn-primary" onclick="updateAccount()">Update Account</button>
                </div>

            </form>
        </div>

        <div class="col-md-5 d-none" id="updateaccount">
            <h1>Update Account</h1>

            @include('template.success')
            @include('template.errors')

            <hr/>

            <form method="POST" id="update_user">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ request()->user()->name }}" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ request()->user()->email }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="For security reason, Enter your password" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <button type="button" class="btn btn-outline-secondary" onclick="updatePassword()">Change Password</button>
                    <button type="button" class="btn btn-primary" onclick="addAccount()">Add Account</button>
                </div>
            </form>

            <form method="POST" class="d-none" action="{{ route('account') }}/password" id="update_password">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label id="old_password">Old Password</label>
                    <input type="password" name="old_password" id="old_password" class="form-control" required="">
                </div>

                <div class="form-group">
                    <label id="password">New Password</label>
                    <input type="password" name="password" id="password" class="form-control" required="">
                </div>

                <div class="form-group">
                    <label id="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required="">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-info">Update Password</button>
                    <button type="button" class="btn btn-outline-secondary" onclick="updateUser()">Back</button>
                </div>
        </div>

        <div class="col-md-7">

            <h1>Registered Account</h1>

            <hr/>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Account Type</th>
                        <th>E-mail</th>
                        <th>Action</th>
                    </tr>
                    @if (count($users) - 1 <= 0)
                        <tr>
                            <td colspan="4" class="text-center">No other accounts</td>
                        </tr>
                    @endif

                    @foreach($users as $user)
                        @if ($user->id != request()->user()->id)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $util::getTypes($user->type) }}</td>
                                <td>{{ $user->email }}</td>
                                <td><button class="pt-0 pb-0 btn btn-danger delete" id="{{ $user->id }}">Delete</button></td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>

        </div>

    </div>
@endsection

@component('template.modal', ['id'=>'delete_modal'])

    @slot('header')
        Delete User?
    @endslot

    Are you sure to delete this user?

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

@section('script')

    <script>
        var updateAccount = function () {
            switchView('#updateaccount', '#addaccount');
        }
        var addAccount = function () {
            switchView('#addaccount', '#updateaccount');
        }
        var updatePassword = function () {
            switchView('#update_password', '#update_user');
        }
        var updateUser = function () {
            switchView('#update_user', '#update_password');
        }

        var switchView = function (show, hide){
            $(show).removeClass('d-none');
            $(hide).addClass('d-none');
        }

        $('.delete').click(function () {
            var action = "{{ route('account') }}/"+this.id;
            $('#delete_form').attr('action', action);
            $('#delete_modal').modal();
        });
    </script>

@endsection

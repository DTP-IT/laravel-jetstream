<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Add user') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <!-- /.col -->
              <div class="col-md-12">
                <div class="card">
                  @include('includes.alert')
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="active tab-pane" id="settings">
                        <form action="{{ route('user.store') }}" method="post" class="form-horizontal" id="frmAddUSer">
                          @csrf {{ csrf_field() }}
                          <strong class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</strong>
                          <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"  placeholder="Name" />
                            </div>
                            <small id="errorName" class="form-text text-danger"></small>
                          </div>
                          <strong class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</strong>
                          <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}"  placeholder="Email" />
                            </div>
                            <small id="errorEmail" class="form-text text-danger"></small>
                          </div>
                          <strong class="text-danger">{{ $errors->has('level') ? $errors->first('level') : '' }}</strong>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Level</label>
                            <div class="col-sm-10">
                              <div class="form-group">
                                <label for="level"></label>
                                <select class="form-control" name="level" id="level">
                                  <option value="User">User</option>
                                  <option value="Admin">Admin</option>
                                </select>
                              </div>
                            </div>
                            <small id="errorLevel" class="form-text text-danger"></small>
                          </div>
                          <strong class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</strong>
                          <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="password" value="{{ old('password') }}" id="password" placeholder="Password"/>
                            </div>
                            <small id="errorPasswd" class="form-text text-danger"></small>
                          </div>
                          <strong class="text-danger">{{ $errors->has('confirmPassword') ? $errors->first('confirmPassword') : '' }}</strong>
                          <div class="form-group row" id="confirm">
                            <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="confirmPassword" value="{{ old('confirmPassword') }}" id="confirmPassword" placeholder="Confirm Password"/>
                            </div>
                            <small id="errorConfirmPassword" class="form-text text-danger"></small>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                </label>
                              </div>
                            </div>
                          </div>
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-success"  id="btnSave">Save</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
    </div>
  </div>
</x-app-layout>

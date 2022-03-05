<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Update user') }}
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
                          <form action="{{ route('user.update', [$user->id]) }}" method="post" class="form-horizontal" id="frmUpdateUSer">
                            @csrf {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">
                            <strong class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</strong>
                            <div class="form-group row">
                              <label for="title" class="col-sm-2 col-form-label">Name</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ? old('name') : $user->name }}"  placeholder="Name" />
                              </div>
                              <small id="errorName" class="form-text text-danger"></small>
                            </div>
                            <strong class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</strong>
                            <div class="form-group row">
                              <label for="email" class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') ? old('email') : $user->email }}"  placeholder="Email" />
                              </div>
                              <small id="errorEmail" class="form-text text-danger"></small>
                            </div>
                            <strong class="text-danger">{{ $errors->has('level') ? $errors->first('level') : '' }}</strong>
                            <div class="form-group row">
                              <label for="inputName" class="col-sm-2 col-form-label">Role</label>
                              <div class="col-sm-10">
                                <div class="form-group">
                                  <label for="level"></label>
                                  <select class="form-control" name="role" id="role">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->hasRole($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <small id="errorLevel" class="form-text text-danger"></small>
                            </div>
                              <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-success"  id="btnSave">Update</button>
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
  
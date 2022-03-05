<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Permission') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    @if(session('message'))
                      <div class="card-header p-2">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                          </button>
                          <strong>Notify!!</strong> {{ session('message') }}
                        </div>
                      </div>
                    @endif
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Role</th>
                          <th>Permission</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($dataRole as $role)
                        <tr>
                          <td>{{ $role->name}}</td>
                          <form action="{{ route('user.insertPermission') }}" method="post">
                            @csrf {{ csrf_field() }}
                            <input type="text" name="id" id="{{ $role->id }}" value="{{ $role->id }}" hidden>
                            <td>
                              @foreach($dataPermission as $permission)
                              <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" name="permission[]" id="{{ $permission->id }}" value="{{ $permission->id }}"
                                  {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>{{ $permission->name }}
                                </label>
                              </div>
                              @endforeach
                            </td>                           
                            <td><button type="submit" class="btn btn-success">Cấp quyền</button></td>
                          </form>    
                        </tr>
                        @endforeach 
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
    </div>
  </div>
</x-app-layout>

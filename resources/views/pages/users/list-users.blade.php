<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('List user') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    @can('add user')
                    <a class="btn btn-success" href="{{ route('user.create') }}"><i class="fas fa-plus"></i> Add</a>
                    @endcan
                    <div class="card-tools">
                      <form action="{{ route('user.search') }}" method="get">
                        <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="text" name="key" class="form-control float-right" placeholder="Search">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Role</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $user)
                          <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>@foreach($roles as $role){{ $user->hasRole($role->id) ? $role->name : '' }} @endforeach</td>
                            <td><a href="{{ route('user.edit', [$user->id]) }}" class="btn btn-success"><i class="fas fa-edit"></i></a></td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  {{ $data->links() }}
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

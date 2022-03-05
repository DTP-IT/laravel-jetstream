<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('List books') }}
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
                    <div id="alertDelete"></div>
                    <div id="alertRestore"></div>
                    @include('includes.alert')
                    @if (!isset($isSoftDelete))
                      <a class="btn btn-success" href="{{ route('book.create') }}"><i class="fas fa-plus"></i> Add</a>
                      <a class="btn btn-default" href="{{ route('book.showSoftDelete') }}"><i class="fas fa-plus"></i> View Book Deleted</a>
                    @endif
                    <div class="card-tools">
                      <form action="{{ route('book.search') }}" method="get">
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
                          <th>Title</th>
                          <th>Publisher</th>
                          <th>Category</th>
                          <th>User</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $books)
                          <tr>
                            <td>{{ $books->id }}</td>
                            <td>{{ $books->title }}</td>
                            <td>{{ $books->publisher }}</td>
                            <td>{{ $books->category_name }}</td>
                            <td>{{ $books->user_name }}</td>
                            <td>{{ $books->quantity }}</td>
                            <td>{{ $books->price }}</td>
                            <td>
                              @if (!isset($isSoftDelete)) 
                              <a href="{{ route('book.edit', [$books->id]) }}" class="btn btn-success"><i class="fas fa-edit"></i></a> || 
                              <button class="btn btn-warning btnDeleteBook" value={{ $books->id }}><i class="fas fa-trash"></i></button>
                              @else
                              <button class="btn btn-success btnRestoreBook" value={{ $books->id }}><i class="fas fa-edit"></i>Restore</button> 
                              @endif
                            </td>
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
              {{ $data->links() }}
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
    </div>
  </div>
</x-app-layout>

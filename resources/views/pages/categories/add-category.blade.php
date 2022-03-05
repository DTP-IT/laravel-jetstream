<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Add category') }}
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
                        <form action="{{ route('category.store') }}" method="post" class="form-horizontal" id="frmAddCategory">
                          @csrf {{ csrf_field() }}
                          <strong class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</strong>
                          <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"  placeholder="Name" />
                            </div>
                            <small id="errorName" class="form-text text-danger"></small>
                          </div>                    
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-success"  id="btnSave">Save</button>
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

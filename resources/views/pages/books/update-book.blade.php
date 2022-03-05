<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Add book') }}
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
                        <form action="{{ route('book.update', [$book->id]) }}" method="post" class="form-horizontal" id="frmUpdateBook">
                          @csrf {{ csrf_field() }}
                          <input name="_method" type="hidden" value="PUT">
                          <strong class="text-danger"> {{ $errors->has('title') ? $errors->first('title') : '' }}</strong>
                          <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="title" id="title" value="{{ old('title') ? old('title') : $book->title }}"  placeholder="Title" />
                            </div>
                            <small id="errorTitle" class="form-text text-danger"></small>
                          </div>
                          <strong class="text-danger">{{ $errors->has('publisher') ? $errors->first('publisher') : '' }}</strong>
                          <div class="form-group row">
                            <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="publisher" id="publisher" value="{{ old('publisher') ? old('publisher') : $book->publisher }}" placeholder="Publisher" />
                            </div>
                            <small id="errorPublisher" class="form-text text-danger"></small>
                          </div>
                          <strong class="text-danger">{{ $errors->has('category') ? $errors->first('category') : '' }}</strong>
                          <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                              <div class="form-group">
                                <select class="form-control" name="category" id="category">
                                  @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>{{ $category->name }}</option> 
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <small id="errorCategory" class="form-text text-danger"></small>
                          </div>
                          <strong class="text-danger">{{ $errors->has('quantity') ? $errors->first('quantity') : '' }}</strong>
                          <div class="form-group row">
                            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" name="quantity" id="quantity" value="{{ old('quantity') ? old('quantity') : $book->quantity }}"  placeholder="Quantity"/>
                            </div>
                          </div>
                          <strong class="text-danger">{{ $errors->has('price') ? $errors->first('price') : '' }}</strong>
                          <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="price" id="price" value="{{ old('price') ? old('price') : $book->price }}" placeholder="Price"/>
                            </div>
                          </div>
                          <div class="form-group row" id="confirm">
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

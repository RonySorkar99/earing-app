@extends('Admin.layout.index')

@section('Content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>


<section class="container ms-5">
    <div class="row">
      <div class="col-3"></div>
      <div class="col-md-6">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Add Video</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          @if(Session::has('video-posted'))
          <script>
              swal("Congratations", "{!!Session::get('video-posted')!!}","success",{
                  button: "ok"
              });
          </script>
          @endif
         <form action="{{Route('insert.video')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                  <label for="inputEstimatedBudget">Video Point</label>
                  <input type="number" name="video_coin" id="inputEstimatedBudget" class="form-control">
                  @error('video_coin')
                  <span class="text-danger">{{$message}}</span>
                     @enderror
                </div>
                <div class="form-group">
                    <label for="inputSpentBudget">Web Link</label>
                    <input type="text" name="web_link" id="inputSpentBudget" class="form-control">
                    @error('web_link')
                    <span class="text-danger">{{$message}}</span>
                       @enderror
                  </div>
                <div class="form-group">
                    <label for="formFile" class="form-label">Video</label>
                    <input name="video" class="form-control" type="file" id="formFile">
                    @error('video')
                    <span class="text-danger">{{$message}}</span>
                       @enderror
                </div>
                <div class="form-group">
                    <label for="formFile" class="form-label">Video Thumbnail </label>
                    <input name="thumbnail" class="form-control" type="file" id="formFile">
                    @error('thumbnail')
                    <span class="text-danger">{{$message}}</span>
                       @enderror
                </div>
                <input type="submit" value="Submit" class="btn btn-success float-right">
              </div>
         </form>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
    </div>

  </section>

@endsection

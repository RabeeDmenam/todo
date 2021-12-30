

<!DOCTYPE html>
<html lang="en">
<head>
  <title>todo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  <h2>Create todo </h2>
  <form  action="{{ url('/todo') }}" method="post" enctype="multipart/form-data">

    @csrf

  <div class="form-group">
    <label for="exampleInputName">Title</label>
    <input type="text" name="title" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter title" value="{{ old('title') }}">
  </div>
      <div class="form-group">
          <label for="exampleInputName">start date</label>
          <input type="date" name="startdate" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter start date" value="{{ old('title') }}">
      </div>

      <div class="form-group">
          <label for="exampleInputName">end date</label>
          <input type="date" name="enddate" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter end date" value="{{ old('title') }}">
      </div>

  <div class="form-group">
    <label for="exampleInputEmail">description</label>
       <textarea  name="description"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >{{old('description')}}</textarea>
  </div>


  <div class="form-group">
    <label for="exampleInputPassword">Image</label>
    <input type="file" name="image">
  </div>


  <button type="submit" class="btn btn-primary">Save</button>
</form>
</div>

</body>
</html>

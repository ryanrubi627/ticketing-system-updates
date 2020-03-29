@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection


@section('content2')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <h5 class="card-header navbar-black">Create Ticket</h5>
                <div class="card-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="pwd">Title:</label>
                            <input type="text" class="form-control" id="pwd1" name='title'>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name='name' id="name" value="{{ Auth::user()->name }}" hidden>
                        </div>

                        <div class="form-group">
                            <label for="comment">Description:</label>
                            <textarea class="form-control" rows="3" id="comment1" name='description'></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Importance:</label>
                            <select class="form-control" id="exampleFormControlSelect12" name='importance'>
                                <option>Urgent</option>
                                <option>Low</option>
                                <option>High</option>
                            </select>
                        </div><br>

                        <div class="form-group">
                            <input id="date" class="form-control" name="curTime" value="<?php echo date('d-m-Y')." ".gmdate("H:i:s", time()); ?>" size="20" maxlength="20"  hidden Required />
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="status" name='status' value="Open">
                        </div>
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            <input type = 'submit' class="btn btn-primary" value = "Create ticket" id="sbmt"/>
                    </div>
                </div>
            </div>
        </div>

<!---------------------------------DATABASE TABLE------------------------------------->        
        <div class="col-md-9">
            <button class="btn btn-primary" id="notification" style="float:right;">Notif.</button>
            <table class="table table-hover table-bordered" id="myTable">
                <thead class="thead-danger">
                    <tr>
                        <th>Ticket ID</th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Importance</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="tbody-white">
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->ticket_code }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->title }}</td>
                        <td>{{ $user->description }}</td>
                        <td>{{ $user->importance }}</td>
                        <td>{{ $user->date }}</td>
                        <td><a href="#" class="btn btn-primary edtbtn">Edit</a>
                            <button type="button" class="btn btn-primary" onclick="window.location='{{ url("/comment_page/$user->id") }}'">Thread</button>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection




<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">


            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

            <div class="form-group">
                <input type="hidden" class="form-control" id="ticket_number" name='Ticket_number'>
            </div>

            <div class="form-group">
                <label for="pwd">Title:</label>
                <input type="text" class="form-control" id="pwd" name='title1'>
            </div>

            <div class="form-group">
                <label for="comment">Description:</label>
                <textarea class="form-control" rows="3" id="comment" name='description1'></textarea>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Importance:</label>
                <select class="form-control" id="exampleFormControlSelect1" name='importance1'>
                    <option>Urgent</option>
                    <option>Low</option>
                    <option>High</option>
                </select>
            </div>     
        </div>
        <div class="modal-footer">
                <input type = 'submit' class="btn btn-primary" value = "Update" id="sbmt2" style="float:right"/>
        </div> 
      </div>
      
    </div>
  </div>

@section('content3')
<!------------------------NOTIFICATION MODAL--------------------------->
<div class="modal fade" id="notifModal" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <h5>Notification</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body"> 
            <table class="table table-hover table-bordered" id="myTable">
                <thead class="thead-danger">
                </thead>
                <tbody class="tbody-white">
                    @foreach ($notifications as $notification)
                    <tr>
                        <td>-{{ $notification->ticket_code }}-&nbsp&nbsp&nbsp{{ $notification->name }}&nbsp{{ $notification->text }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
      
    </div>
  </div>


<script>
  $(document).ready(function(){
  $('#notification').on('click', function(){
    $('#notifModal').modal('show');
  });
});
</script>

@endsection
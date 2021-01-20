@extends('admin.layout')

@section('content')
<div class="page-header">
  <h4 class="page-title">Quotes</h4>
  <ul class="breadcrumbs">
    <li class="nav-home">
      <a href="{{route('admin.dashboard')}}">
        <i class="flaticon-home"></i>
      </a>
    </li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.Reservation.quotes') }}">Reservation Management</a>
    </li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li class="nav-item">
      <a href="#">Reservation</a>
    </li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">

    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-6">
            <div class="card-title d-inline-block">Reservation</div>
          </div>
          <div class="col-lg-6">
            <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete"
              data-href="{{route('admin.quote.bulk.delete')}}"><i class="flaticon-interface-5"></i> Delete</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">

            <form action="{{ route('admin.Reservation.add') }}" method="POST" enctype="multipart/form-data">
              @csrf




              {{-- ##########################(end bg)################################### --}}
              <input type="submit" style="background: #011a25;" class="btn btn-primary btn-large btn-block"
                value="Add a new appointment" />
            </form>
            <br>
            @if(session()->has('alert-success'))
            <input type="submit" style="background: #011a25;background: #20a049;padding: 1%;font-size: 16px;"
              class="btn btn-success save btn-large btn-block" value="  {{ session()->get('alert-success') }}" />
            @endif

          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
        
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Send Mail Modal -->
<div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Send Mail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="ajaxEditForm" class="" action="{{route('admin.quotes.mail')}}" method="POST">
          @csrf
          <div class="form-group">
            <label for="">Client Mail **</label>
            <input id="inemail" type="text" class="form-control" name="email" value="" placeholder="Enter email">
            <p id="eerremail" class="mb-0 text-danger em"></p>
          </div>
          <div class="form-group">
            <label for="">Subject **</label>
            <input id="insubject" type="text" class="form-control" name="subject" value="" placeholder="Enter subject">
            <p id="eerrsubject" class="mb-0 text-danger em"></p>
          </div>
          <div class="form-group">
            <label for="">Message **</label>
            <textarea id="inmessage" class="form-control summernote" name="message" data-height="150"
              placeholder="Enter message"></textarea>
            <p id="eerrmessage" class="mb-0 text-danger em"></p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="updateBtn" type="button" class="btn btn-primary">Send Mail</button>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.min.js"></script>
<script>



       <script>
        $(function () {
          $("#date_input").on("change", function () {
            $(this).css("color", "rgba(0,0,0,0)").siblings(".datepicker_label").css({ "text-align":"center", position: "absolute",left: "10px", top:"14px",width:$(this).width()}).text($(this).val().length == 0 ? "" : ($.datepicker.formatDate($(this).attr("dateformat"), new Date($(this).val()))));
               });
        });
    </script>
</script>

@endsection
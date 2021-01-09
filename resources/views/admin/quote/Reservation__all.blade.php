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
      <a href="#">Quote Management</a>
    </li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li class="nav-item">
      <a href="#">Quotes</a>
    </li>
  </ul>
  <br>

</div>
<p>
  <a type="button" class="btn btn-primary btn-xs" href="{{ route('admin.Reservation.dr') }}">Add an appointment</a>
  <a type="button" class="btn btn-primary btn-xs" href="{{ route('admin.Reservation.default') }}">The default for appointments
    
  </a>
  <a type="button" class="btn btn-primary btn-xs" href="{{ route('admin.remind') }}">Remind</a>


</p>
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
            @if (count($quotes) == 0)
            <h3 class="text-center">NO QUOTE REQUEST FOUND</h3>
            @else
            <div class="table-responsive">
              <table class="table table-striped mt-3">
                <thead>
                  <tr>
                    <th scope="col">
                      <input type="checkbox" class="bulk-check" data-val="all">
                    </th>
                    <th scope="col">day</th>
                    <th scope="col">Number</th>
                    <th scope="col">From</th>
                    <th scope="col">to</th>
                    <th scope="col">Time</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($quotes as $key => $quote)
                  <tr>
                    <td>
                      <input type="checkbox" class="bulk-check" data-val="{{$quote->id}}">
                    </td>
                    <td>{{convertUtf8($quote->day)}}</td>
                    <td>{{convertUtf8($quote->Number)}}</td>
                    <td>{{convertUtf8($quote->From)}}</td>
                    <td>{{convertUtf8($quote->to)}}</td>
                    <td>{{convertUtf8($quote->Time)}}</td>
                    <td>
                    </td>
                    <td>
                      @php
                        $Available=$quote->status;
                        if($Available==$quote->Number){
                       
                          $status="Unavailable";
                          $bootstrap="btn btn-danger btn-xs";

                        }else{
                          $status="Available";
                          $bootstrap="btn btn-success btn-xs";

                        }  
                      @endphp
                      <button type="button" class="{{ $bootstrap }}">{{ $status }}</button>
                    </td>
                    <td>
                      <a type="submit" href="{{ route('admin.Reservation.edit', [$quote->id]) }}"
                        class="btn btn-info btn-sm ">
                        <span class="btn-label">
                          <i class="far fa-edit"></i>
                        </span>
                        Modification
                      </a>
                      <form class="deleteform d-inline-block" action="{{route('admin.Reservation.delete')}}"
                        method="post">
                        @csrf
                        <input type="hidden" name="quote_id" value="{{$quote->id}}">
                        <button type="submit" class="btn btn-warning btn-sm deletebtn">
                          <span class="btn-label">
                            <i class="fas fa-trash"></i>
                          </span>
                          Delete
                        </button>
                      </form>
                    </td>
                  </tr>

                  @endforeach
                </tbody>
              </table>
            </div>
            @endif
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="d-inline-block mx-auto">
            {{$quotes->links()}}
          </div>
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
@endsection
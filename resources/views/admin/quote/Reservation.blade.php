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
              {{-- ##########################(from bg)################################### --}}
   


              <div class="form-row">
                <div class="col-md-12 mb-4">
                  <label for="day">data</label>
                  <input type="date" placeholder="Please enter data" class="form-control" onclick="mydate();" name="day" id="ndt"
                    placeholder="" value="{{Request::old('day')}}">
                  @if ($errors->has('day'))
                  <div class="invalid-feedback">
                    {{ $errors->first('day') }}
                  </div>
                  @endif
                </div>
              </div>
              {{-- ############################################################# --}}
              <div class="form-row">
                <div class="col-md-12 mb-4">
                  <label for="Number">Number</label>
                  <input type="number" placeholder="Please enter data" class="form-control" name="Number" id="Number"
                    placeholder="" value="{{Request::old('Number')}}">
                  @if ($errors->has('Number'))
                  <div class="invalid-feedback">
                    {{ $errors->first('Number') }}
                  </div>
                  @endif
                </div>
              </div>
              {{-- ############################################################# --}}
              <div class="form-row">
                <div class="col-md-12 mb-4">
                  <label for="From">From</label>
                  <input type="number" placeholder="Please enter data" class="form-control" name="From" id="From"
                    placeholder="" value="{{Request::old('From')}}">
                  @if ($errors->has('From'))
                  <div class="invalid-feedback">
                    {{ $errors->first('From') }}
                  </div>
                  @endif
                </div>
              </div>
              {{-- ############################################################# --}}
              <div class="form-row">
                <div class="col-md-12 mb-4">
                  <label for="to">to</label>
                  <input type="number" placeholder="Please enter data" class="form-control" name="to" id="to"
                    placeholder="" value="{{Request::old('to')}}">
                  @if ($errors->has('to'))
                  <div class="invalid-feedback">
                    {{ $errors->first('to') }}
                  </div>
                  @endif
                </div>
              </div>
              {{-- ############################################################# --}}
              <div class="form-row">
                <select class="form-control" name="Time" data-show-subtext="true">
                  <option>AM</option>
                  <option>PM</option>
                </select>
                @if ($errors->has('Time'))
                <span class="helper-text" data-error="wrong" data-success="right">{{ $errors->first('Time') }}</span>
                @endif
              </div>
              {{-- ############################################################# --}}
              <br>
              <br>
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
<script>
  function mydate() {
    //alert("");
    document.getElementById("dt").hidden = false;
    document.getElementById("ndt").hidden = true;
  }

</script>
@endsection
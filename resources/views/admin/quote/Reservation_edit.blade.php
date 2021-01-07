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
      <a href="#">Reservation Management</a>
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

            <form action="{{ route('admin.Reservation.updata', [$reservation->id]) }}" method="POST" enctype="multipart/form-data">
              @csrf
              {{-- ##########################(from bg)################################### --}}
              <div class="form-row">
                <select class="form-control" name="day" data-show-subtext="true">
                  <option {{ ( $reservation->day == 'Saturday') ? 'selected' : '' }}>Saturday</option>
                  <option {{ ( $reservation->day == 'Sunday') ? 'selected' : '' }}>Sunday</option>
                  <option  {{ ( $reservation->day == 'Monday') ? 'selected' : '' }} >Monday</option>
                  <option  {{ ( $reservation->day == 'Tuesday') ? 'selected' : '' }} >Tuesday</option>
                  <option  {{ ( $reservation->day == 'Wednesday') ? 'selected' : '' }} >Wednesday</option>
                  <option  {{ ( $reservation->day == 'Thursday') ? 'selected' : '' }} >Thursday</option>
                  <option  {{ ( $reservation->day == 'Friday') ? 'selected' : '' }} >Friday</option>
                </select>
                @if ($errors->has('day'))
                <span class="helper-text" data-error="wrong" data-success="right">{{ $errors->first('day') }}</span>
                @endif
              </div>
              {{ $reservation->day}}



{{ $reservation->Time}}

              {{-- ############################################################# --}}
              <div class="form-row">
                <div class="col-md-12 mb-4">
                  <label for="Number">Number</label>
                  <input type="number" placeholder="Please enter data" class="form-control" name="Number" id="Number"
                    placeholder="" value="{{ $reservation->Number}}">
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
                    placeholder="" value="{{ $reservation->From}}">
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
                    placeholder="" value="{{ $reservation->to}}">
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
                  <option {{ ( $reservation->Time == 'AM') ? 'selected' : '' }} >AM</option>
                  <option {{ ( $reservation->Time == 'PM') ? 'selected' : '' }}>PM</option>
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
          
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection
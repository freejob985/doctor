@extends("front.$version.layout")

@section('pagename')
- {{__('Request A Quote')}}
@endsection

@section('meta-keywords', "$be->quote_meta_keywords")
@section('meta-description', "$be->quote_meta_description")

@section('content')
<!--   breadcrumb area start   -->
<div class="breadcrumb-area"
  style="background-image: url('{{asset('assets/front/img/' . $bs->breadcrumb)}}');background-size:cover;">
  <div class="container">
    <div class="breadcrumb-txt">
      <div class="row">
        <div class="col-xl-7 col-lg-8 col-sm-10">
          <span>{{convertUtf8($bs->quote_title)}}</span>
          <h1>{{convertUtf8($bs->quote_subtitle)}}</h1>
          <ul class="breadcumb">
            <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
            <li>{{__('Quote Page')}}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="breadcrumb-area-overlay"
    style="background-color: #{{$be->breadcrumb_overlay_color}};opacity: {{$be->breadcrumb_overlay_opacity}};"></div>
</div>
<!--   breadcrumb area end    -->
<form method="POST" action="{{ route('data.send') }}">
  @csrf
  <div class="quote-area pt-115 pb-115">
    <div class="container">
      <div class="form-row">
        <div class="col-md-12 mb-4">
          <input type="date" placeholder="Please enter data" class="form-control day" dateformat="d M y" name="day"
            id="date_input" placeholder="" value="{{Request::old('day')}}">
          <span class="datepicker_label" style="pointer-events: none;"></span>
          @if ($errors->has('day'))
          <div class="invalid-feedback">
            {{ $errors->first('day') }}
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</form>


<!--   quote area start   -->
<div class="quote-area pt-115 pb-115">
  <div class="container">
    <div class="row">

      <div class="col-lg-12">
        <table class="table table-bordered">
          <tbody>
            <tr style="
              background: #29282f;
              color: white;
              text-align: center;
              text-transform: uppercase;
              font-weight: 800;
          ">
              <td scope="col">day</td>
              <td scope="col">From</td>
              <td scope="col">to</td>
              <td scope="col">the status</td>

            </tr>
            <tr>
              @foreach(DB::table('Reservation')->orderBy('id','desc')->get() as $quote)
            <tr style="
            text-align: center;
            font-size: 16px;
            font-weight: bolder;
        ">
              <td>{{convertUtf8($quote->day)}}</td>
              <td>{{convertUtf8($quote->From)}}</td>
              <td>{{convertUtf8($quote->to)}}</td>
              <td>
                @php
                $Available=$quote->status;
                if($Available==$quote->Number){
                $status="Unavailable";
                $bootstrap="btn btn-danger btn-xs";
                $route="#" ;

                }else{
                $status="Available";
                $bootstrap="btn btn-success btn-xs";
                $route= route('front.quote.send', ['id'=>$quote->id]) ;

                }
                @endphp
                <a type="button" class="{{ $bootstrap }}" href="{{ $route }}">{{ $status }}</button>
              </td>

            </tr>

            @endforeach
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
          $(".day").change(function(){
         var day=   $(".day").text();
         alert(day);
            jQuery.ajax({
              beforeSend: function (xhr) { // Add this line
                      xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
               },
              url: 'https://lebardi.com/change_language',
              type: "POST",
              data: {"languages_id":lang_id,"_token": "f4YGvNxEM3C5X4ZRsNVIQCwNWHX8H6bVtHXY8VlE"},
              success: function (res) {
                window.location.reload();
              },
            });

          });
        });
</script>

<!--   quote area end   -->
@endsection
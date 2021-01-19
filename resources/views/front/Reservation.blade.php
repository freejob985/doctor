@extends("front.$version.layout")

@section('pagename')
- {{__('Request A Quote')}}
@endsection

@section('meta-keywords', "$be->quote_meta_keywords")
@section('meta-description', "$be->quote_meta_description")
<style>
  .img-responsive {
    margin: 0 auto !important;
}
</style>
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
<div id="img" class="text-center" style="display: none">
  <img class="img-responsive center-block" src="https://lh3.googleusercontent.com/proxy/L1-n_ihYLy9JZPvI4bOqYXxBC82m98wOHiHAceGlDa9eqVv0SfpJeiaMURvftIPIJBiP2uZicYYO030sJUw" alt="Chania">
</div>

<!--   quote area start   -->
<div class="quote-area pt-115 pb-115">
  <div class="container">
    <div class="row front">


    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
          $(".day").change(function(){
          var day=  this.value;
          var ajax_url = '{{ route('data.send') }}';
          jQuery.ajax({
            beforeSend: function (xhr) { 
              $('.text-center').show();
              // Add this line
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
             },
            url: ajax_url,
            type: "POST",
            data: {"day":day,"_token": '{{ csrf_token() }}'},
            success: function (res) {
              $('.text-center').hide();
              $('.front').html(res);
            },
          });

          });
        });
</script>

<!--   quote area end   -->
@endsection
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
{{--  div#img {
  margin-top: -24%;
}  --}}



.ui-datepicker {
    width: 100%;
    padding: 1.2em 1.2em 0;
    display: none;
}


.ui-datepicker .ui-datepicker-header {
    position: relative;
    padding: .2em 0;
    background: #3397C8;
}.ui-datepicker th {
    padding: 12px;
    color: #3397C8;
    text-align: center;
    font-weight: bold;
    border: 0;
}.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
    border: 1px solid #c5c5c5;
    background: #f6f6f6;
    font-weight: normal;
    font-size: 19px;
    color: #3397C8;
    
}
</style>
@section('content')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
  <div class="quote-area">
    <div class="container">
      <div class="form-row">
             <div class="col-md-2"></div>
        <div class="col-md-8 mb-4">
<div id="editor">
    asdasd

asd



</div>

          <input style="
    display: none;
" style="background:blue;padding:33px;" type="date" placeholder="Please enter data" class="form-control day" dateformat="d M y" name="day"
            id="date_input"    min="1997-01-01" max="2030-12-31">
 <div id="datepicker"></div>

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
    <div class="container">
         <div class="row">
  <img class="img-responsive center-block" style="width:200px;" src="https://i.pinimg.com/originals/78/e8/26/78e826ca1b9351214dfdd5e47f7e2024.gif" alt="Chania">
</div></div>
</div>
<!--   quote area start   -->
<div class="quote-area">
  <div class="container">
    <div class="row front">


    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
  $(document).ready(function(){
          $(".day").change(function(){
      

          });
        });
</script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
   onSelect: function(dateText, inst) {
       //alert(dateText);
           var day=  dateText;
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
       
   }
});
    
  } );
  </script>
  
  
<script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>

   <script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<!--   quote area end   -->
@endsection
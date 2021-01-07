@extends("front.$version.layout")

@section('pagename')
 - {{__('Request A Quote')}}
@endsection

@section('meta-keywords', "$be->quote_meta_keywords")
@section('meta-description', "$be->quote_meta_description")

@section('content')
  <!--   breadcrumb area start   -->
  <div class="breadcrumb-area" style="background-image: url('{{asset('assets/front/img/' . $bs->breadcrumb)}}');background-size:cover;">
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
     <div class="breadcrumb-area-overlay" style="background-color: #{{$be->breadcrumb_overlay_color}};opacity: {{$be->breadcrumb_overlay_opacity}};"></div>
  </div>
  <!--   breadcrumb area end    -->


  <!--   quote area start   -->
  <div class="quote-area pt-115 pb-115">
    <div class="container">
      <div class="row">

        <div class="col-lg-12">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td scope="col">day</td>
                <td scope="col">Number</td>
                <td scope="col">From</td>
                <td scope="col">to</td>
                <td scope="col">Time</td>
              </tr>
              <tr>
                @foreach(DB::table('Reservation')->orderBy('id','desc')->get() as $quote)
                <tr>
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
       
                </tr>

                @endforeach
              </tr>
        
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!--   quote area end   -->
@endsection

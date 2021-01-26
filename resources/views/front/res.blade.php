<div class="container">
    
  @if (count($reservation)>0)
  
  
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
        <td scope="col">von</td>
        <td scope="col">bis</td>
        <td scope="col">Der Status</td>

      </tr>
      <tr>
        @foreach($reservation as $quote)
      <tr style="
      text-align: center;
      font-size: 16px;
      font-weight: bolder;
  ">
        <td>{{convertUtf8($quote->From)}}</td>
        <td>{{convertUtf8($quote->to)}}</td>
        <td>
          @php
          $Available=$quote->status;
          if($Available==$quote->Number){
          $status="nicht verfügbar";
          $bootstrap="btn btn-danger btn-xs";
          $route="#" ;

          }else{
          $status="verfügbar";
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

@else

<div id="img" class="text-center">
  <img class="img-responsive center-block" src="https://www.qstams.com/images/no_result_optimize.gif" alt="Chania">
</div>

@endif
</div>
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
          @foreach($reservation as $quote)
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
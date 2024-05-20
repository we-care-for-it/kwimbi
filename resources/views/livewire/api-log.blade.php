<div>



<div >
@if(count($apilog))
<table class="table">
  <thead>
    <tr>
      <th scope="col">Status</th>
      <th scope="col">Datum / tijd</th>
      <th scope="col">Module</th>
      <th scope="col">Melding</th>
    </tr>
  </thead>
  <tbody>
  @foreach($apilog as $log)
    <tr>
      <th style = "width: 100px;">
        @if($log->result==1)
        <i class="fa-solid fa-check text-success"></i>
        @else
        <i class="fa-solid fa-circle-exclamation text-danger "></i>
        @endif
      </th>
      <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d-m-Y H:m:s')}} </td>
      <td>{{$log->module}}</td>
      <td>
        @if($log->error_description)
        {{$log->error_description}}
        @else
        Successful connect & sync
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@else
  <center>Er zijn nog geen log items gevonden</center>
@endif

</div>

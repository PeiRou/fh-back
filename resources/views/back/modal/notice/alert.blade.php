@if($msg[3]=='doc')
{{ $msg[0] }}<< <a target='_blank' href='{{ $msg[2] }}' >{{$msg[1]}}</a> >>
@endif
@if($msg[3]=='msg')
    {{ $msg[0] }}
@endif
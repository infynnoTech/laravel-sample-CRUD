<div class="row  no-gutters">
    <div class="col-md-12 col-sm-12 col-xs-12">
 @if (count($errors->all()) > 0)
<div class="alert alert-danger alert-block">

    <button type="button" class="close" data-dismiss="alert"><i class="icon-cross2"></i></button>

    <ul style="list-style:none;padding:0px;margin: 0;">
        @foreach($errors->all() as $message)
        <li><strong>Error! </strong>{{ $message }}</li>
        @endforeach
    </ul>
</div>
@endif
<?php
    if(Session::get('operationSucess')){
        echo Session::get('operationSucess');
    }
    if(Session::get('operationFaild')){
        echo Session::get('operationFaild');
    }

   ?>
@if ($message = Session::get('success_message'))
<div class="alert alert-success alert-block session-box">
    <i class="fa fa-check"></i>
    <button type="button" class="close" data-dismiss="alert"><i class="glyphicon glyphicon-remove"></i></button>
    <strong>Success! </strong>
    @if(is_array($message))
    @foreach ($message as $m)
    {{ $m }}
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('error_message'))
<div class="alert alert-danger alert-block session-box">
    <i class="fa fa-ban"></i>
    <button type="button" class="close" data-dismiss="alert"><i class="glyphicon glyphicon-remove"></i></button>
    <strong>Error! </strong>
    @if(is_array($message))
    @foreach ($message as $m)
    {{ $m }}
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('warning_message'))
<div class="alert alert-warning alert-block session-box">
    <i class="fa fa-warning"></i>
    <button type="button" class="close" data-dismiss="alert"><i class="glyphicon glyphicon-remove"></i></button>
    <strong>Warning! </strong>
    @if(is_array($message))
    @foreach ($message as $m)
    {{ $m }}
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('info_message'))
<div class="alert alert-info alert-block session-box">
    <i class="fa fa-info"></i>
    <button type="button" class="close" data-dismiss="alert"><i class="glyphicon glyphicon-remove"></i></button>
    <strong>Info! </strong>
    @if(is_array($message))
    @foreach ($message as $m)
    {{ $m }}
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif
</div>
</div>
<div class="clearfix" style="clear:both;"></div>

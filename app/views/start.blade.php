@extends('layouts.master')

@section('content')
<style>
    .ct-table{
        display: none;
    }
</style>
<div class="row">
    <div class="col-md-10">

        @foreach($nodes as $node)
        <table class="table">
            <thead>
            <th colspan="100"><h3>Node: {{ $node->name }} <small>({{ $node->_id }})</small></h3></th>
            </thead>
            <thead>
            <th>namn</th>
            <th>current load</th>
            <th>uptime</th>
            <th>reported</th>
            </thead>
            <tbody>
            <tr>
                <td>{{ $node->name }}</td>
                <td class="text-warning">{{ implode(', ',$node->getLatestReportByCommandName('load')['load']) }}</td>
                <td>{{ $node->getLatestReportByCommandName('uptime')['uptime'] }}</td>
                <td>{{ $node->getLatestReportByCommandName('load')['created_at'] }}</td>
                <td><button class="btn btn-success btn-xs show-ct">Show containers</button></td>
            </tr>
            </tbody>
        </table>

        <table class="table table-condensed ct-table">
            <thead>
                <th>ctid</th>
                <th>host</th>
                <th>os</th>
                <th>status</th>
                <th>current load</th>
                <th>uptime</th>
                <th>reported</th>
            </thead>
            <tbody>
            @foreach($node->containers as $container)
            <tr>
                <td>{{ $container->ctid }}</td>
                <td>{{ $container->host }}</td>
                <td>{{ $container->os }}</td>
                <td>{{ $container->status }}</td>
                @if($container->getLatestReportByCommandName('load')['load'])
                <td>{{ implode(', ',$container->getLatestReportByCommandName('load')['load']) }}</td>
                <td>{{ $container->getLatestReportByCommandName('uptime')['uptime'] }}</td>
                <td>{{ $container->getLatestReportByCommandName('load')['created_at'] }}</td>
                @endif
            </tr>
            @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
</div>
<script>
    $(function(){
        $('.show-ct').click(function(el){
            $('.ct-table').fadeToggle( "fast", function() {
                // Animation complete.
            });
        });
    });
</script>
@stop
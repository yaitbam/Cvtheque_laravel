@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div style="padding-bottom:20px" class="col-md-12">
            <ul style="display: list-item;list-style-type:none">
                <li style="float:left"><h1>La liste de mes cv</h1></li>
                <li style="float:right"> <a class="btn btn-success" href="{{ url('cvs/create') }}">Nouveau cv</a></li>
            </ul>
        </div>  
                @foreach($listcv as $cv)
                
                <div class="col-xs-18 col-sm-6 col-md-3">
                     <div style=" border: 1px solid #ddd;position: relative; padding: 0px; margin-bottom: 20px;" class="thumbnail">
                        <img style="object-fit:cover;width:100%;height:250px" src="{{ asset('storage/'.$cv->photo) }}" class="" alt="">
                        <div style="text-align:center" class="caption">
                            <p>{{ $cv->user->name }}</p>    
                            <h3>{{ $cv->titre }}</h3>
                            <p>{{ $cv->presentation }}</p>
                            <p>
                            <form action="{{ url('cvs/'.$cv->id) }}" method="post">
                                <a href="" class="btn btn-primary" role="button">Show</a>
                                @can('update', $cv)
                            <a href="{{ url('cvs/'.$cv->id.'/edit') }}" class="btn btn-warning" role="button">Editer</a>
                            @endcan
                            {{ csrf_field() }} 
                                <input type="hidden" name="_method" value="DELETE">
                                @can('delete', $cv)
                                <button type="submit" class="btn btn-danger">Delete</button>
                                @endcan
                            </form>
                        </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
</div>

@endsection
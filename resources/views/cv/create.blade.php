@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
        <!-- @if(count($errors))
            <div class="alert alert-danger" role="alert">
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif -->
            <form action="{{ url('cvs') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group @if($errors->get('titre')) is-invalid @endif">
                    <label for="">Titre</label>
                    <input type="text" name="titre" value="{{ old('titre') }}" class="form-control @if($errors->get('titre')) is-invalid @endif">
                    @if($errors->get('titre'))
                                @foreach($errors->get('titre') as $error)
                                <li style="list-style-type: none ;color:red">{{ $error }}</li>
                                @endforeach
                    @endif
                </div>

                    <div class="form-group @if($errors->get('presentation')) is-invalid @endif">
                    <label for="">Presentation</label>
                    <textarea type="text"  name="presentation" class="form-control  @if($errors->get('presentation')) is-invalid @endif">{{ old('presentation') }}</textarea>
                    @if($errors->get('presentation'))
                                @foreach($errors->get('presentation') as $error)
                                <li style="list-style-type: none ;color:red">{{ $error }}</li>
                                @endforeach
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input class="form-control" type="file" name="photo">
                    @if($errors->get('photo'))
                                @foreach($errors->get('photo') as $error)
                                <li style="list-style-type: none ;color:red">{{ $error }}</li>
                                @endforeach
                    @endif
                </div>

                

             <div class="form-group">
                    <input type="submit" value="Save" class="form-control btn-primary">
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
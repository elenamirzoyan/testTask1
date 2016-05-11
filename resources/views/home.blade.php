@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Upload Image</div>

                <div class="panel-body">
                    <form role="form" action="{{ route('imageUpload') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ isset($errors) ? ' has-error' : '' }}">
                            <label for="exampleInputFile">File input</label>
                            <button type="button" class="btn btn-sm btn-primary btn-file">Brows
                                <input type="file" class="btn-file" multiple accept="image/jpeg,image/jpg" name="images[]">
                            </button>
                            <p class="">Accept Mime (Jpeg).</p>
                            @if (!$errors->isEmpty())
                                @foreach($errors->messages() as $imageName => $message)
                                    <span class="help-block">
                                        <strong>{!! $message[0] !!}</strong>
                                    </span>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                    <div>
                        <ul>
                            @if(!empty($images))
                                @foreach($images as $slug => $image)
                                    <li>
                                        <a href="/uploads/{{ $slug }}" download>
                                            <span class='glyphicon glyphicon-download-alt'><span>
                                            {{ $image }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

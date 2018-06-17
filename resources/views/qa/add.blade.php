@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('js/themes/fontawesome-stars.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('qa.store') }}">
                        {{ csrf_field() }}

                    <div class="form-group">
                        <label for="">Question</label>
                        <input type="text" name="question" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">Answer 1</label>
                        <input type="text" name="answer_1" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <select name="rate_1" id="answer_1">
                            @for ($i = 1; $i < 6; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Answer 2</label>
                        <input type="text" name="answer_2" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <select name="rate_2" id="answer_2">
                            @for ($i = 1; $i < 6; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Answer 3</label>
                        <input type="text" name="answer_3" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <select name="rate_3" id="answer_3">
                            @for ($i = 1; $i < 6; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Answer 4</label>
                        <input type="text" name="answer_4" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <select name="rate_4" id="answer_4">
                            @for ($i = 1; $i < 6; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Answer 5</label>
                        <input type="text" name="answer_5" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <select name="rate_5" id="answer_5">
                            @for ($i = 1; $i < 6; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm">
                            Simpan
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="{{ asset('js/jquery.barrating.min.js') }}"></script>
    <script type="text/javascript">
    $(function() {
        $('#answer_1').barrating({
            theme: 'fontawesome-stars'
        });
        $('#answer_2').barrating({
            theme: 'fontawesome-stars'
        });
        $('#answer_3').barrating({
            theme: 'fontawesome-stars'
        });
        $('#answer_4').barrating({
            theme: 'fontawesome-stars'
        });
        $('#answer_5').barrating({
            theme: 'fontawesome-stars'
        });
    });
    </script>
@endsection
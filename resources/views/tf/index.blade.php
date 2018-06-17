@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Dictionary</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="success">#</th>
                                    <th rowspan="2" class="success">Kata</th>
                                    <th rowspan="2" class="success">DF</th>
                                    <th rowspan="2" class="success">IDF</th>

                                    @foreach ($dictionary as $v_row)
                                        @php
                                            $data[] = $v_row->recheck->count();
                                        @endphp
                                    @endforeach
                                    @php $max = max($data) @endphp

                                    <th colspan="{{ $max }}" class="text-center success">TF * IDF</th>
                                </tr>
                                <tr>
                                    @for ($i = 0; $i < $max; $i++)
                                        <td class="warning">{{ $i + 1 }}</td>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1 @endphp
                                @forelse ($dictionary as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    @php $tf = 0 @endphp
                                    @foreach ($row->recheck as $val)
                                        @php
                                            $tf += $val->total;
                                        @endphp
                                    @endforeach
                                    <td>{{ $row->word }}</td>
                                    <td>{{ $tf }}</td>
                                    @php $idf = log(4/$tf) @endphp
                                    <td>{{ $idf }}</td>
                                    
                                    @php $check_num = 0 @endphp
                                    @foreach ($row->recheck as $data)
                                    <td>
                                        {{ $data->total * $idf }}
                                        @php $check_num += 1 @endphp
                                    </td>
                                    @endforeach

                                    @if ($check_num < $max)
                                        @php $newNum = $max - $check_num @endphp
                                        @for($n = 0; $n < $newNum; $n++)
                                            <td></td>
                                        @endfor
                                    @endif
                                    @php $check_num++ @endphp
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pull-right">
                        {!! $dictionary->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

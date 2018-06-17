@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ route('qa.add') }}" class="btn btn-primary btn-sm">Tambah</a>
                            <a href="{{ route('qa.check') }}" class="btn btn-warning btn-sm">Check</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th width="30%">Question</th>
                                <th width="30%">Answer 1</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                            @if ($qa->count() > 0)
                                @php $no = 1; @endphp
                                @foreach ($qa as $value)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $value->question }}</td>
                                    <td>
                                        <p class="text-justify">{{ $value->answer_1 }}<p>
                                        @for ($i = 1; $i < $value->rate_1; $i++)
                                        <i class="fa fa-star"></i>
                                        @endfor
                                    </td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>
                                        {!! Form::open(['url' => 'qa/' . $value->id, 'method' => 'DELETE']) !!}
                                            <a href="#" onClick="openModal('{{ $value->id }}')" class="btn btn-info btn-sm">Detail</a>
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="9">
                                        Tidak ada data
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <div class="pull-right">
                        {!! $qa->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Details</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Pertanyaan </th>
                                        <td>:</td>
                                        <td class="txt_pertanyaan"></td>
                                    </tr>
                                    <tr>
                                        <th>Jawaban 1 </th>
                                        <td>:</td>
                                        <td class="txt_answer_1"></td>
                                    </tr>
                                    <tr>
                                        <th>Jawaban 2 </th>
                                        <td>:</td>
                                        <td class="txt_answer_2"></td>
                                    </tr>
                                    <tr>
                                        <th>Jawaban 3 </th>
                                        <td>:</td>
                                        <td class="txt_answer_3"></td>
                                    </tr>
                                    <tr>
                                        <th>Jawaban 4 </th>
                                        <td>:</td>
                                        <td class="txt_answer_4"></td>
                                    </tr>
                                    <tr>
                                        <th>Jawaban 5 </th>
                                        <td>:</td>
                                        <td class="txt_answer_5"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Stemming:</strong> <span class="txt_stemming"></span></p>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kata</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="stemming_details"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        function openModal(id) {
            axios.post('/api/qa', {
                id: id
            })
            .then ((response) => {
                $('.txt_pertanyaan').empty();
                $('.txt_pertanyaan').append(response.data.qa.question);
                $('.txt_answer_1').empty();
                $('.txt_answer_1').append(response.data.qa.answer_1);
                $('.txt_answer_2').empty();
                $('.txt_answer_2').append(response.data.qa.answer_2);
                $('.txt_answer_3').empty();
                $('.txt_answer_3').append(response.data.qa.answer_3);
                $('.txt_answer_4').empty();
                $('.txt_answer_4').append(response.data.qa.answer_4);
                $('.txt_answer_5').empty();
                $('.txt_answer_5').append(response.data.qa.answer_5);
                $('.txt_stemming').empty();
                $('.txt_stemming').append(response.data.qa.stemming.kalimat);
                
                $('.stemming_details').empty()
                $.each(response.data.check, function (i, val) {
                    $('.stemming_details').append("<tr><td>" + i + "</td><td>" + val.dictionary.word + "</td><td>" + val.total + "</td></tr>")
                })
                $('#myModal').modal('show');
            })
            .catch ((error) => {

            })
        }
    </script>
@endsection

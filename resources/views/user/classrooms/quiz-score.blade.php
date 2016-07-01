@extends('user.content')

@section('subcontent')
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title text-bold">Nilai</h3>
    </div>
    <div class="panel-body">
      <p><strong>Nama Quiz: </strong> {{ $quiz->title }}</p>
      <p><strong>Nilai Minimum: </strong> {{ $quiz->pass_score }}</p>
    </div>
    @forelse($users as $i => $user)
      <table class="table">
        <thead>
          <tr>
            <th scope="row">#</th>
            <th>Nama</th>
            <th>Tidak Terjawab</th>
            <th>Nilai</th>
          </tr>
        </thead>
        <tbody>
          <tr class="{{ $user->pivot->score < $quiz->pass_score ? 'danger' : '' }}">          
            <th scope="row">{{ $i + 1 }}</th>
            <td>{{ $user->fullname }}</td>
            <td>{{ $user->pivot->unanswered }}</td>
            <td>{{ $user->pivot->score }}</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <th scope="row">#</th>
            <th>Nama</th>
            <th>Tidak Terjawab</th>
            <th>Nilai</th>
          </tr>
        </tfoot>
      </table>
    @empty
      <h3 class="no-content text-center">Belum ada yang menjawab quiz.</h3>
    @endforelse
  </div>
@endsection

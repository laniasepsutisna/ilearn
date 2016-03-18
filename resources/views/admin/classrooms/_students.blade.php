<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Tambahkan Siswa</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        {!! Form::open(['route' => ['lms-admin.classrooms.addmembers'],'role' => 'form', 'class' => 'form-horizontal']) !!}
            {!! Form::hidden('role', 'student') !!}
            {!! Form::hidden('classroom_id', $classroom->id) !!}
            <div class="form-group {{ $errors->has('students') ? 'has-error' : '' }}">
                {!! Form::label('students', 'Siswa', array('class' => 'col-md-3 control-label')) !!}
                <div class="col-md-9">
                    {!! Form::select('students[]', App\Models\User::where('role', 'student')->whereNotIn('id', $ids)->get()->pluck('fullname', 'id'), null, ['class' => 'form-control select2', 'id' => 'students', 'multiple']) !!}                            
                    {!! $errors->first('students', '<p class="help-block">:message</p>') !!}
                </div>
            </div>                    
            <div class="box-footer">
                <div class="col-md-offset-3">
                    {!! Form::submit('Tambahkan', ['name' => 'students-submit', 'class'=>'btn btn-flat btn-success']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Siswa di kelas ini</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <table class="table">
            <thead>                        
                <tr>
                    <th><input type="checkbox"></input></th>
                    <th>Nama Siswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                @if($user->hasRole('student'))                               
                    <tr>
                        <td><input type="checkbox"></input></td>
                        <td>{{ $user->fullname }}</td>
                        <td>                        
                            {!! Form::open(['route' => ['lms-admin.classrooms.removemember', $user], 'method' => 'delete', 'class' => 'form-delete-inline']) !!}
                                {!! Form::hidden('classroom_id', $classroom->id) !!}
                                {!! Form::submit('Hapus', ['class'=>'btn btn-flat btn-link btn-link-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
            <tfoot>                     
                <tr>
                    <th><input type="checkbox"></input></th>
                    <th>Nama Siswa</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="pull-right">
        {{ $users->links() }}
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="changeImage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload Image</h4>
            </div>
            <div class="modal-body">
                {!! Form::model($lms['profile'], ['route' => 'auth.image', 'files' => true, 'method' => 'put']) !!}
                    {!! Form::hidden('field', 'picture', ['class' => 'field_type']) !!}
                    <div class="form-group">
                        {!! Form::label('image', 'Image', ['class' => 'sr-only']) !!}
                        {!! Form::file('image') !!}
                    </div>
                    {!! Form::submit('Update Image', ['class'=>'btn btn-flat btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="profile" style="background: url('{{ $lms['profile']->cover }}');">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<figure class="profile-pict text-center">
					<img class="img-circle" src="{{ $lms['profile']->picture_md }}">
					<figcaption>
						<a href="#" class="changeImage" id="chg-picture" data-toggle="modal" data-target="#changeImage"><i class="fa fa-camera"></i></a>
					</figcaption>
				</figure>				
				<h1 class="profile-name text-center">{{ $lms['profile']->fullname }}</h1>
			</div>
			<div class="col-md-8 col-md-offset-2 text-right change-cover">
				<a href="#" class="changeImage" id="chg-cover" data-toggle="modal" data-target="#changeImage">Ganti Cover</a>
			</div>
		</div>
	</div>
</div>


{{ Form::open(['route' => ['post.store']]) }}
  <div>
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title') }}
    <hr>
    {{ Form::label('slug', 'Slug') }}
    {{ Form::text('slug') }}
    
    <hr>
    {{ Form::label('content', 'Content') }}
    {{ Form::text('content') }}
    
    <hr>
    {{ Form::label('status', 'Status') }}
    {{ Form::text('status') }}
    
    <hr>
    {{ Form::label('slug', 'Slug') }}
    {{ Form::text('slug') }}
  </div>
  <div>
    {{ Form::submit('Create') }}
  </div>
{{ Form::close() }}

{{ Form::label('name', 'Node name') }}
{{ Form::text('name') }}

{{ Form::label('host', 'Host') }}
{{ Form::text('host') }}

{{ Form::label('port', 'Port') }}
{{ Form::text('port') }}

{{ Form::label('username', 'Username') }}
{{ Form::text('username') }}

{{ Form::label('password', 'Password') }}
{{ Form::password('password') }}

{{ Form::submit() }}
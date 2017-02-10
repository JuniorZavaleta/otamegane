@extends('admin.layouts.base')

@section('title', 'Source Listing')

@section('content')

  @include('admin.success_message')

  <div class="ui blue center aligned segment">
    <h2>List of Sources</h2>
  </div>

  <div class="ui basic right aligned segment">
    <a class="ui blue button" href="{{ route('sources.add_form') }}">
      <i class="tag icon"></i> New Source
    </a>
  </div>

  <table class="ui blue very compact table">
    <thead>
      <th>#</th>
      <th>Name</th>
      <th># subscribers</th>
      <th># subscriptions</th>
      <th># mangas</th>
      <th>Url</th>
      <th>Actions</th>
    </thead>
    <tbody>
    @foreach($sources as $source)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $source->name }}</td>
        <td>{{ $source->total_subscribers }}</td>
        <td>{{ $source->total_subscriptions }}</td>
        <td>{{ $source->num_mangas }}</td>
        <td><a href="{{ $source->url }}">{{ $source->url }}</a></td>
        <td>
          <a href="{{ route('sources.add_manga_form', ['id' => $source->id]) }}" title="Add Manga"><i class="book icon"></i></a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>

@endsection

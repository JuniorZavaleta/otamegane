@extends('layouts.app')

@section('title', 'Manga Listing')

@section('content')
<div class="container" id="app">

  @include('admin.success_message')

  <div class="row">
    <h2>List of Manga</h2>
  </div>
  <div class="row">
    <a class="btn btn-primary" href="{{ route('mangas.add_form') }}">
      Add Manga
    </a>
    <a class="btn btn-success" v-show="mangaSelected" v-bind:href="editUrl">
      Edit Manga
    </a>
    <a class="btn btn-default" v-show="mangaSelected" v-bind:href="showUrl">
      Show Manga
    </a>
  </div>
  <table class="table">
    <thead>
      <th>#</th>
      <th>Name</th>
      <th># subscribers</th>
      <th># subscriptions</th>
      <th># sources</th>
    </thead>
    <tbody>
    @foreach ($mangas as $manga)
      <tr id="manga-{{ $manga->id }}" v-on:click="selectManga('{{ $manga->id }}')">
        <td>{{ $loop->iteration }}</td>
        <td>{{ $manga->name }}</td>
        <td>{{ $manga->total_subscribers }}</td>
        <td>{{ $manga->total_subscriptions }}</td>
        <td>{{ $manga->num_sources }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
  <div class="text-center">
    {{ $mangas->links() }}
  </div>

  <script type="text/javascript">
    var templateShowUrl = "{{ route('mangas.show',['id' => 'manga_id']) }}";
    var templateEditUrl = "{{ route('mangas.edit_form',['id' => 'manga_id']) }}";
  </script>
</div>
@endsection

@push('scripts')
<script>
var vm = new Vue(
{
    el: '#app',

    data: {
      appUrl: '',
      mangaSelected: '',
      showUrl: '',
      editUrl: '',
    },

    methods: {
      selectManga: function(id)
      {
        var last_tr = $("#manga-" + this.mangaSelected)
        var tr_selected = $("#manga-" + id)

        if (this.mangaSelected != id) {
          last_tr.removeClass("row-selected");
        }

        tr_selected.toggleClass("row-selected");

        this.mangaSelected = (this.mangaSelected == id) ? 0 : id;
      },
    },

    watch: {
      mangaSelected: function(newValue) {
        if (newValue > 0) {
          this.mangaSelected = newValue;
          this.editUrl = window.templateEditUrl.replace("manga_id", this.mangaSelected);
          this.showUrl = window.templateShowUrl.replace("manga_id", this.mangaSelected);
        }
      }
    },

    mounted() {
      this.appUrl = window.app_url;
    },
});
</script>
@endpush

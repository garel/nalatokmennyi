@extends("layouts/default")

@section("content")
    <table class="table">
        <thead>
            <tr>
                <th>Név</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    <td>
                        <a href="/prices-by-{{$get}}/{{$row->id}}">{{$row->name}}</a>
                    </td>
                    <td>
                        <a href="{{$row->slug}}" target="_blank">
                            Megnyitás
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

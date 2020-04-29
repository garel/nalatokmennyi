@extends("layouts/default")

@section("content")
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                <tr>
                    @if($get == "product")
                        <th>Termék név</th>
                        <th>Termék link</th>
                        <th>Termék ár</th>
                    @elseif($get == "shop")
                        <th>Bolt név</th>
                        <th>Bolt link</th>
                        <th>Termék ár</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($prices as $price)
                    <tr>
                        <td>
                            <a href="/prices-by-{{$get}}/{{$price->{$get}->id}}">
                                {{$price->{$get}->name}}
                            </a>
                        </td>
                        <td>
                            <a href="{{$price->{$get}->slug}}" target="_blank">
                                Megnyitás
                            </a>
                        </td>
                        <td>{{$price->price}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

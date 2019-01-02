@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="text-center col-sm-12 mb-4">
                <h3 class="font-weight-bold">{{$user->user_name}}</h3>
            </div>
        </div>
        <div class="row">
            @if($currentAuthUser->id == $user->id)
            <div class="text-center col-sm-6 border rounded">
                <h2 class="mb-4 mt-4">Ingredients</h2>
                <form action="/ingredients/store" method="post">
                    {{csrf_field()}}
                    <input list="ingredients" name="food" placeholder="select ingredient">
                    <datalist id="ingredients">
                        @foreach($foods as $food)
                            <option value="{{$food->name}}">
                        @endforeach
                    </datalist>
                    <input name="count" size="5" placeholder="count" class="ml-4">
                    <input list="measures" name="measure" size="14" placeholder="select measure" class="mr-4">
                    <datalist id="measures">
                        @foreach(config('constant.measure') as $measure)
                            <option value="{{$measure}}">
                        @endforeach
                    </datalist>
                    <button type="submit" class="btn btn-primary" name="button">Add food</button>
                </form>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Ingredient name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Destroy</th>
                    </tr>
                    </thead>
                    @foreach($ingredients as $ing)
                        <tr>
                                <td><a href="/ingredients/{{$ing->id}}">{{$ing->food->name}}</a></td>
                            <td><strong>{{$ing->count}}</strong> <i>{{$ing->unit_of_measure}}</i></td>
                                <td><a href="/ingredients/{{$ing->id}}/destroy"><img class="img-fluid" src="{{url('images/x.png')}}" alt="x"></a></td>
                        </tr>
                    @endforeach
                </table>

            </div>
            @endif
            <div class="text-center offset-1 col-sm-4">
                <h4>Recipes</h4>
                <div class="card">
                    @foreach($recipes as $recipe)
                        <a href="{{$recipe->uri}}">{{$recipe->name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
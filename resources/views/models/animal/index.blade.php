@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                TODO
{{--                <table class="table table-hover">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        @foreach($fields as $field)--}}
{{--                            <th scope="col">{{ __(sprintf('models.%s.fields.%s', $class, $field)) }}</th>--}}
{{--                        @endforeach--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach($items as $item)--}}
{{--                        <tr>--}}
{{--                            <th scope="row">--}}
{{--                                <a href="#" class="stretched-link"></a>--}}
{{--                            </th>--}}
{{--                            @foreach($fields as $field)--}}
{{--                                <td>{{ $item[$field] ?: '--' }}</td>--}}
{{--                            @endforeach--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
            </div>
        </div>
    </div>
@endsection

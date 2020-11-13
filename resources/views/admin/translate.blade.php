@extends('adminlte::page')

@section('title')
    Translate
@endsection

@section('content')
<div class="row">
    <div class="container">
        <h4>Traductions</h4>
        <table class="table table-hover even">
            <thead>
                <tr>
                    <th>Category id</th>
                    <th>Category name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cat as $id => $name)
                <tr>
                    <td>{{ $id }}</td>
                    <td>{{ $name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table class="table table-hover even">
            <thead>
                <tr>
                    <th>Product id</th>
                    <th>Product description</th>
                    <th>Product traduction</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->description }}</td>
                        @if($product->translation())
                            {{ dump($product->translation())  }}
                            <td>
                                {{ $product->translation() }}
                                Language : {{ $product->translation() }}
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ die() }}
        <table class="table table-hover even">
            <thead>
                <tr>
                    <th>Option id</th>
                    <th>Option description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($options as $id => $name)
                    <tr>
                        <td>{{ $id }}</td>
                        <td>{{ $name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table class="table table-hover even">
            <thead>
                <tr>
                    <th>Front Page id</th>
                    <th>Front page title</th>
                    <th>Front page traduction</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fp as $f)
                    <tr>
                        <td>{{ $f->id }}</td>
                        <td>{{ $f->title }}</td>
                        @if($f->translation())
                            <td>
                                {{ $f->translation() }}
                                Language : {{ $f->translation() }}
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

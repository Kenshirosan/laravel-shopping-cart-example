@if($orders->isEmpty())
    No Data Available
@else
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No of Results</th>
                        <th>Order Number</th>
                        {{-- <th>Order items</th> --}}
                        <th>Email</th>
                        <th>Created on</th>
                        <th>ViewOrder</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $order->id }}</td>
                        {{-- <td>{{ substr(strip_tags($order->items),0,50) }}</td> --}}
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->created_at->toDateString() }}</td>
                        <td>
                            <a href="print/{{ $order->id }}" title="SHOW" >
                                <span class="glyphicon glyphicon-list"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

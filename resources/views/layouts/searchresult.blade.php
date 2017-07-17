<?php
if(!empty($orders ))
{
    $count = 1;
    $outputhead = '';
    $outputbody = '';
    $outputtail ='';

    $outputhead .= '<div class="table-responsive">
    <table class="table table-bordered">
    <thead>
    <tr>
    <th>No of Results</th>
    <th>Order Number</th>
    <th>Email</th>
    <th>Created on</th>
    <th>ViewOrder</th>
    </tr>
    </thead>
    <tbody>
    ';

    foreach ($orders as $order)
    {
        // $body = substr(strip_tags($post->body),0,50)."...";
        $show = url('print/'.$order->id);
        $outputbody .=  '

        <tr>
        <td>'.$count++.'</td>
        <td>'.$order->id.'</td>
        <td>'.$order->items.'</td>
        <td>'.$order->created_at.'</td>
        <td><a href="'.$show.'" target="_blank" title="SHOW" ><span class="glyphicon glyphicon-list"></span></a></td>
        </tr>
        ';

    }

    $outputtail .= '
    </tbody>
    </table>
    </div>';

    echo $outputhead;
    echo $outputbody;
    echo $outputtail;
}

else
{
    echo 'Data Not Found';
}

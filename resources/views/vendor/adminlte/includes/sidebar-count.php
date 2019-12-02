<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if($item['href'] == url('/calendar'))
    {
        $calendar = new \App\Models\Calendar();

        $item['label'] = $calendar->getAppointmentsCount() ? : $item['label'];
    }

if($item['href'] == url('/contact-us'))
    {
        $messages = new \App\Models\Message();

        $item['label'] = $messages->count() ? : $item['label'];
    }

if($item['href'] == url('/customer-orders'))
    {
        $orders = new \App\Models\Order();

        $item['label'] = $orders->todaysOrdersCount() ? : $item['label'];
    }
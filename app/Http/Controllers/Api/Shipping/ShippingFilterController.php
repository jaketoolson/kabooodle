<?php
/**
 * This file is part of Kabooodle.
 * Copyright (c) 2017. Kabooodle,LLC <help@kabooodle.com>
 */

namespace Kabooodle\Http\Controllers\Api\Shipping;

use DB;
use Illuminate\Http\Request;
use Kabooodle\Http\Controllers\Api\AbstractApiController;

/**
 * Class ShippingFilterController
 * @package Kabooodle\Http\Controllers\Api\Shipping
 */
class ShippingFilterController extends AbstractApiController
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return $this->setData($this->filterRecipients($request->get('q')))->respond();
    }

    /**
     * @param string $query
     *
     * @return mixed
     */
    public function filterRecipients($query)
    {
        $sql = "
            SELECT u.id as value, u.name as text
            FROM users u
            INNER JOIN shipping_transactions as st ON st.recipient_id = u.id 
            WHERE st.user_id = :userid
            AND u.name LIKE :string
            GROUP BY u.id
        ";

        return DB::select(DB::raw($sql), [
            ':userid' => $this->user()->id,
            ':string' => '%'.$query.'%'
        ]);
    }
}

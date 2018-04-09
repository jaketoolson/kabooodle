<?php
/**
 * This file is part of Kabooodle.
 * Copyright (c) 2017. Kabooodle,LLC <help@kabooodle.com>
 */

namespace Kabooodle\Http\Requests\Users;

use Kabooodle\Models\FlashSales;
use Kabooodle\Http\Requests\Request;
use Kabooodle\Models\Traits\ObfuscatesIdTrait;

/**
 * Class FlashsaleViewRequest
 * @package Kabooodle\Http\Requests\Flashsale
 */
class UserListingsRequest extends Request
{
    use ObfuscatesIdTrait;

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|FlashSales
     */
    public function getFlashsale()
    {
        $idAndName = $this->route()->parameter('flashsale');
        $decryptedId = $this->obfuscateFromURIString($idAndName);

        return FlashSales::findOrFail($decryptedId);
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [];
    }
}

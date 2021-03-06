<?php
/**
 * This file is part of Kabooodle.
 * Copyright (c) 2017. Kabooodle,LLC <help@kabooodle.com>
 */

namespace Kabooodle\Presenters\Models\Listings;

/**
 * Class ListingsPresenterTrait
 */
trait ListingsPresenterTrait
{
    /**
     * @return string
     */
    public function getStatus()
    {
        return listingStatusHtml($this->entity->status);
    }
}

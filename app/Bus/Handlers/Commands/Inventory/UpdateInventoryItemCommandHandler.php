<?php
/**
 * This file is part of Kabooodle.
 * Copyright (c) 2017. Kabooodle,LLC <help@kabooodle.com>
 */

namespace Kabooodle\Bus\Handlers\Commands\Inventory;

use DB;
use Kabooodle\Models\Files;
use InvalidArgumentException;
use Kabooodle\Models\Inventory;
use Kabooodle\Models\InventoryTypeStyles;
use Kabooodle\Bus\Commands\Inventory\UpdateInventoryItemCommand;

/**
 * Class UpdateInventoryItemCommandHandler
 * @package Kabooodle\Bus\Handlers\Commands\Inventory
 */
class UpdateInventoryItemCommandHandler
{
    /**
     * @param UpdateInventoryItemCommand $command
     *
     * @return mixed
     */
    public function handle(UpdateInventoryItemCommand $command)
    {
        $style = InventoryTypeStyles::findOrFail($command->getStyleId());

        // Check that the requested size belongs to the requested style
        // Could move this to the model observer.
        if (! $style->sizes->find($command->getSizeId())) {
            throw new InvalidArgumentException;
        }

        return DB::transaction(function () use ($command) {
            /** @var Inventory $item */
            $item = $command->getItem();
            $item->inventory_type_styles_id = $command->getStyleId();
            $item->inventory_sizes_id = $command->getSizeId();
            $item->description = $command->getDescription();
            $item->initial_qty = $command->getQty();
            $item->price_usd = $command->getPrice();
            $item->uuid = $command->getUuid();
            $item->wholesale_price_usd = $command->getWholesalePrice();

            $existingImages = $item->images;

            // New array containing all images associated to the item
            // this includes existing and new.
            $addedImagesArray = [];

            // Get a separate array of existing images so we can compare it against $addedImages.
            // The difference will yield id's that need to be deleted.
            $existingImagesArray = $existingImages->pluck('id')->toArray();

            $images = $command->getImages();
            foreach ($images as $image) {
                $image = $this->normalizeImageData($image);
                if (in_array($image['id'], $existingImagesArray)) {
                    $addedImagesArray[] = $image['id'];
                    $existingImages->push($image);
                    continue;
                }
                $file = Files::create([
                    'location' => $image['location'],
                    'key' => $image['key'],
                    'bucket_name' => $image['bucket'],
                    'fileable_type' => get_class($item),
                    'fileable_id' => $item->id
                ]);
                $addedImagesArray[] = $file->id;
                $existingImages->push($file);
            }

            if (!empty($command->getCategories())) {
                $item->retag($command->getCategories());
            } else {
                $item->untag();
            }

            // We may have new images, and existing images may have been deleted.
            // Lets make sure all the images that need to be deleted, are deleted.
            $this->checkAndDeleteUnusedImages($item, $existingImagesArray, $addedImagesArray);

            $coverPhotoKey = $command->getCoverPhotoKey();
            $coverPhotoFile = $existingImages->first(function($value) use ($coverPhotoKey) {
                // Numeric if the selected cover photo is an existing file in the DB
                // otherwise, check the "key" because this means its a newly uploaded photo
                if (is_numeric($coverPhotoKey)) {
                    return $value->id == $coverPhotoKey;
                } else {
                    return $value->key == $coverPhotoKey;
                }
            });

            $item->cover_photo_file_id = $coverPhotoFile->id;

            $item->save();

            return $item;
        });
    }

    /**
     * @param Inventory $item
     * @param array     $originalImages
     * @param array     $insertedImages
     */
    public function checkAndDeleteUnusedImages(Inventory $item, array $originalImages, array $insertedImages)
    {
        if ($toDelete = array_diff($originalImages, $insertedImages)) {
            $item->images()->whereIn('id', $toDelete)->delete();
        }
    }

    /**
     * @param $array
     *
     * @return mixed
     */
    public function normalizeImageData(&$array)
    {
        $array = json_decode($array, true);

        // Extract keys from data as parent key/values
        foreach ($array as $k => $v) {
            $array[$k] = $v;
        }
        $array['qty'] = isset($array['qty']) ? $array['qty'] : 1;

        return $array;
    }
}

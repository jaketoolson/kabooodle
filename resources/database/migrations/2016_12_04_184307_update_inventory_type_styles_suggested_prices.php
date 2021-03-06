<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateInventoryTypeStylesSuggestedPrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_type_styles', function(Blueprint $table){
            $table->decimal('suggested_price_usd', 6,2)->after('wholesale_price_usd');
        });


        $sql = "INSERT INTO `inventory_type_styles` (`id`, `inventory_type_id`, `name`, `slug`, `sort_order`, `wholesale_price_usd_less_5_percent`, `wholesale_price_usd`, `suggested_price_usd`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(184313, 188432, 'Adeline', 'adeline', 0, 13.30, 14.00, 30.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184314, 188432, 'Amelia', 'amelia', 1, 29.45, 31.00, 65.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184315, 188432, 'Ana', 'ana', 2, 13.30, 14.00, 60.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184316, 188432, 'Azure', 'azure', 3, 13.30, 14.00, 35.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184317, 188432, 'Bianka', 'bianka', 4, 12.35, 13.00, 28.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184318, 188432, 'Carly', 'carly', 5, 23.75, 25.00, 55.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184319, 188432, 'Cassie', 'cassie', 6, 13.30, 14.00, 35.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184320, 188432, 'Classic T', 'classic-t', 7, 15.20, 16.00, 35.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184321, 188432, 'Gracie', 'gracie', 8, 14.25, 15.00, 28.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184322, 188432, 'Irma', 'irma', 9, 14.25, 15.00, 35.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184323, 188432, 'Jade', 'jade', 10, 24.70, 26.00, 55.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184324, 188432, 'Jill', 'jill', 11, 23.75, 25.00, 55.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184325, 188432, 'Jordan', 'jordan', 12, 27.55, 29.00, 65.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184326, 188432, 'Joy', 'joy', 13, 17.10, 18.00, 60.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184327, 188432, 'Julia', 'julia', 14, 17.10, 18.00, 45.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184328, 188432, 'Kids Azure', 'kids-azure', 15, 9.98, 10.50, 25.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184329, 188432, 'Kids Leggings', 'kids-leggings', 16, 16.15, 17.00, 23.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184330, 188432, 'Leggings', 'leggings', 17, 9.98, 10.50, 24.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184331, 188432, 'Lindsey', 'lindsey', 18, 19.95, 21.00, 48.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184332, 188432, 'Lola', 'lola', 19, 19.95, 21.00, 46.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184333, 188432, 'Lucy', 'lucy', 20, 21.85, 23.00, 52.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184334, 188432, 'Madison', 'madison', 21, 21.85, 23.00, 46.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184335, 188432, 'Mae', 'mae', 22, 14.25, 15.00, 32.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184336, 188432, 'Mark', 'mark', 23, 19.00, 20.00, 42.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184337, 188432, 'Maxi', 'maxi', 24, 19.95, 21.00, 42.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184338, 188432, 'Monroe', 'monroe', 25, 19.95, 21.00, 48.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184339, 188432, 'Nicole', 'nicole', 26, 21.85, 23.00, 48.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184340, 188432, 'Patrick', 'patrick', 27, 19.95, 21.00, 40.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184341, 188432, 'Perfect T', 'perfect-t', 28, 16.15, 17.00, 36.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184342, 188432, 'Randy', 'randy', 29, 15.20, 16.00, 35.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184343, 188432, 'Sarah', 'sarah', 30, 28.50, 30.00, 70.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL),
	(184344, 188432, 'Sloan', 'sloan', 31, 12.35, 13.00, 28.00, '2016-10-15 06:27:47', '2016-10-15 06:27:47', NULL);
";

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table(\Kabooodle\Models\InventoryTypeStyles::getTableName())->truncate();
        DB::statement($sql);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

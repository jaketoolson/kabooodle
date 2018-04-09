<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryStylesSizesTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_styles_sizes', function(Blueprint $table){
            $table->increments('id');
            $table->integer('inventory_type_style_id')->unsigned();
            $table->integer('inventory_size_id')->unsigned();

            $table->index(['inventory_type_style_id', 'inventory_size_id'], 'style_size_idx');

            $table->foreign('inventory_type_style_id')
                ->references('id')->on(\Kabooodle\Models\InventoryTypeStyles::getTableName())
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('inventory_size_id')
                ->references('id')->on(\Kabooodle\Models\InventorySizes::getTableName())
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        $sql = "
        INSERT INTO `inventory_styles_sizes` (`id`, `inventory_type_style_id`, `inventory_size_id`)
VALUES
	(1, 184313, 193234),
	(2, 184313, 193235),
	(3, 184313, 193236),
	(4, 184313, 193237),
	(5, 184313, 193238),
	(6, 184313, 193239),
	(7, 184317, 193241),
	(8, 184317, 193242),
	(9, 184317, 193244),
	(10, 184321, 193234),
	(11, 184321, 193235),
	(12, 184321, 193236),
	(13, 184321, 193237),
	(14, 184321, 193238),
	(15, 184321, 193239),
	(16, 184321, 193240),
	(17, 184328, 193234),
	(18, 184328, 193235),
	(19, 184328, 193236),
	(20, 184328, 193237),
	(21, 184328, 193238),
	(22, 184328, 193239),
	(23, 184328, 193240),
	(24, 184329, 193251),
	(25, 184329, 193247),
	(26, 184335, 193234),
	(27, 184335, 193235),
	(28, 184335, 193236),
	(29, 184335, 193237),
	(30, 184335, 193238),
	(31, 184335, 193239),
	(32, 184344, 193234),
	(33, 184344, 193235),
	(34, 184344, 193236),
	(35, 184344, 193237),
	(36, 184344, 193238),
	(37, 184344, 193239),
	(38, 184344, 193240),
	(39, 184314, 193256),
	(40, 184314, 193255),
	(41, 184314, 193250),
	(42, 184314, 193248),
	(43, 184314, 193246),
	(44, 184314, 193254),
	(45, 184314, 193243),
	(46, 184314, 193245),
	(47, 184315, 193255),
	(48, 184315, 193250),
	(49, 184315, 193248),
	(50, 184315, 193246),
	(51, 184315, 193254),
	(52, 184315, 193243),
	(53, 184315, 193245),
	(54, 184316, 193255),
	(55, 184316, 193250),
	(56, 184316, 193248),
	(57, 184316, 193246),
	(58, 184316, 193254),
	(59, 184316, 193243),
	(60, 184316, 193245),
	(61, 184318, 193256),
	(62, 184318, 193255),
	(63, 184318, 193250),
	(64, 184318, 193248),
	(65, 184318, 193246),
	(66, 184318, 193254),
	(67, 184318, 193243),
	(68, 184318, 193245),
	(69, 184319, 193255),
	(70, 184319, 193250),
	(71, 184319, 193248),
	(72, 184319, 193246),
	(73, 184319, 193254),
	(74, 184319, 193243),
	(75, 184319, 193245),
	(76, 184320, 193256),
	(77, 184320, 193255),
	(78, 184320, 193250),
	(79, 184320, 193248),
	(80, 184320, 193246),
	(81, 184320, 193254),
	(82, 184320, 193243),
	(83, 184320, 193245),
	(84, 184322, 193256),
	(85, 184322, 193255),
	(86, 184322, 193250),
	(87, 184322, 193248),
	(88, 184322, 193246),
	(89, 184322, 193254),
	(90, 184322, 193243),
	(91, 184322, 193245),
	(92, 184323, 193255),
	(93, 184323, 193250),
	(94, 184323, 193248),
	(95, 184323, 193246),
	(96, 184323, 193254),
	(97, 184323, 193243),
	(98, 184324, 193256),
	(99, 184324, 193255),
	(100, 184324, 193250),
	(101, 184324, 193248),
	(102, 184324, 193246),
	(103, 184324, 193254),
	(104, 184324, 193243),
	(105, 184325, 193255),
	(106, 184325, 193250),
	(107, 184325, 193248),
	(108, 184325, 193246),
	(109, 184325, 193254),
	(110, 184325, 193243),
	(111, 184326, 193256),
	(112, 184326, 193255),
	(113, 184326, 193250),
	(114, 184326, 193248),
	(115, 184326, 193246),
	(116, 184326, 193254),
	(117, 184326, 193243),
	(118, 184326, 193245),
	(119, 184327, 193256),
	(120, 184327, 193255),
	(121, 184327, 193250),
	(122, 184327, 193248),
	(123, 184327, 193246),
	(124, 184327, 193254),
	(125, 184327, 193243),
	(126, 184327, 193245),
	(127, 184330, 193253),
	(128, 184330, 193249),
	(129, 184330, 193252),
	(130, 184331, 193250),
	(131, 184331, 193248),
	(132, 184331, 193246),
	(133, 184332, 193256),
	(134, 184332, 193255),
	(135, 184332, 193250),
	(136, 184332, 193248),
	(137, 184332, 193246),
	(138, 184332, 193254),
	(139, 184332, 193243),
	(140, 184333, 193256),
	(141, 184333, 193255),
	(142, 184333, 193250),
	(143, 184333, 193248),
	(144, 184333, 193246),
	(145, 184333, 193254),
	(146, 184333, 193243),
	(147, 184334, 193255),
	(148, 184334, 193250),
	(149, 184334, 193248),
	(150, 184334, 193246),
	(151, 184334, 193254),
	(152, 184334, 193243),
	(153, 184334, 193245),
	(154, 184337, 193256),
	(155, 184337, 193255),
	(156, 184337, 193250),
	(157, 184337, 193248),
	(158, 184337, 193246),
	(159, 184337, 193254),
	(160, 184337, 193243),
	(161, 184337, 193245),
	(162, 184338, 193250),
	(163, 184338, 193246),
	(164, 184339, 193256),
	(165, 184339, 193255),
	(166, 184339, 193250),
	(167, 184339, 193248),
	(168, 184339, 193246),
	(169, 184339, 193254),
	(170, 184339, 193243),
	(171, 184339, 193245),
	(172, 184341, 193256),
	(173, 184341, 193255),
	(174, 184341, 193250),
	(175, 184341, 193248),
	(176, 184341, 193246),
	(177, 184341, 193254),
	(178, 184341, 193243),
	(179, 184341, 193245),
	(180, 184342, 193256),
	(181, 184342, 193255),
	(182, 184342, 193250),
	(183, 184342, 193248),
	(184, 184342, 193246),
	(185, 184342, 193254),
	(186, 184342, 193243),
	(187, 184342, 193245),
	(188, 184343, 193255),
	(189, 184343, 193250),
	(190, 184343, 193248),
	(191, 184343, 193246),
	(192, 184343, 193254),
	(193, 184336, 193248),
	(194, 184336, 193246),
	(195, 184336, 193254),
	(196, 184336, 193243),
	(197, 184336, 193245),
	(198, 184340, 193248),
	(199, 184340, 193246),
	(200, 184340, 193254),
	(201, 184340, 193243),
	(202, 184340, 193245);
";

        DB::statement(DB::raw($sql));

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
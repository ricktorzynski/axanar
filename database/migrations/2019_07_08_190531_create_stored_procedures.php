<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateStoredProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
CREATE PROCEDURE getListToShipForItem(IN skuId INT)
BEGIN
    SELECT u.user_id, u.full_name, u.email, address_1, address_2, city,country, state, zip, gender, shirtSize, COUNT(1) AS numToShip 
    FROM Users u
    JOIN UserCampaignPackages c ON u.user_id = c.user_id
    JOIN PackageSkuItems i ON i.package_id = c.package_id
    JOIN SKUItems s ON s.sku_id = i.sku_id
    JOIN Addresses a ON a.user_id = u.user_id
    LEFT JOIN UserSKUItems usi ON u.user_id = usi.user_id AND usi.sku_id = i.sku_id
    WHERE need_update = 0
        AND i.sku_id = skuId
    GROUP BY 1,2,3,4,5,6,7,8,9,10,11;
END
SQL;
        DB::unprepared($sql);

        $sql = <<<SQL
CREATE PROCEDURE getListShippedForItem(IN skuId INT)
BEGIN
    SELECT u.user_id, u.full_name, u.email, address_1, address_2, city,country, state, zip, gender, shirtSize, COUNT(1) AS numToShip 
    FROM Users u
    JOIN UserCampaignPackages c ON u.user_id = c.user_id
    JOIN PackageSkuItems i ON i.package_id = c.package_id
    JOIN SKUItems s ON s.sku_id = i.sku_id
    JOIN Addresses a ON a.user_id = u.user_id
    LEFT JOIN UserSKUItems usi ON u.user_id = usi.user_id AND usi.sku_id = i.sku_id
    WHERE need_update = 0
        AND i.sku_id = skuId
        AND usi.shipped = 1
    GROUP BY 1,2,3,4,5,6,7,8,9,10,11;
END
SQL;
        DB::unprepared($sql);

        $sql = <<<SQL
CREATE PROCEDURE getListShippedForTier(IN packageId INT)
BEGIN
    SELECT u.user_id, u.full_name, u.email, address_1, address_2, city,country, state, zip, gender, shirtSize, COUNT(1) AS numToShip 
    FROM Users u
    JOIN UserCampaignPackages c ON u.user_id = c.user_id
    JOIN Packages p ON p.package_id = c.package_id
    JOIN Addresses a ON a.user_id = u.user_id
    LEFT JOIN UserSKUItems usi ON u.user_id = usi.user_id AND usi.package_id = p.package_id
    WHERE need_update = 0
        AND p.package_id = packageId
        AND c.shipped = 1
    GROUP BY 1,2,3,4,5,6,7,8,9,10,11;
END
SQL;

        DB::unprepared($sql);

        $sql = <<<SQL
CREATE PROCEDURE getListToShipForTier(IN packageId INT)
BEGIN
    SELECT u.user_id, u.full_name, u.email, address_1, address_2, city,country, state, zip, gender, shirtSize, COUNT(1) AS numToShip FROM Users u
    JOIN UserCampaignPackages c ON u.user_id = c.user_id
    JOIN Packages p ON p.package_id = c.package_id
    JOIN Addresses a ON a.user_id = u.user_id
    WHERE need_update = 0
        AND p.package_id = packageId
#         AND c.shipped = 0
    GROUP BY 1,2,3,4,5,6,7,8,9,10,11;
END
SQL;

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS `getListToShipForItem`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `getListShippedForItem`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `getListShippedForTier`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `getListToShipForTier`');
    }
}

<?php

namespace Ares\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Campaigns extends BaseModel
{
    /** @inheritdoc */
    protected $table = 'Campaigns';
    /** @inheritdoc */
    protected $primaryKey = 'campaign_id';
    /** @inheritdoc */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'active' => 'bool',
    ];
    /** @inheritdoc */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function packages()
    {
        return $this->hasOne(Packages::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userCampaignPackages()
    {
        return $this->hasMany(UserCampaignPackages::class);
    }

    /**
     * @param int      $active
     * @param int|null $userId
     *
     * @return array
     */
    public static function getByUserId(int $active = 1, int $userId = null)
    {
        $ucPackages =
            UserCampaignPackages::userId($userId ?? Auth::id() ?? 0)
                ->distinct()
                ->get('campaign_id')
                ->toArray();
        $idList = array_column($ucPackages, 'campaign_id');

        if (empty($idList)) {
            return [];
        }

        $campaigns = Campaigns::where('active', $active)->whereIn('campaign_id', $idList)->get()->toArray();
        return $campaigns;
    }

    /**
     * @param int      $campaignId
     * @param int|null $userId
     *
     * @return array|bool|mixed
     */
    public static function getUserDonations($campaignId, int $userId = null)
    {
        $campaign = static::find($campaignId);
        if (empty($campaign)) {
            return [];
        }

        $userId = $userId ?? Auth::id();

        $sql = <<<MYSQL
SELECT *, p.name AS pkg_name, p.sort_order_nbr 
FROM Campaigns c 
JOIN UserCampaignPackages uc ON c.campaign_id = uc.campaign_id 
JOIN Packages p ON p.package_id = uc.package_id 
WHERE uc.user_id = ?
  AND c.campaign_id = ?
ORDER BY p.sort_order_nbr, p.name  
MYSQL;

        $rows = DB::select($sql, [$userId, $campaignId]);
        return static::resultsToArray($rows);
    }

    /***
     * @param int $campaignId
     *
     * @return array
     */
    public static function getElements(int $campaignId)
    {
        $sql = <<<MYSQL
SELECT p.*, p.name as packageName
FROM Packages p 
WHERE campaign_id = ? 
ORDER BY campaign_id, cost;
MYSQL;

        $rows = DB::select($sql, [$campaignId]);
        return static::resultsToArray($rows);
    }
}

<?php

use Illuminate\Database\Seeder;

class CorporationsTableSeeder extends Seeder
{
    private const SUPPORT_TEL1S = ['090', '080', '070'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i = 1; $i < 10; $i++) {
        	DB::table('corporations')->insert($this->getDummyData($i));
    	}
    }

    /**
     * ダミーデータ作成.
     */
    private function getDummyData($index)
    {
    	return [
            'name' => sprintf("株式会社テスト%d", $index),
            'corporation_site_url' => sprintf("https://test%d.co.jp", $index),
            'support_tel1' => self::SUPPORT_TEL1S[$index % count(self::SUPPORT_TEL1S)],
            'support_tel2' => sprintf("%'.04d\n", $index),
            'support_tel3' => sprintf("%'.04d\n", $index + 1),
            'support_email' => sprintf("testuser%d@test%d.co.jp", $index, $index),
            'created_user_id' => 0,
            'update_user_id' => 0,
    	];
    }
}

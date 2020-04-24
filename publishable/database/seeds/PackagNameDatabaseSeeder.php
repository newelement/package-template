<?php
use Illuminate\Database\Seeder;
use Newelement\PackageName\Traits\Seedable;
class PackageNameDatabaseSeeder extends Seeder
{
    use Seedable;
    protected $seedersPath = __DIR__.'/';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->seed('MyTableSeeder');

    }
}

<?php
// app/Console/Commands/ResetDemoData.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetDemoData extends Command
{
    protected $signature   = 'demo:reset';
    protected $description = 'Reset all demo data (runs every 30 minutes)';

    public function handle(): void
    {
        $this->info('🔄 Resetting demo data...');

        DB::table('finance_incomes')->delete();
        DB::table('finance_expenses')->delete();
        DB::table('water_payments')->delete();
        DB::table('water_customers')->delete();
        DB::table('blog_comments')->delete();
        DB::table('blog_posts')->delete();

        $this->info('✅ Demo data reset complete at ' . now());
    }
}
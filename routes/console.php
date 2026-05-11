<?php

use Illuminate\Support\Facades\Schedule;

// Reset demo data every 30 minutes
Schedule::command('demo:reset')->everyThirtyMinutes();
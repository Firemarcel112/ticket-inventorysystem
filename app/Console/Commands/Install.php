<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sbs:install {--debug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optmiert alle Dateien und migriert die Datenbank [--debug für den Entwicklungsmodus]';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $envFile = base_path('.env');
        $setEnv = file_get_contents($envFile);
        if (!file_exists($envFile)) $this->error('.env Datei wurde nicht gefunden!');

        if ($this->option('debug')) {
            file_put_contents($envFile, str_replace('APP_DEBUG=false', 'APP_DEBUG=true', $setEnv));
            file_put_contents($envFile, str_replace('APP_ENV=production', 'APP_ENV=local', $setEnv));
            goto afterSecurityCheck;
        }

        if (env("DB_DATABASE") === "laravel") {
            $this->error("Bitte prüfe deine Datenbankverbindung in der .env datei");
            $this->error("Die Datenbank sollte nicht \"laravel\" heissen");
            return 0;
        }

        if (env("DB_PASSWORD") === "") {
            $this->error("Bitte setze ein Datenbankpasswort, andernfalls ist die Anwendung unsicher!");
            return 0;
        }

        $this->line('Anwendung wird aus dem Entwicklermodus genommen!');
        file_put_contents($envFile, str_replace('APP_DEBUG=true', 'APP_DEBUG=false', $setEnv));
        file_put_contents($envFile, str_replace('APP_ENV=local', 'APP_ENV=production', $setEnv));
        $this->line('Anwendung wurde aus dem Entwicklermodus genommen!');
        afterSecurityCheck:
        $this->line("Datenbank wird aufgesetzt:");
        $this->call('migrate:fresh');
        $this->line("Dateien werden optimiert:");
        $this->call('optimize');

        if ($this->option('debug')) {
            $this->info('Anwendung ist nun im Entwicklermodus');
            $this->line('');
        } else {
            $this->info("Anwendung wurde erfolgreich installiert");
            $this->line('');
        }

        $this->line('<fg=magenta>Zugangsdaten für Seitenlogin</>');
        $this->line('');
        $this->line('<fg=blue>Benutzername:</> Administrator');
        $this->line('<fg=red>Passwort:</> I821123');
        $this->info('Ändere die Zugangsdaten bevor deine Webseite Live geht!');

        return Command::SUCCESS;
    }
}

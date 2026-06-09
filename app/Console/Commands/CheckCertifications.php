<?php

namespace App\Console\Commands;

use App\Models\Certification;
use Illuminate\Console\Command;

class CheckCertifications extends Command
{
    protected $signature   = 'sst:check-certifications';
    protected $description = 'Revisa certificaciones vencidas y próximas a vencer';

    public function handle()
    {
        $this->info('Revisando certificaciones... ' . now()->format('d/m/Y H:i'));

        $expired = Certification::with(['employee', 'course'])
            ->whereDate('expiry_date', '<', now())
            ->get();

        $expiringSoon = Certification::with(['employee', 'course'])
            ->whereDate('expiry_date', '>=', now())
            ->whereDate('expiry_date', '<=', now()->addDays(30))
            ->get();

        if ($expired->count() > 0) {
            $this->error("VENCIDAS: {$expired->count()} certificación(es)");
            foreach ($expired as $cert) {
                $this->line("  - {$cert->employee->full_name} | {$cert->course->name} | Venció: {$cert->expiry_date->format('d/m/Y')}");
            }
        }

        if ($expiringSoon->count() > 0) {
            $this->warn("POR VENCER: {$expiringSoon->count()} certificación(es) en los próximos 30 días");
            foreach ($expiringSoon as $cert) {
                $daysLeft = (int) now()->diffInDays($cert->expiry_date);
                $this->line("  - {$cert->employee->full_name} | {$cert->course->name} | Vence en: {$daysLeft} días");
            }
        }

        if ($expired->count() === 0 && $expiringSoon->count() === 0) {
            $this->info('Todo en orden. No hay certificaciones vencidas ni por vencer.');
        }

        $this->info('Revisión completada.');

        return Command::SUCCESS;
    }
}

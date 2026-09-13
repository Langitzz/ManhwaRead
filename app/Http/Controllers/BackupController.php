<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Process;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BackupController extends Controller
{
    /**
     * Tampilkan halaman Backup Database.
     */
    public function index(): View
    {
        return view('admin.backup.index');
    }

    /**
     * Generate & download backup database.
     */
    public function download(): BinaryFileResponse
    {
        $fileName = 'backup-manhwaread-'.now()->format('Y-m-d_His').'.sql';
        $tempDir = storage_path('app/temp');
        $filePath = $tempDir.DIRECTORY_SEPARATOR.$fileName;

        if (! is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        $host = config('database.connections.mysql.host');
        $port = config('database.connections.mysql.port');
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');

        $mysqldumpPath = env('MYSQLDUMP_PATH', 'mysqldump');

        $command = [$mysqldumpPath, '-h', $host, '-P', $port, '-u', $username];

        if (! empty($password)) {
            $command[] = '-p'.$password;
        }

        $command[] = $database;
        $command[] = '--result-file='.$filePath;

        $result = Process::env(['SystemRoot' => getenv('SystemRoot') ?: 'C:\\Windows'])
            ->run($command);

        if (! $result->successful() || ! file_exists($filePath) || filesize($filePath) === 0) {
            abort(500, 'Gagal membuat backup database: '.$result->errorOutput());
        }

        ActivityLog::catat('Membuat Backup Database', $fileName);

        return response()->download($filePath, $fileName)->deleteFileAfterSend(true);
    }
}

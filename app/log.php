<?php

class Log
{
    const DEBUG = 1;
    const INFO = 2;
    const WARNING = 3;
    const ERROR = 4;
    const CRITICAL = 5;
    
    private $logDir;
    private $logFile;
    private $maxBytes;
    private $backupCount;
    private $consoleOutput;
    private $loggerName;
    private $logLevel;

    public function __construct($loggerName, $logDir = 'storage/logs', $logFile = 'app.log', $maxBytes = 1048576, $backupCount = 5, $consoleOutput = true, $logLevel = self::DEBUG)
    {
        $this->loggerName = $loggerName;
        $this->logDir = rtrim($logDir, '/');
        $this->logFile = $logFile;
        $this->maxBytes = $maxBytes;
        $this->backupCount = $backupCount;
        $this->consoleOutput = $consoleOutput;
        $this->logLevel = $logLevel;

        // Create log directory if it doesn't exist
        if (!is_dir($this->logDir)) {
            if (!mkdir($this->logDir, 0777, true)) {
                throw new Exception("Failed to create log directory: {$this->logDir}");
            }
        }
    }

    public function debug($message)
    {
        $this->log(self::DEBUG, $message);
    }

    public function info($message)
    {
        $this->log(self::INFO, $message);
    }

    public function warning($message)
    {
        $this->log(self::WARNING, $message);
    }

    public function error($message)
    {
        $this->log(self::ERROR, $message);
    }

    public function critical($message)
    {
        $this->log(self::CRITICAL, $message);
    }

    private function log($level, $message)
    {
        if ($level < $this->logLevel) {
            return;
        }

        $levelName = $this->getLevelName($level);
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[{$timestamp}] [{$this->loggerName}] [{$levelName}] {$message}" . PHP_EOL;

        // Write to file with rotation
        $this->writeToFile($logEntry);

        // Write to console if enabled
        if ($this->consoleOutput) {
            echo $logEntry;
        }
    }

    private function getLevelName($level)
    {
        switch ($level) {
            case self::DEBUG: return 'DEBUG';
            case self::INFO: return 'INFO';
            case self::WARNING: return 'WARNING';
            case self::ERROR: return 'ERROR';
            case self::CRITICAL: return 'CRITICAL';
            default: return 'UNKNOWN';
        }
    }

    private function writeToFile($logEntry)
    {
        $filePath = $this->getLogFilePath();

        // Rotate log file if needed
        if (file_exists($filePath)) {
            $fileSize = filesize($filePath);
            if ($fileSize >= $this->maxBytes) {
                $this->rotateLogs($filePath);
            }
        }

        if (file_put_contents($filePath, $logEntry, FILE_APPEND) === false) {
            throw new Exception("Failed to write to log file: {$filePath}");
        }
    }

    private function rotateLogs($filePath)
    {
        for ($i = $this->backupCount; $i > 0; $i--) {
            $src = $i === 1 ? $filePath : "{$filePath}.{" . ($i - 1) . "}";
            $dst = "{$filePath}.{$i}";

            if (file_exists($src)) {
                rename($src, $dst);
            }
        }
    }

    private function getLogFilePath()
    {
        return "{$this->logDir}/{$this->logFile}";
    }
}
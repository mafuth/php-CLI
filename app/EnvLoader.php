<?php

class EnvLoader
{
    protected $env = [];

    public function __construct(string $envPath = __DIR__ . '/.env')
    {
        // Load environment variables from system
        $this->env = $_ENV + $_SERVER + getenv();

        // Parse .env file
        if (file_exists($envPath)) {
            $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                $line = trim($line);
                if ($line === '' || $line[0] === '#') {
                    continue;
                }

                [$key, $value] = array_pad(explode('=', $line, 2), 2, null);
                $key = trim($key);
                $value = $this->castValue(trim($value, " \t\n\r\0\x0B\"'"));

                if (!array_key_exists($key, $this->env)) {
                    $this->env[$key] = $value;
                }

                putenv("$key=$value");
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }
    }

    protected function castValue(string $value)
    {
        $lower = strtolower($value);

        if ($lower === 'true') return true;
        if ($lower === 'false') return false;
        if ($lower === 'null') return null;

        return $value;
    }

    public function get(string $key, $default = null)
    {
        return $this->env[$key] ?? $default;
    }

    public function all(): array
    {
        return $this->env;
    }
}

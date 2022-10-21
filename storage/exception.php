<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Error</title>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    </head>
    <body class="bg-indigo-600">
        <div class="flex items-center justify-center w-screen h-screen">
            <div class="px-40 py-20 bg-white rounded-md shadow-xl">
                <div class="flex flex-col items-center">
                    <h1 class="font-bold text-blue-600 text-9xl">Error</h1>
                    <p class="mb-8 text-center text-gray-500 md:text-lg">
                        <?php echo $e->getMessage(); ?>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>  
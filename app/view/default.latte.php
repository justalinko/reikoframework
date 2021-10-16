<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title|upper}</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="flex h-screen">
            <div class="m-auto flex flex-col items-center">
                <p class="pb-5 text-6xl font-light text-center tracking-widest text-purple-600">{$title|upper}</p>
                <div class="flex flex-row gap-x-7" >
                 <a n:foreach="$menus as $menu=>$link" href="{$link}" class="hover:text-purple-600">{$menu|capitalize}</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
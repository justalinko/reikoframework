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

<body class="bg-gray-200">
    <div id="app">
        <nav class="font-sans flex flex-col text-center content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 bg-white shadow sm:items-baseline w-full">

            <div class="mb-2 sm:mb-0 flex flex-row">
                <div class="h-10 w-16 self-center mr-2">
                    <img class="h-10 w-16 self-center" src="http://reikophp.justalinko.com/img/logo.png" />
                </div>
                <div>
                    <a href="/home" class="text-2xl no-underline text-purple-600 hover:text-black font-sans font-bold">REIKO</a><br>
                    <span class="text-xs text-grey-dark">The PHP Web Framework for simplicity</span>
                </div>
            </div>

            <div class="sm:mb-0 self-center ">

                <a n:foreach="$menus as $menu=>$link" href="{$link}" class="text-md no-underline text-purple-600 hover:text-black ml-2 px-1">{$menu|capitalize}</a>
            </div>
        </nav>
        <div class="flex mt-60">

            <div class="m-auto flex flex-col items-center">

                <p class="pb-5 text-6xl font-bold text-center tracking-widest text-purple-600">It's work !</p>
                <p class="text-md font-light text-center text-black">Congratulations! You have successfully created your Reiko Application.</p>
                <div class="flex mt-5">
                 <div>
                        <button type="button" class="bg-purple-600 text-white p-2 rounded  leading-none flex items-center">
                            Environment <span class="bg-white p-1 rounded text-blue-600 text-xs ml-2">{env_check()}</span>
                        </button>
                    </div>
                    <div>
                        <button type="button" class="ml-2 bg-purple-700 text-white p-2 rounded  leading-none flex items-center">
                            PHP Version <span class="bg-white p-1 rounded text-blue-600 text-xs ml-2">{phpversion()}</span>
                        </button>
                    </div>
                    <div>
                        <button type="button" class="ml-2 bg-indigo-600 text-white p-2 rounded  leading-none flex items-center">
                            Database
                            {if is_db_connected() === true}
                            {var $status = 'Connected'}
                            {var $class = 'bg-green-500 p-1 rounded text-white text-xs ml-2'}
                            {else}
                            {var $status = 'Not connected'}
                            {var $class = 'bg-red-500 p-1 rounded text-white text-xs ml-2'}
                            {/if}
                            <span class="{$class}">{$status}</span>
                        </button>
                    </div>
                       <div>
                        <button type="button" class="ml-2 bg-indigo-700 text-white p-2 rounded  leading-none flex items-center">
                            Rendered Time <span class="bg-white p-1 rounded text-blue-600 text-xs ml-2">{get_time_rendered()}</span>
                        </button>
                    </div>
                </div>
            </div>
            {csrf_form()|noescape}
        </div>
    </div>
</body>

</html>
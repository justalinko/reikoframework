<?php

use Latte\Runtime as LR;

/** source: /mnt/c/Projects/PHP/reikoframework/app//view/default.latte.php */
final class Templated92ade53e0 extends Latte\Runtime\Template
{

	public function main(): array
	{
		extract($this->params);
		echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reiko Framework</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: \'Nunito\', sans-serif;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="flex h-screen">
            <div class="m-auto flex flex-col items-center">
                <p class="pb-5 text-6xl font-extralight text-center">REIKO FRAMEWORK</p>
                <div class="flex flex-row gap-x-7">
                    <a href="#">Home</a>
                    <a href="#">Documentation</a>
                    <a href="#">Contribute</a>
                    <a href="#">Donate</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>';
		return get_defined_vars();
	}

}

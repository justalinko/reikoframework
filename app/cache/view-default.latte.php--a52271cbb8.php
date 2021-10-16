<?php

use Latte\Runtime as LR;

/** source: /home/iu/reikoframework/app//view/default.latte.php */
final class Templatea52271cbb8 extends Latte\Runtime\Template
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
</head>
<body>
    <div id="app">
        <div class="flex h-screen">
            <div class="m-auto">
                <p class="pb-5 text-xl font-semibold">REIKO FRAMEWORK</p>
                <div class="rounded-lg border grid grid-cols-2 gap-5 p-5">
                    <div class="w-96 border-b border-r rounded-lg p-5">
                        <p class="text-lg font-medium">Home</p>
                        <p class="py-2">Cupcake ipsum dolor sit amet sweet. I love toffee muffin I love sweet caramels jelly. Chupa chups I love jujubes powder marshmallow dessert tootsie roll carrot cake I love.</p>
                        <a href="#" class="flex flex-row items-center justify-items-center gap-x-3 text-indigo-500 pointer appearance-none cursor-pointer">
                            Read More
                            <svg class="w-5 h-5 stroke-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                    <div class="w-96 border-b border-l rounded-lg p-5">
                        <p class="text-lg font-medium">Documentation</p>
                        <p class="py-2">Cupcake ipsum dolor sit amet sweet. I love toffee muffin I love sweet caramels jelly. Chupa chups I love jujubes powder marshmallow dessert tootsie roll carrot cake I love.</p>
                        <a href="#" class="flex flex-row items-center justify-items-center gap-x-3 text-indigo-500 pointer appearance-none cursor-pointer">
                            Read More
                            <svg class="w-5 h-5 stroke-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                    <div class="w-96 border-t border-r rounded-lg p-5">
                        <p class="text-lg font-medium">Contribute</p>
                        <p class="py-2">Cupcake ipsum dolor sit amet sweet. I love toffee muffin I love sweet caramels jelly. Chupa chups I love jujubes powder marshmallow dessert tootsie roll carrot cake I love.</p>
                        <a href="#" class="flex flex-row items-center justify-items-center gap-x-3 text-indigo-500 pointer appearance-none cursor-pointer">
                            Read More
                            <svg class="w-5 h-5 stroke-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                    <div class="w-96 border-t border-l rounded-lg p-5">
                        <p class="text-lg font-medium">Donate</p>
                        <p class="py-2">Cupcake ipsum dolor sit amet sweet. I love toffee muffin I love sweet caramels jelly. Chupa chups I love jujubes powder marshmallow dessert tootsie roll carrot cake I love.</p>
                        <a href="#" class="flex flex-row items-center justify-items-center gap-x-3 text-indigo-500 pointer appearance-none cursor-pointer">
                            Read More
                            <svg class="w-5 h-5 stroke-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>';
		return get_defined_vars();
	}

}

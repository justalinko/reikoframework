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
</head>
<body>
    <center>
';
		if ($items) /* line 11 */ {
			echo '        <ul>
';
			$iterations = 0;
			foreach ($items as $item) /* line 12 */ {
				echo '            <li>';
				echo LR\Filters::escapeHtmlText(($this->filters->capitalize)($item)) /* line 12 */;
				echo '</li>
';
				$iterations++;
			}
			echo '        </ul>
';
		}
		echo '        <h1>Welcome</h1>
        ';
		echo input_group([
			'username' => ['type' => 'text',
				'value'=> '',
				'attr' => ['id' => 'username']
			],
			'password' => ['type' => 'password',
				'value'=> '',
				'attr' => ['id' => 'password']
			]
		]) /* line 15 */;
		echo '
    </center>
</body>
</html>';
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['item' => '12'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		
	}

}

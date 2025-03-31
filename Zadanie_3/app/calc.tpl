{extends file="../templates/main.html"}


{block name=content}

<h3>Prosty kalkulator</h2>


<form class="pure-form pure-form-stacked" action="{$app_url}/app/calc.php" method="post">
<label for="id_credit">Kwota kredytu: </label>
<input id="id_credit" type="number" step="any" name="kwota" min="1" required value="<?php if (isset($kwota))
	print($kwota); ?>" /><br />

<label for="id_percent">Oprocentowanie: </label>
<input id="id_percent" type="number" step="any" name="procent" min="0" required value="<?php if (isset($procent))
	print($procent); ?>" /><br />

<label for="id_years">Liczba lat kredytu: </label>
<input id="id_years" type="number" name="lata" min="1" required value="<?php if (isset($lata))
	print($lata); ?>" /><br />
<input class="pure-button pure-button-primary" type="submit" value="Oblicz miesięczną ratę" />
</form>


<div class="messages">

{* wyświeltenie listy błędów, jeśli istnieją *}
{if isset($messages)}
	{if count($messages) > 0} 
		<h4>Wystąpiły błędy: </h4>
		<ol class="err">
		{foreach  $messages as $msg}
		{strip}
			<li>{$msg}</li>
		{/strip}
		{/foreach}
		</ol>
	{/if}
{/if}

{* wyświeltenie listy informacji, jeśli istnieją *}
{if isset($infos)}
	{if count($infos) > 0} 
		<h4>Informacje: </h4>
		<ol class="inf">
		{foreach  $infos as $msg}
		{strip}
			<li>{$msg}</li>
		{/strip}
		{/foreach}
		</ol>
	{/if}
{/if}

{if isset($result)}
	<h4>Wynik</h4>
	<p class="res">
	{$result}
	</p>
{/if}

</div>

{/block}

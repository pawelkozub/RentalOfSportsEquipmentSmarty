<table id='table'>
<tr>
<td id='menu'>
{if ($smarty.session.Account == "User")}
{include file="menu_user.tpl"}
{elseif $smarty.session.Account == "Admin"}
{include file="menu_admin.tpl"}
{/if}
</td>
<td width='15px'></td>
<td id='tresc'>
<div style='position:relative'>
{if ($smarty.session.Account == "User")}
{$tresc_user}
{elseif $smarty.session.Account == "Admin"}
{$tresc_admin}
{/if}
</div>
</td>
</tr>
</table>
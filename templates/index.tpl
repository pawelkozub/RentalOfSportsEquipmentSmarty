{include file="header.tpl"}

{if ($smarty.session.Account == "")}
{include file="body.tpl"}
{elseif ($smarty.session.Account == "Admin" || $smarty.session.Account == "User" )}
	{if ($smarty.session.change_pass == 1)}
	{include file="body_account.tpl"}
	{elseif ($smarty.session.change_pass == 0)}
	{include file="body_change_pass.tpl"}
	{/if}
{/if}

{if ($smarty.session.Account == "")}
{include file="footer.tpl"}
{elseif ($smarty.session.Account == "Admin")}
{include file="footer_admin.tpl"}
{elseif ($smarty.session.Account == "User" && $smarty.session.change_pass ==1)}
{include file="footer_user.tpl"}
{/if}

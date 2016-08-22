{setlocale type="all" locale="es_ES"}
<h1>&Uacute;ltimas 50 notificaciones</h1>
<table width="100%" cellpadding="5">
{foreach from=$notificactions item=notif}
	<tr  {if $notif@iteration is even}bgcolor="#F2F2F2"{/if}>
		<td {if $notif->viewed === 0 || $notif->viewed === false || $notif->viewed === '0'} style="border-left:5px solid green;" {else} style="border-left:5px solid grey;" {/if}>
		 <small>{$notif->inserted_date|date_format:"%B %e, %Y %l:%M %p"}</small><br/>
		 {$notif->text} 
		<br/>
		<font color="gray">
				<small>
				{if $notif->tag == 'WARNING'} ADVERTENCIA {separator} {/if} 
				{if $notif->tag == 'URGENT'} <font color="red">URGENTE</font>{separator} {/if} 
				{if $notif->tag == 'IMPORTANT'} IMPORTANTE {separator} {/if} 
				</small>
				</small>
			</font>
		</td>
		<td width="30">
			{if $notif->link !== ''}
				{button caption="Ver" color="gree" size="small" href="{$notif->link}"}
			{/if}
		</td>
	</tr>
{/foreach}
</table>
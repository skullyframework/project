{extends file="admin/wrappers/_main.tpl"}
{block name=header}<title>Site Admin</title>{/block}
{block name=content}
	<div class="span12">
		{include file='admin/widgets/_alerts.tpl' }
		{*<div class="widget">*}
			{*<div class="head dark">*}
				{*<div class="icon"><i class="icos-stats-up"></i></div>*}
				{*<h2>Latest Orders</h2>*}
			{*</div>*}
			{*<div class="block-fluid">*}
				{*{html_table*}
					{*loop=''*}
					{*table_attr='class="aTable table-hover rows_5" rel="'|cat:url('admin/orders/index')|cat:'"style="width: 100%;"'*}
					{*th_attr=$ordersStatsTh*}
					{*cols=$ordersStatsCols*}
				{*}*}
			{*</div>*}
		{*</div>*}
	</div>

	{*<div class="span2">*}
		{*{include file="admin/widgets/rightbar.tpl"}*}
	{*</div>*}
{/block}
{block name=mid}

{/block}
{block name=footer}
<script type="text/javascript">
	{if !empty($columnDefs)}
		{*var _columnDefs = {$columnDefs};*}
	{/if}
</script>
{/block}
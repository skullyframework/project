<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xml:lang="{$xmlLang}" lang="{$xmlLang}">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
{include file="wrappers/header.tpl"}
{block name="meta"}{/block}
{block name=headerAdditional}
	<title>{lang value="mainMetaTitle"}</title>
{/block}
</head>
<body>

<div class="clearfix">
	<div class="mainContent centerWrapper">
	{block name=content}Content here{/block}
	</div>
</div>

<div class="loadingWrapper" style="">
	<div class="loading"></div>
</div>
<div class="mainModal"></div>
{include file="wrappers/dialogTemplate.tpl"}

{block name="scripts"}
{/block}
</body>
</html>
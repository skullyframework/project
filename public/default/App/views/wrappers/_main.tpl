<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  {block name=headBefore}{/block}
  {include file="wrappers/items/_header.tpl"}
  {block name=head}
    <title>{lang value="mainMetaTitle"}</title>
    <meta name="description" content="{lang value="mainMetaDesc"}" />
    <meta name="keywords" content="{lang value="mainMetaKeywords"}" />
  {/block}
  {block name=headAfter}{/block}
</head>
<body>
  <div>
    {block name="content"}{/block}
  </div>
{block name=script}{/block}
{include file="wrappers/items/_analytics.tpl"}
</body>
</html>
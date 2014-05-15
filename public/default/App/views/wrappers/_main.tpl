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
<div class="off-canvas-wrap" data-offcanvas>
    <div class="inner-wrap">
        <nav class="tab-bar">
            <section class="left-small">
                <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
            </section>

            <section class="middle tab-bar-section">
                <h1 class="title">Skully Framework</h1>
            </section>

            <section class="right-small">
                <a class="right-off-canvas-toggle menu-icon" href="#"><span></span></a>
            </section>
        </nav>

        <aside class="left-off-canvas-menu">
            <ul class="off-canvas-list">
                <li><label>Home</label></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Press</a></li>
            </ul>
        </aside>

        <aside class="right-off-canvas-menu">
            <ul class="off-canvas-list">
                {if $isLoggedIn }
                    <li><a href="{url path="users/logout"}">Log Out</a></li>
                {else}
                    <li><a href="{url path="users/login"}">Login</a></li>
                    <li><a href="{url path="users/signup"}">Sign Up</a></li>
                {/if}
            </ul>
        </aside>

        <section class="main-section">
            {block name="content"}{/block}
        </section>

        <a class="exit-off-canvas"></a>

    </div>
</div>
{include file="wrappers/items/_mainScript.tpl"}
{block name=script}{/block}
{include file="wrappers/items/_analytics.tpl"}
</body>
</html>
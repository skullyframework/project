{extends file="admin/wrappers/_error.tpl"}
{block name=header}
<title>Error 403 - No Permission</title>
{/block}
{block name="content"}
<h1>Sorry</h1>
<h2>You don't have permission to view this page, move along, now.</h2>
<button class="btn btn-primary btn-large" onClick="document.location.href = '{url path="admin/home/index"}';">Back to main</button> <button class="btn btn-large" onClick="history.back();">Previous page</button>
{/block}
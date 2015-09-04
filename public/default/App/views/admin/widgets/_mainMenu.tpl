{if $activeMainMenu == "productingredients"}
    {$activeMainMenu = "products"}
{/if}
<ul class="menu-items">
    <li class="m-t-30 {if $activeMainMenu == "home"}open{/if}">
        <a href="{url path='admin/home/index'}" {*class="detailed"*}>
            <span class="title">Dashboard</span>
            {*<span class="details">234 notifications</span>*}
        </a>
        <span class="icon-thumbnail {if $activeMainMenu == "home"}bg-success{/if}"><i class="fa fa-dashboard"></i></span>
    </li>

    {*<li class="{if $activeMainMenu == "productCategories" || $activeMainMenu == "products" || $activeMainMenu == "ingredients"}open{/if}">*}
        {*<a href="javascript:;">*}
            {*<span class="title">Products</span>*}
            {*<span class=" arrow {if $activeMainMenu == "productCategories" || $activeMainMenu == "products" || $activeMainMenu == "ingredients"}open{/if}"></span>*}
        {*</a>*}
        {*<span class="icon-thumbnail {if $activeMainMenu == "productCategories" || $activeMainMenu == "products" || $activeMainMenu == "ingredients"}bg-success{/if}"><i class="fa fa-globe"></i></span>*}
        {*<ul class="sub-menu" {if $activeMainMenu == "productCategories" || $activeMainMenu == "products" || $activeMainMenu == "ingredients"}style="display: block;"{/if}>*}
            {*<li class="{if $activeMainMenu == "products"}open{/if}">*}
                {*<a href="{url path="admin/products/index"}">Products</a>*}
                {*<span class="icon-thumbnail"><i class="fa fa-coffee"></i></span>*}
            {*</li>*}
            {*<li class="{if $activeMainMenu == "productCategories"}open{/if}">*}
                {*<a href="{url path="admin/productCategories/index"}">Product Categories</a>*}
                {*<span class="icon-thumbnail"><i class="pg-menu_lv"></i></span>*}
            {*</li>*}
            {*<li class="{if $activeMainMenu == "ingredients"}open{/if}">*}
                {*<a href="{url path="admin/ingredients/index"}">Ingredients</a>*}
                {*<span class="icon-thumbnail"><i class="fa fa-leaf"></i></span>*}
            {*</li>*}
        {*</ul>*}
    {*</li>*}

    {*<li class="{if $activeMainMenu == "faqs"}open{/if}">*}
        {*<a href="{url path='admin/faqs/index'}" *}{*class="detailed"*}{*>*}
            {*<span class="title">FAQ</span>*}
        {*</a>*}
        {*<span class="icon-thumbnail {if $activeMainMenu == "faqs"}bg-success{/if}"><i class="fa fa-question"></i></span>*}
    {*</li>*}


    <li class="{if $activeMainMenu == "admins"}open{/if}">
        <a href="{url path='admin/admins/index'}">
            <span class="title">Admins</span>
        </a>
        <span class="icon-thumbnail {if $activeMainMenu == "admins"}bg-success{/if}"><i class="fa fa-user-md"></i></span>
    </li>

    <li class="{if $activeMainMenu == "siteLanguages"}open{/if}">
        <a href="{url path='admin/siteLanguages/index'}" {*class="detailed"*}>
            <span class="title">Site Languages</span>
        </a>
        <span class="icon-thumbnail {if $activeMainMenu == "siteLanguages"}bg-success{/if}"><i class="fa fa-globe"></i></span>
    </li>

    <li class="{if $activeMainMenu == "settings"}open{/if}">
        <a href="{url path='admin/settings/index'}">
            <span class="title">Settings</span>
        </a>
        <span class="icon-thumbnail {if $activeMainMenu == "settings"}bg-success{/if}"><i class="fa fa-cogs"></i></span>
    </li>


    {*<li class="">*}
        {*<a href="javascript:;">*}
            {*<span class="title">Page 3</span>*}
            {*<span class=" arrow"></span>*}
        {*</a>*}
        {*<span class="icon-thumbnail"><i class="pg-grid"></i></span>*}
        {*<ul class="sub-menu">*}
            {*<li class="">*}
                {*<a href="#">Sub Page 1</a>*}
                {*<span class="icon-thumbnail">sp</span>*}
            {*</li>*}
            {*<li class="">*}
                {*<a href="#">Sub Page 2</a>*}
                {*<span class="icon-thumbnail">sp</span>*}
            {*</li>*}
            {*<li class="">*}
                {*<a href="#">Sub Page 3</a>*}
                {*<span class="icon-thumbnail">sp</span>*}
            {*</li>*}
        {*</ul>*}
    {*</li>*}
</ul>
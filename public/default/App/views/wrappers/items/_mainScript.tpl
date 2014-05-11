<script src="{theme_url path='resources/js_unpacked/modernizr.js'}"></script>
<script src="{theme_url path='resources/js_unpacked/jquery.js'}"></script>
<script src="{theme_url path='resources/js_unpacked/jquery-ui.min.js'}"></script>
<script src="{theme_url path='resources/js_unpacked/foundation.min.js'}"></script>

<script type="text/javascript">
    $(document).foundation('interchange', {
        named_queries : {
            largeDesktop : 'screen and (min-width: 1367px)',
            desktop: 'screen and (min-width: 1025px)',
            tablet: 'screen and (min-width: 768px)',
            smartphone: 'screen and (min-width: 0px)',
            'desktop-only': 'screen and (min-width: 1025px) and (max-width: 1366px)',
            'tablet-only': 'screen and (min-width: 768px) and (max-width: 1024px)'
        }
    });
    $(document).foundation();
</script>
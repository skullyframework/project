{extends file="wrappers/_main.tpl"}
{block name=content}
    <h1>Thank you for using Skully Framework!</h1>
    <p>To get started with creating your website / web app, there are a couple of things you can do:</p>
    <div>{debug}</div>
    <ul>
        <li>
            <b>Setup your database and Base URL.</b>
            <p>To do this, copy the file <b>config/config.unique.php.original</b> to <b>config/config.unique.php</b>, then update it</p>
        <li>
            <b>Start making some pages</b>
            <p>Pages can be created at <b>public/default/App/views/</b> directory.</p>
        </li>
        <li><b>Start working on the site's styles.</b>
            <p>You may do this by running <code>compass watch</code> at <b>public/default/resources/foundation</b> directory.</p>
        </li>
        <li>
            <b>Start writing some javascript.</b>
            <p>To do it the Skully way, put your js libraries at <b>public/default/resources/js_unpacked</b> and compress them by running <code>./console skully:pack public/default/resources/js_unpacked/packer.txt</code>.</p>
        </li>
        <li>
            <b>Start building your database schema</b>
            <p>Simply run <code>./console skully:schema db:generate [migration name]</code> and edit the files inside directory <b>migration</b>.</p>
        </li>
        <li>
            <b>Need a CMS system?</b>
            <p>Use our pre-made admin page, see <a href="https://github.com/skullyframework/admin" target="_blank">Skully Admin Github page</a> for more info.</p>
        </li>
        <li>
            <b>Be useful</b>
            <p>There are yet so much potentials to be unlocked within Skully Framework. Find "todo" keyword throughout the code to see the stuff we wanted to create when time allows.</p>
        </li>
    </ul>
{/block}

{block name=script}
    <script>
        $(document).foundation({
            orbit: {

                animation: 'slide',
                timer_speed: 5500,
                pause_on_hover: false,
                animation_speed: 800,
                navigation_arrows: false,
                bullets: true,
                next_on_click: false,
                resume_on_mouseout: false,
                timer_container_class: "pause",
                timer_progress_class: false,
                //timer_paused_class: false,
                slide_number: false

            }
        });

    </script>
{/block}
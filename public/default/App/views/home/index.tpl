{extends file="wrappers/_main.tpl"}
{block name=content}
  <h1>Homepage</h1>
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
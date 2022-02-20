<?php
$manifest = '
{
    "name": "'.$name.'",
    "short_name": "'.$short_name.'",
    "start_url": "/",
    "display": "standalone",
    "background_color": "'.$bg_color.'",
    "theme_color": "'.$theme_color.'",
    "orientation": "portrait-primary",
    "icons": [
      {
        "src": "'.$icon.'",
        "type": "image/png",
        "sizes": "'.$icon_size.'"
      }
    ],
    "capture_links": "existing_client_event",
    "url_handlers": [
        {
            "origin": "/"
        }
    ]
  
}
';
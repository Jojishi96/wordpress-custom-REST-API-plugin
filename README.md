# Custom REST API Endpoint for WordPress
A small plugin for Wordpress for creating and calling a custom GET request endpoint.

# Installation:

Download the repository and drag and drop the `custom-endpoint` folder in to your WordPress plugin folder.

For ex.: `X:\...\wp-content\plugins`

# Usage:

The plugin changes your default `wp-json` endpoint to `zeni-json`.

All you need to do is just call `http://.../zeni-json/v1/localize` and it should print:
- The server's local time
- The user's remote IP address
- The user's latitude and longitude based on the remote IP address
In your browser.

Should serve as an example code for future projects with a similar goal.

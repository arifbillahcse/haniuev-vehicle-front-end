<?php
// Silence is golden — nothing to see here, and .htaccess blocks direct
// access anyway. This file is a second layer of defense on hosts where the
// .htaccess rules above don't apply (e.g. Nginx).
http_response_code(403);

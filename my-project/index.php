<?php

/**
 * Root entrypoint for shared hosts where the Laravel public folder is not the web root.
 * This file simply forwards all requests to the public directory.
 */

require __DIR__.'/public/index.php';

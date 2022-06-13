<?php
if (! function_exists('includeRouteFiles')) {

/**
 * Loops through a folder and requires all PHP files
 * Searches sub-directories as well.
 *
 * @param $folder
 */
function includeRouteFiles($folder)
{
    try {
        $rdi = new recursiveDirectoryIterator($folder);
        $it = new recursiveIteratorIterator($rdi);

        while ($it->valid()) {
            if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                require $it->key();
            }

            $it->next();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
}

// function include_action($controller, $action, $params = array())
// {
//   if (is_callable(array($controller, $action))) {
//     $c = new $controller ;
//     return $c->$action($params) ;
//   }
// }
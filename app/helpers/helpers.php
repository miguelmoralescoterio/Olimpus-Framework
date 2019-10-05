<?php
declare(strict_types=1);
umask(0000);
/**
 * Helpers File
 */

if (!function_exists('env')) {
    function env(?string $value, $default = null, ?bool $local=false) {
        if(!getenv($value, $local)) {
            return $default;
        }
        return getenv($value, $local);
    }
}

if (!function_exists('database_path')) {
    /**
     * Get the path to the database directory.
     *
     * @param  string  $path Optionally, a path to append to the database path
     * @return string
     */
    function database_path($path = '') {
        return (is_dir(DB_ROOT) ? DB_ROOT : ROOT);
    }
}

if (!function_exists('base_url')) {
    function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE) {
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), 0, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $base_url = 'http://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }

        return $base_url;
    }
}

if (!function_exists('myencrypt')) {
    function myencrypt(?string $string){
        if(empty($string)) return null;
        $str = base64_encode($string);
        $str2 = str_replace(array('+','/','='),array('-','_',''), $str);
        $ln = strlen($str2);
        $str3=array();
        $nstr='';
        for($i=0; $i < $ln; $i++) {
            $str3[$i] = (ord($str2[$i]));
            $nc = ($str3[$i]+0);
            $nc++;
            $nstr.=chr($nc);
        }
        $strfin = str_replace(array('+','/','='),array('-','_',''), base64_encode($nstr));
        return $strfin;
    }
}

if (!function_exists('mydecrypt')) {
    function mydecrypt(?string $string){
        if(empty($string)) return null;
        $string = base64_decode(str_replace(array('-','_',''), array('+','/','='), $string));
        $ln = strlen($string);
        $str3=array();
        $nstr='';
        for($i=0; $i < $ln; $i++) {
            $str3[$i] = (ord($string[$i]));
            $nc = ($str3[$i]+0);
            $nc--;
            $nstr.=chr($nc);
        }
        $stri = base64_decode(str_replace(array('-','_',''), array('+','/','='), $nstr));
        return $stri;
    }
}

if(!function_exists('randomString')) {
    function randomString($length, $patern=0) {
        $paterns = [
            'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijqlmnopqrtsuvwxyz0123456789',
            'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijqlmnopqrtsuvwxyz0123456789.+-*',
        ];
        $seed = $paterns[$patern];
        $max = strlen($seed) - 1;
        $string = '';
        for ($i = 0; $i < $length; ++$i) {
            $string .= $seed{intval(mt_rand(0.0, $max))};
        }

        return $string;
    }
}

if(!function_exists('dirToArray')) {
    /**
     * { function_description }
     *
     * @param      ?string         $dir        The dir
     * @param      ?string|string  $extension  The extension
     * @param      ?bool|boolean   $subdirs    The subdirs
     *
     * @return     array           ( description_of_the_return_value )
     */
    function dirToArray(?string $dir, ?string $extension=null, ?bool $subdirs=false) { 
        $result = array(); 
        $cdir = scandir($dir); 
        foreach ($cdir as $key => $value) { 
            $file= $dir . DIRECTORY_SEPARATOR . $value;
            
            if (!in_array($value,array(".",".."))) { 
                if (is_dir($file) && $subdirs === true) { 
                    $result = array_merge($result, dirToArray($file, $extension, $subdirs)); 
                } else {                    
                    if(!$extension || $extension == '*') {                      
                        if(!(is_dir($file))) {
                            $result[] = $file; 
                        }
                    } else {
                        if((!is_dir($file)) && (strtolower(substr($file, strrpos($file, '.') + 1)) == $extension)) {
                            $result[] = $file; 
                        }
                    }
                } 
            } 
        }
        return $result; 
    }
}

if(!function_exists('isJson')) {
    /**
     * { function_description }
     *
     * @param      ?array  $needles   The needles
     * @param      ?array  $haystack  The haystack
     */
    function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

if(!function_exists('json_object')) {
    /**
     * { function_description }
     *
     * @param      <type>  $obj    The object
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    function json_object($obj) {
        if (($obj instanceof \JsonSerializable) === false && \is_array($obj) === false) {
            trigger_error('Invalid type for parameter "value". Must be of type array or object implementing the \JsonSerializable interface.', E_USER_ERROR);
        }
        $json = json_encode($obj, JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE, 512);
        if(json_last_error() !== JSON_ERROR_NONE) {
            trigger_error(json_last_error_msg(), E_USER_ERROR);
        }
        return $json;
    }
}

if(!function_exists('json_array')) {
    /**
     * { function_description }
     *
     * @param      <type>  $obj    The object
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    function json_array($obj) {
        if (($obj instanceof \JsonSerializable) === false && \is_array($obj) === false) {
            trigger_error('Invalid type for parameter "value". Must be of type array or object implementing the \JsonSerializable interface.', E_USER_ERROR);
        }
        $json = json_encode($obj, JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE, 512);
        if(json_last_error() !== JSON_ERROR_NONE) {
            trigger_error(json_last_error_msg(), E_USER_ERROR);
        }
        return $json;
    }
}

if(!function_exists('is_leap_year')) {
    function is_leap_year($year = null) {
        if (null === $year || !is_numeric($year)) {
            $year = date('Y');
        }

        return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
    }
}

if(!function_exists('render_template')) {
    function render_template($request) {
        //extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
        extract($request->attributes->all(), EXTR_SKIP);
        ob_start();
        include SITESRC.sprintf('view/%s.php', $_route);
        $response = new Symfony\Component\HttpFoundation\Response(ob_get_clean());
        return $response;
    }
}

if(!function_exists('render')) {
    function render($request) {
        //extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
        extract($request->attributes->all(), EXTR_SKIP);
        ob_start();
        include SITESRC.sprintf('view/%s.php', $_route);
        echo $_route.'<br/>';
        $response = new Symfony\Component\HttpFoundation\Response(ob_get_clean());
        return $response;
    }
}

if(!function_exists('mix')) {
    function mix($path, $manifestDirectory = '') {
        static $manifest;
        if ($manifestDirectory && strpos($manifestDirectory, '/') !== 0) {
            $manifestDirectory = "/{$manifestDirectory}";
        }
        /*if (! $manifest) {
            if (! file_exists($manifestPath = $manifestDirectory.'/mix-manifest.json')) {
                throw new Exception('The Mix manifest does not exist.');
            }
            $manifest = json_decode(file_get_contents($manifestPath), true);
        }
        if (strpos($path, '/') !== 0) {
            $path = "/{$path}";
        }
        if (! array_key_exists($path, $manifest)) {
            throw new Exception(
                "Unable to locate Mix file: {$path}. Please check your ".
                'webpack.mix.js output paths and try again.'
            );
        }
        return file_exists($manifestDirectory.'/hot')
                    ? "http://localhost:8080{$manifest[$path]}"
                    : $manifest[$path];

        */
        return BASE_URL.$path;
    }
}

if(!function_exists('assets')) {
    function assets($path, $manifestDirectory = '') {
        return BASE_URL.'assets/'.$path; //.(ENVIRONMENT == 'development' ? '?_='.uniqid().date('dmYhmsu') : '');
    }
}

if(!function_exists('js')) {
    function js($path, $manifestDirectory = '') {
        return BASE_URL.'assets/js/'.$path; //.(ENVIRONMENT == 'development' ? '?_='.uniqid().date('dmYhmsu') : '');
    }
}

if(!function_exists('css')) {
    function css($path, $manifestDirectory = '') {
        return BASE_URL.'assets/css/'.$path; //.(ENVIRONMENT == 'development' ? '?_='.uniqid().date('dmYhmsu') : '');
    }
}

if(!function_exists('imgs')) {
    function imgs($path, $manifestDirectory = '') {
        return BASE_URL.'assets/imgs/'.$path; //.(ENVIRONMENT == 'development' ? '?_='.uniqid().date('dmYhmsu') : '');
    }
}

if(!function_exists('resource')) {
    /**
     * 
     */
    function resource($path, $manifestDirectory = '') {    
        if(file_exists(SITESRC.'assets/src/'.$path)) {
            return BASE_URL.'assets/src/'.$path;
        }
        return BASE_URL.'download/resources/?file='.$path; //.(ENVIRONMENT == 'development' ? '&_='.uniqid().date('dmYhmsu') : '');
    }
}

if(!function_exists('images')) {
    /**
     * 
     */
    function images($path, $manifestDirectory = '') { 
        if(file_exists(SITESRC.'assets/uploads/'.$path)) {
            return BASE_URL.'assets/uploads/'.$path;
        }
        return BASE_URL.'download/images/?file='.$path; //.(ENVIRONMENT == 'development' ? '&_='.uniqid().date('dmYhmsu') : '');
    }
}

if(!function_exists('uploads')) {
    /**
     * 
     */
    function uploads($path, $manifestDirectory = '') {
        if(file_exists(SITESRC.'assets/uploads/'.$path)) {
            return BASE_URL.'assets/uploads/'.$path;
        }
        return BASE_URL.'download/images/?file='.$path; //.(ENVIRONMENT == 'development' ? '&_='.uniqid().date('dmYhmsu') : '');
    }
}
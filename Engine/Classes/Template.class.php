<?php

class Template
{

    private $_template = null;

    private $_php_start = '<?php ';

    private $_php_end = ' ?>';

    private $_cache = 'Engine/cache/';

    private $_ext = '.tpl';

    private $_path = TPL;

    private $_root = ROOT_DIR;

    private $_variables = array();

    private $_debug = false;

    public function isDevelop()
    {

        return $this->_debug;

    }

    public function onDevelop()
    {

        $this->_debug = true;

    }

    public function offDevelop()
    {

        $this->_debug = false;

    }

    public function __construct($template, $path = null, $_ext = null)
    {

        if ($path) {

            $this->_path = $path;

        }

        if ($_ext) {

            $this->_ext = $_ext;

        }

        $this->fetch($template, true);

    }

    public function setCache($path = 'cache/')
    {

        $this->_cache = $path;

    }

    public function setRootDir($path = __DIR__)
    {

        $this->_root = $path;

    }

    private function _parseRunInOB()
    {

        $this->_parseAssign();

        $path = $this->_root . $this->_cache . md5($this->_template) . '.php';

        if (!file_exists($path)) {

            file_put_contents($path, $this->_template);

        }

        foreach ($this->_variables as $key => $value) {

            $$key = $value;

        }

        ob_start();

        include_once $path;

        $this->_template = ob_get_clean();

    }

    private function _parseAssign()
    {

        preg_match_all(
            '/{assign\s+var=(.*?)\s+value=(.*?)}/i',
            $this->_template,
            $_____vars
        );

        $this->_template = preg_replace(
            '/{assign\s+var=(.*?)\s+value=(.*?)}/i',
            $this->_php_start . "\$$1 = $2;" . $this->_php_end,
            $this->_template
        );

        if (count(current($_____vars))) {

            $_____count = count(current($_____vars));

            for ($_____iiii = 0; $_____iiii < $_____count; $_____iiii++) {

                $this->assign($_____vars[1][$_____iiii], $_____vars[2][$_____iiii]);

            }

        }

    }

    private function _parseInclude()
    {

        $this->_parseVariables();

        $this->_template = preg_replace(
            '/{include\s+(.*?)}/i',
            $this->_php_start . "include '" . $this->_root .
            $this->_path . "$1" . $this->_ext . "';" . $this->_php_end,
            $this->_template
        );

        $this->_parseRunInOB();

    }

    private function _parseFunc()
    {

        $params = array(
            'for', 'while', 'foreach'
        );

        foreach ($params as $value) {

            $this->_template = preg_replace(
                '/{' . $value . '(.*?)}/i',
                $this->_php_start . "$value $1 {" . $this->_php_end,
                $this->_template
            );

            $this->_template = preg_replace(
                '/{\/' . $value . '}/i',
                $this->_php_start . "}" . $this->_php_end,
                $this->_template
            );

        }

    }

    private function _parseVariables()
    {

        $this->_parseFunc();

        $this->_template = preg_replace(
            '/{(\$[\w]+)}/i',
            $this->_php_start . "print $1;" . $this->_php_end,
            $this->_template
        );

        $this->_parseRunInOB();

    }

    private function _parse()
    {

        if ($this->_template) {

            $this->_parseInclude();
            $this->_parseVariables();
            $this->_parseFunc();
            $this->_parseRunInOB();

        }

    }

    public function fetch($template = null, $set = false)
    {

        if ($template) {

            if ($set) {

                $tpl = file_get_contents(
                    $this->_root . $this->_path .
                    $template .
                    $this->_ext
                );

                $this->_parse();

                $this->_template = $tpl;
                unset($tpl);

            } else {

                return new Template($template);

            }

        }

        return $this->_template;

    }

    public function assign($params = array(), $assoc = null)
    {

        if (is_array($params)) {

            if ($assoc) {

                $this->_variables = array_merge(
                    $this->_variables,
                    array($assoc => $params)
                );

            } else {

                $this->_variables = array_merge(
                    $this->_variables,
                    $params
                );

            }

        } else {

            $args = func_get_args();
            $params = array_shift($args);

            $count = count($args);

            if ($count) {

                if ($count > 1) {

                    $this->_variables[$params] = $args;

                } else {

                    $this->_variables[$params] = current($args);

                }

            }

        }

    }

    public function display($parse = true)
    {

        if ($parse) {

            $this->_parse();

        }

        header('Content-Type: text/html; charset=utf-8');
        echo $this->_template;
        die;

    }

}
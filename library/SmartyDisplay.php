<?php

class SmartyDisplay implements Yaf_View_Interface
{
    private $_smarty = '';

    /**
     * SmartyDisplay constructor.
     * @param null $tmplPath
     * @param array $extraParams
     * 自定义的smarty模板
     */
    public function __construct($tmplPath = null, $extraParams = array())
    {
        $this->_smarty = new Smarty;
        if (null !== $tmplPath) {
            $this->setScriptPath($tmplPath);
        }
        foreach ($extraParams as $key => $value) {
            $this->_smarty->$key = $value;
        }
    }

    /**
     * @param string $name
     * @param null $value
     * @return Smarty_Internal_Data
     */
    public function assign($name, $value = null)
    {
       return $this->_smarty->assign($name,$value);
    }

    /**
     * @param string $tpl
     * @param array $var_array
     * @return void
     */
    public function display($tpl, $var_array = array())
    {
       $this->_smarty->display($tpl,$var_array);
    }

    /**
     * @param string $tpl
     * @param array $var_array
     * @return void
     */
    public function render($tpl, $var_array = array())
    {
        $this->_smarty->display($tpl, $var_array);
    }

    /**
     * @param string $tpl
     * @return void
     */
    public function fetch($tpl)
    {
        $this->_smarty->fetch($tpl);
    }

    /**
     * @param string $tpl_dir
     * @return void
     */
    public function setScriptPath($tpl_dir)
    {
        if (is_readable($tpl_dir)) {
            $this->_smarty->template_dir = $tpl_dir;
            return;
        }
    }

    /**
     * @return array
     */
    public function getScriptPath()
    {
         return $this->_smarty->template_dir;
    }

    public function getExt()
    {
        return '.'.Yaf_Registry::get("config")->get("smarty.ext");
    }
}